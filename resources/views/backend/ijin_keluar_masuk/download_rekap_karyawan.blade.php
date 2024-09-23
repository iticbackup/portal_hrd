<style>
    *{
        font-family: Arial, Helvetica, sans-serif
    }

    table, td, th {
        border: 1px solid;
    }

    th, td {
        padding: 8px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>
<title>Laporan Ijin Keluar Masuk Tgl {{ \Carbon\Carbon::create($_GET['rekap_karyawan_mulai_tanggal'])->isoFormat('DD MMMM YYYY').' sd '.\Carbon\Carbon::create($_GET['rekap_karyawan_sampai_tanggal'])->isoFormat('DD MMMM YYYY') }}</title>
<div style="text-align: center; margin-bottom: 1.5%">
    <div style="font-weight: bold; font-size: 16pt">Laporan Ijin Keluar Masuk</div>
    <div>Periode {{ \Carbon\Carbon::create($_GET['rekap_karyawan_mulai_tanggal'])->isoFormat('DD MMMM YYYY').' sd '.\Carbon\Carbon::create($_GET['rekap_karyawan_sampai_tanggal'])->isoFormat('DD MMMM YYYY') }}</div>
</div>
<table>
    <thead>
        <tr>
            <th style="text-align: center; width: 2%; background-color: #E8EFCF">No</th>
            <th style="text-align: center; width: 5%; background-color: #E8EFCF">NIK</th>
            <th style="text-align: center; width: 54%; background-color: #E8EFCF">Nama</th>
            <th style="text-align: center; width: 13%; background-color: #E8EFCF">Keluar Masuk</th>
            <th style="text-align: center; width: 13%; background-color: #E8EFCF">Pulang Awal</th>
            <th style="text-align: center; width: 13%; background-color: #E8EFCF">Terlambat</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_keluar_masuk = [];
            $total_pulang_awal = [];
            $total_terlambat = [];
        @endphp
        @foreach ($ijin_keluar_masuks as $key => $ijin_keluar_masuk)
            @php
                array_push($total_keluar_masuk,$ijin_keluar_masuk->keluar_masuk);
                array_push($total_pulang_awal,$ijin_keluar_masuk->pulang_awal);
                array_push($total_terlambat,$ijin_keluar_masuk->terlambat);
            @endphp
            <tr>
                <td style="text-align: center">{{ $key+1 }}</td>
                <td style="text-align: center">{{ $ijin_keluar_masuk->nik }}</td>
                <td>{{ $ijin_keluar_masuk->biodata_karyawan->nama }}</td>
                <td style="text-align: center">{{ $ijin_keluar_masuk->keluar_masuk }}</td>
                <td style="text-align: center">{{ $ijin_keluar_masuk->pulang_awal }}</td>
                <td style="text-align: center">{{ $ijin_keluar_masuk->terlambat }}</td>
            </tr>
        @endforeach
            <tr>
                <td style="text-align: center; font-weight: bold; background-color: #E8EFCF" colspan="3">Total</td>
                <td style="text-align: center; font-weight: bold; background-color: #E8EFCF">{{ array_sum($total_keluar_masuk) }}</td>
                <td style="text-align: center; font-weight: bold; background-color: #E8EFCF">{{ array_sum($total_pulang_awal) }}</td>
                <td style="text-align: center; font-weight: bold; background-color: #E8EFCF">{{ array_sum($total_terlambat) }}</td>
            </tr>
    </tbody>
</table>
<div style="margin-top: 5%;">Malang, {{ \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') }}</div>
<div style="margin-top: 10%">Andre Martinus</div>