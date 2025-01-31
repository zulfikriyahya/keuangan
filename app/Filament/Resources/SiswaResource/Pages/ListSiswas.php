<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Models\Kelas;
use App\Models\Siswa;
use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Components\Tab;
use App\Filament\Exports\SiswaExporter;
use App\Filament\Imports\SiswaImporter;
use App\Filament\Resources\SiswaResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn(): string => Kelas::count() > 0),
            ImportAction::make()
                ->label('Impor')
                ->icon('heroicon-m-cloud-arrow-up')
                ->color('info')
                ->importer(SiswaImporter::class)
                ->visible(fn(): string => Kelas::count() > 0),
            ExportAction::make()
                ->label('Ekspor')
                ->icon('heroicon-m-cloud-arrow-down')
                ->color('success')
                ->exporter(SiswaExporter::class)
                ->chunkSize(250)
                ->visible(fn(): string => Siswa::count() > 0),
        ];
    }

    public function getTabs(): array
    {
        if (Siswa::count() == 0) {
            return [];
        }

        return [
            'Semua' => Tab::make('Semua')
                ->icon('heroicon-m-viewfinder-circle')
                ->badge(Siswa::count())
                ->badgeColor('primary'),

            'Aktif' => Tab::make('Aktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'Aktif'))
                ->icon('heroicon-m-check-circle')
                ->badge(Siswa::query()->where('status', 'Aktif')->count())
                ->badgeColor('success'),

            'Nonaktif' => Tab::make('Nonaktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'Nonaktif'))
                ->icon('heroicon-m-x-circle')
                ->badge(Siswa::query()->where('status', 'Nonaktif')->count())
                ->badgeColor('gray'),

            'Mutasi' => Tab::make('Mutasi')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'Mutasi'))
                ->icon('heroicon-m-arrows-right-left')
                ->badge(Siswa::query()->where('status', 'Mutasi')->count())
                ->badgeColor('warning'),

            'Alumni' => Tab::make('Alumni')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'Alumni'))
                ->icon('heroicon-m-academic-cap')
                ->badge(Siswa::query()->where('status', 'Alumni')->count())
                ->badgeColor('info'),

            'Drop Out' => Tab::make('Drop Out')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'Drop Out'))
                ->icon('heroicon-m-arrow-right-start-on-rectangle')
                ->badge(Siswa::query()->where('status', 'Drop Out')->count())
                ->badgeColor('danger'),
        ];
    }
}
