<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use Filament\Support\Enums\IconPosition;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PembayaranOverview extends BaseWidget
{
    protected function getHeading(): ?string
    {
        return 'Analytics';
    }
    protected function getDescription(): ?string
    {
        return 'An overview of some analytics.';
    }
    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        return [
            Stat::make('Total Pembayaran SPP', Pembayaran::query()->sum('nominal'))->color('success')->description('32k increase')->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
            Stat::make(
                label: 'Total Jurnal Pembayaran',
                value: Pembayaran::query()
                    ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->count(),
            ),
        ];
    }
}
