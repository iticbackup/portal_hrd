<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
        text-align: justify;
    }
</style>
<title>
    Surat Tulis {{ $ijin_absen->no.' - '.$ijin_absen->nik.' '.$ijin_absen->nama }}
</title>
<p>Malang, {{ $ijin_absen->created_at->isoFormat('DD MMMM YYYY') }}</p>
<p>
    Kepada Yth. <br>
    Dept.HRGA PT Indonesian Tobacco Tbk. <br>
    ditempat,
</p>
<p>
    Hal :
    @switch($ijin_absen->kategori_izin)
        @case('CT')
            Cuti
        @break

        @case('IP')
            Izin Kepentingan Pribadi
        @break

        @case('IS')
            Izin Sakit
        @break

        @default
    @endswitch
</p>
<p>Dengan Hormat,</p>
<p>Saya yang bertanda tangan di bawah ini :</p>
<table>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $ijin_absen->nik }}</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $ijin_absen->nama }}</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $ijin_absen->jabatan }}</td>
    </tr>
    <tr>
        <td>Dept.</td>
        <td>:</td>
        <td>{{ $ijin_absen->unit_kerja }}</td>
    </tr>
</table>
<p>Dengan ini memohon izin untuk tidak masuk kerja pada hari {{ $ijin_absen->hari }} tanggal
    {{ \Carbon\Carbon::create($ijin_absen->tgl_mulai)->isoFormat('DD MMMM YYYY') }} sampai {{ \Carbon\Carbon::create($ijin_absen->tgl_berakhir)->isoFormat('DD MMMM YYYY') }}  dengan alasan {{ $ijin_absen->keperluan }}. </p>
<p>Demikian surat permohonan izin ini saya sampaikan. Atas perhatian dan kerja sama yang diberikan saya ucapkan terima
    kasih.</p>
<p>Hormat Saya,</p>
<img src="{{ $ijin_absen->ijin_absen_attachment->ttd_written_letter }}" style="width: 150px;height: 150px;object-fit: cover;">
<p>
    {{ $ijin_absen->nik.' '.$ijin_absen->nama }}
</p>