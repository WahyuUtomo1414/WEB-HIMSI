<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Branch;
use Illuminate\Support\Facades\Cache;

class AiEntityService
{
    public function resolve(string $question): array
    {
        $branchNames = Cache::remember('ai_entity_branch_names', now()->addMinutes(60), function () {
            return Branch::query()
                ->where('active', true)
                ->pluck('name', 'id')
                ->toArray();
        });

        $matchedBranchId = null;
        $matchedBranchName = null;

        foreach ($branchNames as $id => $name) {
            if (mb_stripos($question, $name) !== false) {
                $matchedBranchId = $id;
                $matchedBranchName = $name;
                break;
            }

            // fallback: cek kata kunci bagian nama (misal "Slipi" dari "HIMSI Slipi")
            $parts = preg_split('/[\s\-\/]+/', $name);
            foreach ($parts as $part) {
                if (mb_strlen($part) >= 3 && mb_stripos($question, $part) !== false) {
                    $matchedBranchId = $id;
                    $matchedBranchName = $name;
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
            ->get(['title', 'slug', 'quotes', 'created_at'])
            ->map(fn ($b) => [
                'title' => $b->title,
                'slug' => $b->slug,
                'quotes' => $b->quotes,
                'date' => $b->created_at?->format('d M Y'),
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
            'blogs' => $blogs,
        ];
    }
}
