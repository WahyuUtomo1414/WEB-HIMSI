<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\Branch;
use App\Models\Recruitment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected ?string $heading = 'Ringkasan Website HIMSI';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Blog', Blog::query()->count())
                ->description('Artikel dan publikasi')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('info'),
            Stat::make('Total Branch', Branch::query()->count())
                ->description('Cabang Aktif')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('success'),
            Stat::make('Total Recruitment', Recruitment::query()->count())
                ->description('Data pendaftaran')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('warning'),
            Stat::make('Total Pengguna', User::query()->count())
                ->description('Akun Pengguna')
                ->descriptionIcon('heroicon-m-users')
                ->color('gray'),
        ];
    }
}
