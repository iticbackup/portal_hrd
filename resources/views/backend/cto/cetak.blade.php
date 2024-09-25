<style>
    * {
        font-family: Arial, Helvetica, sans-serif
    }

    table,
    td,
    th {
        border: 1px solid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 5px;
    }

    .column {
        float: left;
        width: 50%;
        height: 10px;
        /* Should be removed. Only for demonstration */
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>

<body>
    <div class="row">
        <div class="column">
            <div style="font-size: 18pt; font-weight: bold">PT Indonesian Tobacco Tbk</div>
        </div>
        <div class="column">
            <div style="text-align: right">IT/HRGA/FR/08</div>
        </div>
    </div>
    <table style="margin-top: 3%">
        <tr>
            <td colspan="2" style="text-align: center">UMUM</td>
            <td colspan="4" rowspan="3" style="text-align: center; font-weight: bolder; font-size: 21pt">CAR TRAVEL ORDER</td>
            <td colspan="2" style="text-align: center">PEMAKAI</td>
            {{-- <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td> --}}
        </tr>
        <tr>
            <td style="text-align: center">TTD</td>
            <td style="text-align: center">DEPT</td>
            <td style="text-align: center">TTD</td>
            <td style="text-align: center">DEPT</td>
        </tr>
        <tr>
            <td>
                @php
                    $detail = [
                        'signature_hrd' =>
                            'ID: ' .
                            explode('_', $cto->ttd_umum)[3] .
                            "\n" .
                            'Signature HRD: ' .
                            explode('_', $cto->ttd_umum)[0] .
                            ' ' .
                            explode('_', $cto->ttd_umum)[1] .
                            "\n" .
                            'Departemen: ' .
                            explode('_', $cto->ttd_umum)[2] .
                            "\n" .
                            'Tanggal Buat: ' .
                            \Carbon\Carbon::create($cto->tanggal_buat)->isoFormat(
                                'DD MMMM YYYY',
                            ),
                    ];
                @endphp
                <div style="text-align: center; padding-top: 2.5%; padding-bottom: 2.5%">
                    <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['signature_hrd'], 'QRCODE', 2, 2) !!} . '"/>
                </div>
            </td>
            <td style="text-align: center">
                {{ explode('_', $cto->ttd_umum)[2] }}
            </td>
            <td>
                @php
                    $detail = [
                        'signature_pemakai' =>
                            'ID: ' .
                            explode('_', $cto->ttd_pemakai)[3] .
                            "\n" .
                            'Signature Pemakai: ' .
                            explode('_', $cto->ttd_pemakai)[0] .
                            ' ' .
                            explode('_', $cto->ttd_pemakai)[1] .
                            "\n" .
                            'Departemen: ' .
                            explode('_', $cto->ttd_pemakai)[2] .
                            "\n" .
                            'Tanggal Buat: ' .
                            \Carbon\Carbon::create($cto->tanggal_buat)->isoFormat(
                                'DD MMMM YYYY',
                            ),
                    ];
                @endphp
                <div style="text-align: center; padding-top: 2.5%; padding-bottom: 2.5%">
                    <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['signature_pemakai'], 'QRCODE', 2, 2) !!} . '"/>
                </div>
            </td>
            <td style="text-align: center"> {!! explode('_', $cto->ttd_pemakai)[2] !!}</td>
        </tr>
        <tr>
            <td style="text-align: center">Tanggal</td>
            <td style="text-align: center">Jam</td>
            <td style="text-align: center">Rencana</td>
            <td style="text-align: center">Aktual</td>
            <td rowspan="2" style="text-align: center">NO. POL</td>
            <td rowspan="2" style="text-align: center">{{ explode('-', $cto->no_polisi)[0] .' '. explode('-', $cto->no_polisi)[1] .' '. explode('-', $cto->no_polisi)[2] }}</td>
            <td colspan="2" rowspan="3" style="vertical-align: top">
                <div style="text-align: center">PENUMPANG</div>
                <div>
                    <ul style="color: black">
                        @foreach (json_decode($cto->penumpang) as $penumpang)
                            <li style="font-size: 10pt">{{ $penumpang }}</li>
                        @endforeach
                    </ul>
                </div>
            </td>
        </tr>
        <tr>
            <td rowspan="2" style="text-align: center">{{ $cto->created_at->format('d/m/Y') }}</td>
            <td style="text-align: center">Berangkat</td>
            <td style="text-align: center">{!! \Carbon\Carbon::create($cto->jam_berangkat_rencana)->format('H:i') !!}</td>
            <td style="text-align: center">{!! !$cto->jam_berangkat_aktual ? '-' : \Carbon\Carbon::create($cto->jam_berangkat_aktual)->format('H:i') !!}</td>
        </tr>
        <tr>
            <td style="text-align: center">Datang</td>
            <td style="text-align: center">{!! \Carbon\Carbon::create($cto->jam_datang_rencana)->format('H:i') !!}</td>
            <td style="text-align: center">{!! !$cto->jam_datang_aktual ? '-' : \Carbon\Carbon::create($cto->jam_datang_aktual)->format('H:i') !!}</td>
            <td style="text-align: center">DRIVER</td>
            <td style="text-align: center">{{ $cto->biodata_karyawan->nama }}</td>
        </tr>
        <tr>
            <td colspan="2" rowspan="2" style="text-align: center">TUJUAN <br> (Alamat)</td>
            <td style="text-align: center">RENCANA</td>
            <td colspan="5">{{ $cto->tujuan_rencana }}</td>
        </tr>
        <tr>
            <td style="text-align: center">AKTUAL</td>
            <td colspan="5">{{ $cto->tujuan_aktual }}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center">KEPERLUAN</td>
            <td colspan="6">{{ $cto->keperluan }}</td>
        </tr>
        {{-- <tr>
            <td rowspan="2"></td>
        </tr>
        <tr>
            <td>Berangkat</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td rowspan="2">TUJUAN (Alamat)</td>
            <td>RENCANA</td>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td>AKTUAL</td>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td>KEPERLUAN</td>
            <td colspan="6"></td>
        </tr> --}}
    </table>
    <div class="row" style="margin-top: 1.5%">
        <div class="column">
            <div>Note : Rountung Form</div>
            <div>User : 2 Umum 2 Security 2 Umum</div>
        </div>
        <div class="column">
            <div style="text-decoration: underline">Catatan Security :</div>
            <table style="margin-top: 2.5%">
                <tr>
                    <td></td>
                    <td style="text-align: center">JAM</td>
                    <td style="text-align: center">KM</td>
                    <td style="text-align: center">TTD</td>
                </tr>
                <tr>
                    <td style="text-align: center">KELUAR</td>
                    <td style="text-align: center">{{ !$cto->security_jam_keluar ? null : \Carbon\Carbon::create($cto->security_jam_keluar)->format('H:i') }}</td>
                    <td style="text-align: center">{{ !$cto->security_km_keluar ? null : $cto->security_km_keluar }}</td>
                    <td>
                        @if (!empty($cto->security_ttd_keluar))
                            @php
                                $detail = [
                                    'signature_security_keluar' =>
                                        'ID: ' .
                                        explode('_', $cto->security_ttd_keluar)[3] .
                                        "\n" .
                                        'Signature Security Keluar: ' .
                                        explode('_', $cto->security_ttd_keluar)[0] .
                                        ' ' .
                                        explode('_', $cto->security_ttd_keluar)[1] .
                                        "\n" .
                                        'Departemen: ' .
                                        explode('_', $cto->security_ttd_keluar)[2] .
                                        "\n" .
                                        'Tanggal Buat: ' .
                                        \Carbon\Carbon::create($cto->tanggal_buat)->isoFormat(
                                            'DD MMMM YYYY',
                                        ),
                                ];
                            @endphp
                        @endif
                        <div style="text-align: center">
                        {{-- {!! !$cto->security_ttd_keluar
                            ? null
                            : DNS2D::getBarcodeHTML($detail['signature_security_keluar'], 'QRCODE', 2, 2) !!} --}}
                            @if (!$cto->security_jam_keluar)
                                -
                            @else
                                <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['signature_security_keluar'], 'QRCODE', 2, 2) !!} . '"/>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">MASUK</td>
                    <td style="text-align: center">{{ !$cto->security_jam_masuk ? null : \Carbon\Carbon::create($cto->security_jam_masuk)->format('H:i') }}</td>
                    <td style="text-align: center">{{ !$cto->security_km_masuk ? null : $cto->security_km_masuk }}</td>
                    <td>
                        @if (!empty($cto->security_ttd_masuk))
                            @php
                                $detail = [
                                    'signature_security_masuk' =>
                                        'ID: ' .
                                        explode('_', $cto->security_ttd_masuk)[3] .
                                        "\n" .
                                        'Signature Security Masuk: ' .
                                        explode('_', $cto->security_ttd_masuk)[0] .
                                        ' ' .
                                        explode('_', $cto->security_ttd_masuk)[1] .
                                        "\n" .
                                        'Departemen: ' .
                                        explode('_', $cto->security_ttd_masuk)[2] .
                                        "\n" .
                                        'Tanggal Buat: ' .
                                        \Carbon\Carbon::create($cto->tanggal_buat)->isoFormat(
                                            'DD MMMM YYYY',
                                        ),
                                ];
                            @endphp
                        @endif
                        {{-- {!! !$cto->security_ttd_masuk
                            ? null
                            : DNS2D::getBarcodeHTML($detail['signature_security_masuk'], 'QRCODE', 2, 2) !!} --}}
                        <div style="text-align: center">
                            @if (!$cto->security_ttd_masuk)
                                -
                            @else
                                <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['signature_security_masuk'], 'QRCODE', 2, 2) !!} . '"/>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
