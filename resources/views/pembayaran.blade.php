<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>
.page-break {
    page-break-after: always;
}
</style>

{{-- Report.PDF --}}
<div>ID: {{ $record->id }}</div>
<br>
<div>Nama Siswa: {{ $record->siswa->nama }}</div>
<br>
<div>Kelas: {{ $record->siswa->kelas_id }}</div>
<br>
<div>Kode Pembayaran: {{ $record->jenisPembayaran->kode }}</div>
<br>
<div>Jenis Pembayaran: {{ $record->jenisPembayaran->nama }}</div>
<br>
<div>Nominal: Rp. {{ $record->nominal }}</div>
<br>
{{-- <div class="page-break"></div> --}}
{{-- <br> --}}
<div>Status Pembayaran: {{ $record->status }}</div>
<br>
<div>Deskripsi: {{ $record->deskripsi }}</div>
<br>
<div>Tanggal Pembayaran:  {{ date("d ", strtotime($record->tanggal)) . $record->bulan->nama .' '. $record->tahun->nama }}</div>