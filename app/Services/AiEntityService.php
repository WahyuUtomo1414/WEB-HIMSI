<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Branch;
use App\Models\BranchStructure;
use App\Models\Count;
use App\Models\Division;
use App\Models\Faq;
use App\Models\Milestone;
use App\Models\Organization;
use Illuminate\Support\Facades\Cache;

class AiEntityService
{
    private const ORG_KEYWORDS = [
        'ketua', 'pengurus', 'kontak', 'email', 'alamat', 'telepon', 'no_tlpn',
        'visi', 'misi', 'sejarah', 'berdiri', 'sekretariat', 'kabinet',
        'dpp', 'trivolve', 'profile', 'profil', 'tentang himsi', 'tujuan',
        'fungsi himsi', 'website', 'instagram', 'sosmed', 'media sosial',
    ];

    private const DIVISION_KEYWORDS = [
        'divisi', 'psdm', 'kominfo', 'sosmas', 'pendidikan', 'litbang', 'rsdm',
        'komunikasi', 'informasi', 'sumber daya', 'penelitian', 'pengembangan',
        'sosial', 'masyarakat', 'rekrutmen',
    ];

    private const BLOG_KEYWORDS = [
        'blog', 'berita', 'kegiatan', 'artikel', 'acara', 'event',
        'agenda', 'program kerja', 'proker', 'terbaru', 'update',
    ];

    private const MILESTONE_KEYWORDS = [
        'prestasi', 'pencapaian', 'milestone', 'achievement',
        'penghargaan', 'juara', 'lomba', 'kompetisi', 'piala',
    ];

    public function resolve(string $question): array
    {
        $result = [];

        // 1. Branch detection (prioritas pertama)
        $branchResult = $this->resolveBranch($question);
        if (! empty($branchResult)) {
            $result = array_merge($result, $branchResult);
        }

        // 2. Organization — jika tidak ada branch dan pertanyaan menyebut kata kunci org
        if (empty($result['branch'])) {
            foreach (self::ORG_KEYWORDS as $kw) {
                if (mb_stripos($question, $kw) !== false) {
                    $org = $this->resolveOrganization();
                    if ($org) {
                        $result['organization'] = $org;
                    }
                    break;
                }
            }
        }

        // 3. Division detection
        $divisions = $this->resolveDivisions($question);
        if (! empty($divisions)) {
            $result['divisions'] = $divisions;
        }

        // 4. Blog umum — jika tidak ada branch tapi nanya soal kegiatan
        if (empty($result['branch'])) {
            foreach (self::BLOG_KEYWORDS as $kw) {
                if (mb_stripos($question, $kw) !== false) {
                    $result['blogs'] = $this->resolveGeneralBlogs();
                    break;
                }
            }
        }

        // 5. Milestone — jika nanya tentang prestasi/pencapaian
        foreach (self::MILESTONE_KEYWORDS as $kw) {
            if (mb_stripos($question, $kw) !== false) {
                $result['milestones'] = $this->resolveMilestones();
                break;
            }
        }

        // 6. FAQ — selalu inject sebagai konteks dasar
        $result['faqs'] = $this->resolveFaqs();

        return $result;
    }

    private function resolveBranch(string $question): array
    {
        $branchNames = Cache::remember('ai_entity_branch_names', now()->addMinutes(60), function () {
            return Branch::query()
                ->where('active', true)
                ->pluck('name', 'id')
                ->toArray();
        });

        $matchedBranchId = null;

        foreach ($branchNames as $id => $name) {
            if (mb_stripos($question, $name) !== false) {
                $matchedBranchId = $id;
                break;
            }

            $parts = preg_split('/[\s\-\/]+/', $name);
            foreach ($parts as $part) {
                if (mb_strlen($part) >= 3 && mb_stripos($question, $part) !== false) {
                    $matchedBranchId = $id;
                    break 2;
                }
            }
        }

        if (! $matchedBranchId) {
            return [];
        }

        $branch = Branch::query()
            ->where('id', $matchedBranchId)
            ->where('active', true)
            ->first(['id', 'name', 'location', 'sektor', 'description', 'grup_wa', 'is_dpp']);

        if (! $branch) {
            return [];
        }

        $blogs = Blog::query()
            ->where('branch_id', $matchedBranchId)
            ->where('active', true)
            ->latest()
            ->limit(3)
            ->get(['title', 'created_at'])
            ->map(fn ($b) => [
                'title' => $b->title,
                'date' => $b->created_at?->format('d M Y'),
            ])
            ->toArray();

        $structure = BranchStructure::query()
            ->where('branch_id', $matchedBranchId)
            ->where('active', true)
            ->orderBy('sort')
            ->limit(8)
            ->get(['name', 'position', 'no_wa'])
            ->map(fn ($s) => [
                'name' => $s->name,
                'position' => $s->position,
                'no_wa' => $s->no_wa,
            ])
            ->toArray();

        return [
            'branch' => [
                'name' => $branch->name,
                'location' => $branch->location,
                'sektor' => $branch->sektor,
                'description' => strip_tags($branch->description ?? ''),
                'grup_wa' => $branch->grup_wa,
                'is_dpp' => $branch->is_dpp ? 'DPP' : 'DPC',
            ],
            'branch_structure' => $structure,
            'blogs' => $blogs,
        ];
    }

    private function resolveOrganization(): ?array
    {
        $org = Cache::remember('ai_entity_organization', now()->addMinutes(60), function () {
            return Organization::query()
                ->where('active', true)
                ->latest()
                ->first(['name', 'description', 'vision', 'mision', 'purpose', 'address', 'email', 'no_tlpn', 'sosial_media']);
        });

        if (! $org) {
            return null;
        }

        $sosmed = [];
        if (is_array($org->sosial_media)) {
            foreach ($org->sosial_media as $item) {
                if (isset($item['platform'], $item['url']) && filled($item['url'])) {
                    $sosmed[] = "{$item['platform']}: {$item['url']}";
                }
            }
        }

        $missions = [];
        if (is_array($org->mision)) {
            foreach ($org->mision as $m) {
                $missions[] = is_string($m) ? $m : ($m['text'] ?? '');
            }
        }

        $stats = Cache::remember('ai_entity_counts', now()->addMinutes(60), function () {
            return Count::query()
                ->where('active', true)
                ->get(['name', 'digit'])
                ->map(fn ($c) => "{$c->name}: {$c->digit}")
                ->toArray();
        });

        return [
            'name' => $org->name,
            'description' => strip_tags($org->description ?? ''),
            'vision' => $org->vision,
            'missions' => array_filter($missions),
            'purpose' => strip_tags($org->purpose ?? ''),
            'address' => $org->address,
            'email' => $org->email,
            'no_tlpn' => $org->no_tlpn,
            'sosial_media' => $sosmed,
            'stats' => $stats,
        ];
    }

    private function resolveDivisions(string $question): array
    {
        $divisions = Cache::remember('ai_entity_divisions', now()->addMinutes(60), function () {
            return Division::query()
                ->where('active', true)
                ->get(['name', 'description', 'is_dpp'])
                ->toArray();
        });

        $matched = [];
        foreach ($divisions as $div) {
            $name = strtolower($div['name']);
            $parts = preg_split('/[\s\-\/]+/', $name);
            foreach ($parts as $part) {
                if (mb_strlen($part) >= 3 && mb_stripos($question, $part) !== false) {
                    $matched[] = [
                        'name' => $div['name'],
                        'description' => strip_tags($div['description'] ?? ''),
                        'level' => $div['is_dpp'] ? 'DPP' : 'DPC',
                    ];
                    break;
                }
            }
        }

        return $matched;
    }

    private function resolveGeneralBlogs(): array
    {
        return Blog::query()
            ->where('active', true)
            ->latest()
            ->limit(5)
            ->get(['title', 'created_at'])
            ->map(fn ($b) => [
                'title' => $b->title,
                'date' => $b->created_at?->format('d M Y'),
            ])
            ->toArray();
    }

    private function resolveFaqs(): array
    {
        return Cache::remember('ai_entity_faqs', now()->addMinutes(60), function () {
            return Faq::query()
                ->where('active', true)
                ->get(['question', 'answer'])
                ->map(fn ($f) => [
                    'question' => $f->question,
                    'answer' => $f->answer,
                ])
                ->toArray();
        });
    }

    private function resolveMilestones(): array
    {
        return Cache::remember('ai_entity_milestones', now()->addMinutes(60), function () {
            return Milestone::query()
                ->where('active', true)
                ->orderBy('sort')
                ->get(['list'])
                ->flatMap(fn ($m) => collect($m->list)->pluck('value')->filter()->values())
                ->toArray();
        });
    }
}
