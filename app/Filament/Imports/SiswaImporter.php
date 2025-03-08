<?php

namespace App\Filament\Imports;

use App\Models\Siswa;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;

class SiswaImporter extends Importer
{
    protected static ?string $model = Siswa::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nisn')
                ->label('NISN')
                ->requiredMappingForNewRecordsOnly()
                ->rules(['required']),
            ImportColumn::make('nik')
                ->label('NIK')
                ->requiredMappingForNewRecordsOnly()
                ->rules(['required']),
            ImportColumn::make('nama')
                ->requiredMappingForNewRecordsOnly()
                ->rules(['required']),
            ImportColumn::make('jenis_kelamin')
                ->requiredMappingForNewRecordsOnly()
                ->rules(['required']),
            ImportColumn::make('diterima_tanggal')
                ->requiredMappingForNewRecordsOnly()
                ->rules(['required', 'date']),
            // ImportColumn::make('mutasi_tanggal'),
            ImportColumn::make('lulus_tanggal'),
            ImportColumn::make('kelas')
                ->requiredMappingForNewRecordsOnly()
                ->relationship('kelas', 'nama')
                ->rules(['required']),
            ImportColumn::make('status')
                ->requiredMappingForNewRecordsOnly()
                ->rules(['required']),
            ImportColumn::make('foto'),
            ImportColumn::make('alamat'),
            ImportColumn::make('nama_ibu'),
            ImportColumn::make('nama_ayah'),
            ImportColumn::make('telepon')
                ->requiredMappingForNewRecordsOnly()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Siswa
    {
        return Siswa::firstOrNew([
            //     // Update existing records, matching them by `$this->data['column_name']`
            'nisn' => $this->data['nisn'],
        ]);

        return new Siswa;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your siswa import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
