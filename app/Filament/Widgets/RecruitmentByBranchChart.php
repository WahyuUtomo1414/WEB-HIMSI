<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Recruitments\RecruitmentResource;
use App\Models\Recruitment;
use Filament\Widgets\ChartWidget;

class RecruitmentByBranchChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Rekrutmen per Cabang';

    protected ?string $description = 'Distribusi jumlah pendaftar berdasarkan cabang pilihan.';

    protected ?string $emptyStateHeading = 'Belum ada data rekrutmen';

    protected ?string $emptyStateDescription = 'Distribusi cabang akan tampil setelah pendaftar mulai masuk.';

    protected string $color = 'warning';

    protected ?string $maxHeight = '320px';

    protected int|string|array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $rows = RecruitmentResource::scopeQueryForBranchRole(
            Recruitment::query()
                ->join('branch', 'branch.id', '=', 'recruitment.branch_id')
                ->selectRaw('branch.name as label, COUNT(*) as aggregate')
                ->groupBy('branch.id', 'branch.name')
                ->orderByDesc('aggregate')
                ->limit(8)
        )->get();

        if ($rows->isEmpty()) {
            return [];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendaftar',
                    'data' => $rows->pluck('aggregate')->map(fn ($value) => (int) $value)->all(),
                    'backgroundColor' => [
                        '#f59e0b',
                        '#0453cd',
                        '#10b981',
                        '#8b5cf6',
                        '#ef4444',
                        '#14b8a6',
                        '#f97316',
                        '#64748b',
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $rows->pluck('label')->all(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
