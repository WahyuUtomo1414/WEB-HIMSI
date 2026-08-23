<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Recruitments\RecruitmentResource;
use App\Models\Division;
use App\Models\Recruitment;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;

class RecruitmentByDivisionChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Tren Rekrutmen per Divisi';

    protected ?string $description = 'Jumlah pendaftar tiap divisi dalam 6 bulan terakhir.';

    protected ?string $emptyStateHeading = 'Belum ada data rekrutmen';

    protected ?string $emptyStateDescription = 'Tren divisi akan tampil setelah pendaftar memilih divisi.';

    protected string $color = 'info';

    protected ?string $maxHeight = '320px';

    protected int|string|array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $startDate = now()->subMonths(5)->startOfMonth();
        $endDate = now()->endOfMonth();

        $period = collect(CarbonPeriod::create($startDate, '1 month', $endDate))
            ->map(fn ($date) => $date->copy()->startOfMonth());

        $divisions = Division::query()
            ->where('active', true)
            ->where('is_dpp', false)
            ->whereHas('recruitments', fn ($query) => RecruitmentResource::scopeQueryForBranchRole($query))
            ->orderBy('name')
            ->limit(5)
            ->get(['id', 'name']);

        if ($divisions->isEmpty()) {
            return [];
        }

        $rows = RecruitmentResource::scopeQueryForBranchRole(
            Recruitment::query()
                ->whereBetween('created_at', [$startDate, $endDate])
                ->whereIn('division_id', $divisions->pluck('id'))
        )->get(['division_id', 'created_at'])
            ->groupBy(fn (Recruitment $recruitment) => $recruitment->division_id.'|'.$recruitment->created_at?->format('Y-m'));

        $palette = [
            ['border' => '#0453cd', 'background' => 'rgba(4, 83, 205, 0.12)'],
            ['border' => '#f59e0b', 'background' => 'rgba(245, 158, 11, 0.14)'],
            ['border' => '#10b981', 'background' => 'rgba(16, 185, 129, 0.12)'],
            ['border' => '#8b5cf6', 'background' => 'rgba(139, 92, 246, 0.12)'],
            ['border' => '#ef4444', 'background' => 'rgba(239, 68, 68, 0.12)'],
        ];

        return [
            'datasets' => $divisions->values()->map(function (Division $division, int $index) use ($palette, $period, $rows): array {
                $color = $palette[$index % count($palette)];

                return [
                    'label' => $division->name,
                    'data' => $period->map(function ($date) use ($division, $rows): int {
                        return $rows->get($division->id.'|'.$date->format('Y-m'))?->count() ?? 0;
                    })->all(),
                    'borderColor' => $color['border'],
                    'backgroundColor' => $color['background'],
                    'tension' => 0.35,
                    'fill' => true,
                ];
            })->all(),
            'labels' => $period->map(fn ($date) => $date->translatedFormat('M Y'))->all(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
