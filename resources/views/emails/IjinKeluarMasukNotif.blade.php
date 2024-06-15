<p>Terimakasih {{ $name }} telah melakukan pengisian Ijin Keluar Masuk di <b>Portal HRD</b>. Berikut detail pengajuan Ijin Keluar Masuk :</p>
<table>
    <tr>
        <td>No. ID</td>
        <td>:</td>
        <td>{{ $no_id }}</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $nama_karyawan }}</td>
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
        <td>Jenis Keperluan</td>
        <td>:</td>
        <td>{{ $jenis_keperluan }}</td>
    </tr>
    <tr>
        <td>Keperluan</td>
        <td>:</td>
        <td>{{ $keperluan }}</td>
    </tr>
    <tr>
        <td>Kendaraan</td>
        <td>:</td>
        <td>{{ $kendaraan }}</td>
    </tr>
    <tr>
        <td>Jam Kerja</td>
        <td>:</td>
        <td>{{ $jam_kerja }}</td>
    </tr>
    <tr>
        <td>Jam Rencana Keluar</td>
        <td>:</td>
        <td>{{ $jam_rencana_keluar }}</td>
    </tr>
    <tr>
        <td>Jam Datang</td>
        <td>:</td>
        <td>{{ $jam_datang }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>:</td>
        <td>{!! $status !!}</td>
    </tr>
</table>
<p>Silahkan cek secara berkala di aplikasi Portal HRD untuk mendapatkan informasi lanjut. Terimakasih</p>
<p>Hormat Kami,</p>
<p>Team {{ $dept_tujuan }}</p>
<p>Note: Notifikasi email ini tidak perlu dibalas.</p>