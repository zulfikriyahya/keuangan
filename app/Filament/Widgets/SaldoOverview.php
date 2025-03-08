<?php

namespace App\Filament\Widgets;

use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class SaldoOverview extends BaseWidget
{
    protected function getHeading(): ?string
    {
        return 'Total Transaksi';
    }

    // protected function getDescription(): ?string
    // {
    //     return 'An overview of some analytics.';
    // }
    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        return [
            Stat::make(
                'Saldo',
                'Rp. ' . number_format(
                    Pembayaran::query()
                        ->sum('nominal') +
                        Pemasukan::query()
                        ->sum('nominal') - Pengeluaran::query()
                        ->sum('nominal'),
                    2,
                    ',',
                    '.'
                )
            )
                ->icon('heroicon-m-wallet')
                ->color('success'),
            Stat::make(
                'Total Pembayaran',
                'Rp. ' . number_format(
                    Pembayaran::query()
                        ->sum('nominal'),
                    2,
                    ',',
                    '.'
                )
            )
                ->icon('heroicon-o-banknotes')
                ->color('success'),
            Stat::make(
                'Total Pemasukan',
                'Rp. ' . number_format(
                    Pemasukan::query()
                        ->sum('nominal'),
                    2,
                    ',',
                    '.'
                )
            )
                ->icon('heroicon-o-credit-card')
                ->color('success'),
            Stat::make(
                'Total Pengeluaran',
                'Rp. ' . number_format(
                    Pengeluaran::query()
                        ->sum('nominal'),
                    2,
                    ',',
                    '.'
                )
            )
                ->icon('heroicon-o-credit-card')
                ->color('success'),

        ];
    }
}
