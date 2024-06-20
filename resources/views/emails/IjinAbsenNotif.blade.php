<p>Terimakasih {{ $name }} telah melakukan pengisian Ijin Absen di <b>Portal HRD</b>.
Berikut detail pengajuan Ijin Absen :</p>
<table>
    <tr>
        <td>No. ID</td>
        <td>:</td>
        <td>{{ $no_id }}</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $name }}</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $jabatan }}</td>
    </tr>
    <tr>
        <td>Unit Kerja</td>
        <td>:</td>
        <td>{{ $unit_kerja }}</td>
    </tr>
    <tr>
        <td>Hari</td>
        <td>:</td>
        <td>{{ $hari }}</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>{{ $tgl_mulai.' s/d '.$tgl_berakhir }}</td>
    </tr>
    <tr>
        <td>Selama</td>
        <td>:</td>
        <td>{{ $selama.' Hari' }}</td>
    </tr>
    <tr>
        <td>Keperluan</td>
        <td>:</td>
        <td>{{ $keperluan }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>:</td>
        <td>{{ $status }}</td>
    </tr>
</table>
<p>Silahkan cek secara berkala di aplikasi Portal HRD untuk mendapatkan informasi lanjut. Terimakasih</p>
<p>Hormat Kami,</p>
<p>Team HRD</p>
<p>Note: Notifikasi email ini tidak perlu dibalas.</p>