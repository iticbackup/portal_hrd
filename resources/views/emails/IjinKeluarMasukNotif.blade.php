<style>
    .email {
        max-width: 480px;
        margin: 1rem auto;
        border-radius: 10px;
        border-top: #fbe80a 2px solid;
        border-bottom: #fbe80a 2px solid;
        box-shadow: 0 2px 18px rgba(0, 0, 0, 0.2);
        padding: 1.5rem;
        font-family: Arial, Helvetica, sans-serif;
    }

    .email .email-head {
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        padding-bottom: 1rem;
    }

    .email .email-head .head-img {
        max-width: 240px;
        padding: 0 0.5rem;
        display: block;
        margin: 0 auto;
    }

    .email .email-head .head-img img {
        width: 100%;
    }

    .email-body .invoice-icon {
        max-width: 80px;
        margin: 1rem auto;
    }

    .email-body .invoice-icon img {
        width: 100%;
    }

    .email-body .body-text {
        padding: 2rem 0 1rem;
        text-align: center;
        font-size: 1.15rem;
    }

    .email-body .body-text.bottom-text {
        padding: 2rem 0 1rem;
        text-align: center;
        font-size: 0.8rem;
    }

    .email-body .body-text .body-greeting {
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .email-body .body-table {
        text-align: left;
    }

    .email-body .body-table table {
        width: 100%;
        font-size: 1.1rem;
    }

    .email-body .body-table table .total {
        background-color: hsla(4, 67%, 52%, 0.12);
        border-radius: 8px;
        color: #059400;
    }

    .email-body .body-table table .item {
        border-radius: 8px;
        color: #d74034;
    }

    .email-body .body-table table th,
    .email-body .body-table table td {
        padding: 10px;
    }

    .email-body .body-table table tr:first-child th {
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    }

    .email-body .body-table table tr td:last-child {
        text-align: right;
    }

    .email-body .body-table table tr th:last-child {
        text-align: right;
    }

    .email-body .body-table table tr:last-child th:first-child {
        border-radius: 8px 0 0 8px;
    }

    .email-body .body-table table tr:last-child th:last-child {
        border-radius: 0 8px 8px 0;
    }

    .email-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.2);
    }

    .email-footer .footer-text {
        font-size: 0.8rem;
        text-align: center;
        padding-top: 1rem;
    }

    .email-footer .footer-text a {
        color: #d74034;
    }
</style>
</head>

<body>
    <div class="email">
        <div class="email-head">
            <div style="text-align: center; font-weight: bold">PORTAL HRD</div>
        </div>
        <div class="email-body">
            <div class="body-text">
                <div class="body-greeting">
                    Hi, {{ explode(' ',$name)[0] }}
                </div>
                Terimakasih {{ $name }} telah melakukan pengisian Ijin Absen di <b>Portal HRD.</b> Berikut
                detail pengajuan Ijin Absen :
            </div>
            <div class="body-table">
                <table>
                    <tr>
                        <td>No. ID</td>
                        <td>{{ $no_id }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>{{ $nama_karyawan }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>{{ $jabatan }}</td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>{{ $unit_kerja }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Keperluan</td>
                        <td>{{ $jenis_keperluan }}</td>
                    </tr>
                    <tr>
                        <td>Keperluan</td>
                        <td>{{ $keperluan }}</td>
                    </tr>
                    <tr>
                        <td>Kendaraan</td>
                        <td>{{ $kendaraan }}</td>
                    </tr>
                    @switch($kategori_izin)
                        @case('TL')
                            <tr>
                                <td>Status Izin</td>
                                <td>Terlambat</td>
                            </tr>
                            <tr>
                                <td>Jam Kerja</td>
                                <td>{{ $jam_kerja }}</td>
                            </tr>
                            <tr>
                                <td>Jam Datang</td>
                                <td>{{ $jam_datang }}</td>
                            </tr>
                            @break
                        @case('KL')
                            <tr>
                                <td>Status Izin</td>
                                <td>Keluar Masuk</td>
                            </tr>
                            <tr>
                                <td>Jam Kerja</td>
                                <td>{{ $jam_kerja }}</td>
                            </tr>
                            <tr>
                                <td>Jam Datang</td>
                                <td>{{ $jam_datang }}</td>
                            </tr>
                            @break
                        @case('PA')
                            <tr>
                                <td>Status Izin</td>
                                <td>Pulang Awal</td>
                            </tr>
                            <tr>
                                <td>Jam Kerja</td>
                                <td>{{ $jam_kerja }}</td>
                            </tr>
                            <tr>
                                <td>Jam Rencana Keluar</td>
                                <td>{{ $jam_rencana_keluar }}</td>
                            </tr>
                            @break
                        @default
                            
                    @endswitch
                    <tr>
                        <td>Status</td>
                        @switch($status)
                            @case('Waiting')
                                <td style="color: #ffb300">Waiting</td>
                                @break
                            @case('Rejected')
                                <td style="color: #940000">Rejected</td>
                                @break
                            @case('Approved')
                                <td style="color: #059400">Approved</td>
                                @break
                            @default
                                
                        @endswitch
                    </tr>
                </table>
            </div>
            <div class="body-text bottom-text">
                <p>Silahkan cek secara berkala di aplikasi Portal HRD untuk mendapatkan informasi lanjut. Terimakasih
                </p>
                <p>Hormat Kami,</p>
                <p>Team {{ $dept_tujuan }}</p>
                <p>Note: Notifikasi email ini tidak perlu dibalas.</p>
            </div>
        </div>
        <div class="email-footer">
            <div class="footer-text">
                &copy; {{ date('Y') }}
            </div>
        </div>
    </div>
</body>