<style>
    *{
        font-family: Arial, Helvetica, sans-serif
    }
    table, td, th {
        border: 1px solid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>
<div style="text-align: center; margin-top: 1.5%; margin-bottom: 1.5%">
    <div style="font-weight: bold; font-size: 16pt">Laporan Absensi Ijin Keluar Masuk</div>
    <div>Periode {{ \Carbon\Carbon::create($_GET['rekap_karyawan_mulai_tanggal'])->isoFormat('DD MMMM YYYY').' sd '.\Carbon\Carbon::create($_GET['rekap_karyawan_sampai_tanggal'])->isoFormat('DD MMMM YYYY') }}</div>
</div>
<table>
    <thead>
        <tr>
            <th style="text-align: center">No</th>
            <th style="text-align: center">NIK</th>
            <th style="text-align: center">Nama</th>
            <th style="text-align: center">Keluar Masuk</th>
            <th style="text-align: center">Pulang Awal</th>
            <th style="text-align: center">Terlambat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ijin_keluar_masuks as $key => $ijin_keluar_masuk)
            <tr>
                <td style="text-align: center">{{ $key+1 }}</td>
                <td style="text-align: center">{{ $ijin_keluar_masuk->nik }}</td>
                <td>{{ $ijin_keluar_masuk->biodata_karyawan->nama }}</td>
                <td style="text-align: center">{{ $ijin_keluar_masuk->keluar_masuk }}</td>
                <td style="text-align: center">{{ $ijin_keluar_masuk->pulang_awal }}</td>
                <td style="text-align: center">{{ $ijin_keluar_masuk->terlambat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div style="margin-top: 5%;">Malang, {{ \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') }}</div>
<div style="margin-top: 15%">Andre Martinus</div>