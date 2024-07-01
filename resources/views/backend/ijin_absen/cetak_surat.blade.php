<style>
    *{
        font-family: Arial, Helvetica, sans-serif;
    }
    @page { margin: 5%; }
    table,
    td,
    th {
        border: 1px solid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .text-center{
        text-align: center;
    }
</style>
<title>
    Ijin Absen Tgl {{ $ijin_absen->created_at->isoFormat('DD MMMM YYYY').' '.$ijin_absen->nama.' ('.$ijin_absen->nik.')' }}
</title>
@php
    if (empty($ijin_absen->ijin_absen_ttd->signature_manager)) {
        $explode_signature_manager_1 = null;
        $explode_signature_manager_2 = null;
        $explode_signature_manager_3 = null;
    }else{
        $explode_signature_manager = explode('|',$ijin_absen->ijin_absen_ttd->signature_manager);
        $explode_signature_manager_1 = $explode_signature_manager[0];
        $explode_signature_manager_2 = $explode_signature_manager[1];
        $explode_signature_manager_3 = $explode_signature_manager[2];
    }

    if (empty($ijin_absen->ijin_absen_ttd->signature_bersangkutan)) {
        $explode_signature_bersangkutan_1 = null;
        $explode_signature_bersangkutan_3 = null;
        $explode_signature_bersangkutan_2 = null;
    }else{
        $explode_signature_bersangkutan = explode('|',$ijin_absen->ijin_absen_ttd->signature_bersangkutan);
        $explode_signature_bersangkutan_1 = $explode_signature_bersangkutan[0];
        $explode_signature_bersangkutan_2 = $explode_signature_bersangkutan[1];
        $explode_signature_bersangkutan_3 = $explode_signature_bersangkutan[2];
    }

    if (empty($ijin_absen->ijin_absen_ttd->signature_saksi_1)) {
        $explode_saksi_1_1 = null;
        $explode_saksi_1_2 = null;
        $explode_saksi_1_3 = null;
    }else{
        $explode_saksi_1 = explode('|',$ijin_absen->ijin_absen_ttd->signature_saksi_1);
        $explode_saksi_1_1 = $explode_saksi_1[0];
        $explode_saksi_1_2 = $explode_saksi_1[1];
        $explode_saksi_1_3 = $explode_saksi_1[2];
    }

    if (empty($ijin_absen->ijin_absen_ttd->signature_saksi_2)) {
        $explode_saksi_2_1 = null;
        $explode_saksi_2_2 = null;
        $explode_saksi_2_3 = null;
    }else{
        $explode_saksi_2 = explode('|',$ijin_absen->ijin_absen_ttd->signature_saksi_2);
        $explode_saksi_2_1 = $explode_saksi_2[0];
        $explode_saksi_2_2 = $explode_saksi_2[1];
        $explode_saksi_2_3 = $explode_saksi_2[2];
    }
@endphp
<table>
    <tr>
        <td colspan="5">
            <table style="border: 0px solid">
                <tr>
                    <td style="width: 31.7%; border-top: 0px; border-left: 0px;">
                        <div class="text-center" style="font-weight: bold;">PT Indonesian Tobacco Tbk.</div>
                        <div class="text-center">Jl. Letjen S. Parman 92 <br>Malang</div>
                    </td>
                    <td class="text-center" style="text-transform: uppercase; font-weight: bold; font-size: 14pt; width: 30%; border-top: 0px solid;">Surat Permohonan <br>Ijin Absen</td>
                    <td style="padding-left: 8%; border-top: 0px solid; border-right: 0px solid">
                        <div>NO. &nbsp;: {{ $ijin_absen->no.'-'.$ijin_absen->created_at->format('Ymd') }} </div>
                        <div>TGL. &nbsp;: {{ $ijin_absen->created_at->isoFormat('DD MMMM YYYY') }}</div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border: 0px solid; vertical-align: top">
                        <div style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%">
                            Yang bertanda tangan di bawah ini :
                        </div>
                        <div style="margin-left: 10%; margin-right: 10%; margin-top: 1%; margin-bottom: 1%">
                            {{-- <div>Nama Terang : Rio Anugrah Adam Saputra</div>
                            <div>Unit Kerja : Staff IT</div> --}}
                            <table style="border: 0px solid;">
                                <tr>
                                    <td style="border: 0px solid; width: 30%">Nama Terang</td>
                                    <td style="border: 0px solid; width: 5%">:</td>
                                    <td style="border: 0px solid; width: 65%">{{ $ijin_absen->nama.' ('.$ijin_absen->nik.')' }}</td>
                                </tr>
                                <tr>
                                    <td style="border: 0px solid;">Unit Kerja</td>
                                    <td style="border: 0px solid;">:</td>
                                    <td style="border: 0px solid;">{{ $ijin_absen->unit_kerja }}</td>
                                </tr>
                            </table>
                        </div>
                        <div style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%">
                            Memohon Ijin untuk tidak masuk kerja pada :
                        </div>
                        <div style="margin-left: 10%; margin-right: 10%; margin-top: 1%; margin-bottom: 1%">
                            {{-- <div>Hari :</div>
                            <div>Tanggal : s/d </div>
                            <div>Selama :</div>
                            <div>Untuk Keperluan :</div> --}}
                            <table style="border: 0px solid;">
                                <tr>
                                    <td style="border: 0px solid; width: 30%">Hari</td>
                                    <td style="border: 0px solid; width: 5%">:</td>
                                    <td style="border: 0px solid; width: 65%">{{ $ijin_absen->hari }}</td>
                                </tr>
                                <tr>
                                    <td style="border: 0px solid; width: 30%">Tanggal</td>
                                    <td style="border: 0px solid; width: 5%">:</td>
                                    <td style="border: 0px solid; width: 65%">{{ \Carbon\Carbon::create($ijin_absen->tgl_mulai)->isoFormat('DD MMMM YYYY') }} s/d {{ \Carbon\Carbon::create($ijin_absen->tgl_berakhir)->isoFormat('DD MMMM YYYY') }}</td>
                                </tr>
                                <tr>
                                    <td style="border: 0px solid; width: 30%">Selama</td>
                                    <td style="border: 0px solid; width: 5%">:</td>
                                    <td style="border: 0px solid; width: 65%">{{ $ijin_absen->selama }} Hari</td>
                                </tr>
                                <tr>
                                    <td style="border: 0px solid; width: 30%">Untuk Keperluan</td>
                                    <td style="border: 0px solid; width: 5%">:</td>
                                    <td style="border: 0px solid; width: 65%">{{ $ijin_absen->keperluan }}</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td style="border-top: 0px;border-bottom: 0px;border-right: 0px; vertical-align: top">
                        <div style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%">Kami yang bertanda tangan di bawah ini :</div>
                        {{-- <div style="margin-left: 8%;">
                        </div> --}}
                        {{-- <ol style="margin-left: 5%;">
                            <li>
                                <div>Nama Terang :</div>
                                <div>Unit Kerja :</div>
                            </li>
                            <li>
                                <div>Nama Terang :</div>
                                <div>Unit Kerja :</div>
                            </li>
                        </ol> --}}
                        <table style="border: 0px solid; margin-left: 5%; margin-right: 5%; margin-top: 2%; margin-bottom: 2%">
                            <tr>
                                <td style="border: 0px solid; width: 35%">1. Nama Terang</td>
                                <td style="border: 0px solid; width: 5%">:</td>
                                <td style="border: 0px solid; width: 60%">
                                    {{ $explode_saksi_1_1.' ('.$explode_saksi_1_2.')' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px solid;">&nbsp;&nbsp;&nbsp; Unit Kerja</td>
                                <td style="border: 0px solid;">:</td>
                                <td style="border: 0px solid;">{{ explode('|',$ijin_absen->saksi_1)[2] }}</td>
                            </tr>
                            <tr>
                                <td style="border: 0px solid; width: 35%">2. Nama Terang</td>
                                <td style="border: 0px solid; width: 5%">:</td>
                                <td style="border: 0px solid; width: 60%">{{ $explode_saksi_2_1.' ('.$explode_saksi_2_2.')' }}</td>
                            </tr>
                            <tr>
                                <td style="border: 0px solid;">&nbsp;&nbsp;&nbsp; Unit Kerja</td>
                                <td style="border: 0px solid;">:</td>
                                <td style="border: 0px solid;">{{ explode('|',$ijin_absen->saksi_2)[2] }}</td>
                            </tr>
                        </table>
                        {{-- <div>
                        </div> --}}
                        <div style="margin-left: 5%; margin-right: 5%; margin-top: 1%; margin-bottom: 1%; text-align: justify">Bersedia bersaksi dan dikenakan sangsi pemotongan bonus, apabila dalam kesaksian ini saya berbohong.</div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="text-center" style="text-transform: uppercase">Mengetahui</td>
        <td class="text-center" style="text-transform: uppercase">Disetujui</td>
        <td class="text-center" style="text-transform: uppercase">Pemohon</td>
        <td class="text-center" style="text-transform: uppercase">Saksi 1</td>
        <td class="text-center" style="text-transform: uppercase">Saksi 2</td>
    </tr>
    <tr>
        <td style="text-align: center; padding-top: 10px;padding-bottom: 10px;">
            @php
                $detail = [
                    'signature_manager' => 'ID: ' . $ijin_absen->id . "\n" . 
                                    'Kode Formulir: ' . $ijin_absen->no.'-'.$ijin_absen->created_at->format('Ymd') . "\n" . 
                                    'Signature: ' . $explode_signature_manager_1.' ('.$explode_signature_manager_2.')' . "\n" . 
                                    'Tanggal Formulir: ' . $ijin_absen->created_at->isoFormat('LL'),
                ];
            @endphp
            @if ($explode_signature_manager_3 == 'Approved')
            <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['signature_manager'], 'QRCODE', 1.7, 1.7) !!} . '"/>
            @elseif ($explode_signature_manager_3 == 'Waiting')
            <div>WAITING</div>
            @elseif ($explode_signature_manager_3 == 'Rejected')
            <div>REJECTED</div>
            @endif
        </td>
        <td style="text-align: center; padding-top: 10px;padding-bottom: 10px;">
            @php
                $detail = [
                    'signature_bersangkutan' => 'ID: ' . $ijin_absen->id . "\n" . 
                                    'Kode Formulir: ' . $ijin_absen->no.'-'.$ijin_absen->created_at->format('Ymd') . "\n" . 
                                    'Signature: ' . $explode_signature_bersangkutan_1.' ('.$explode_signature_bersangkutan_2.')' . "\n" . 
                                    'Tanggal Formulir: ' . $ijin_absen->created_at->isoFormat('LL'),
                ];
            @endphp
            @if ($explode_signature_bersangkutan_3 == 'Approved')
            <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['signature_bersangkutan'], 'QRCODE', 1.7, 1.7) !!} . '"/>
            @elseif ($explode_signature_bersangkutan_3 == 'Waiting')
            <div>WAITING</div>
            @elseif ($explode_signature_bersangkutan_3 == 'Rejected')
            <div>REJECTED</div>
            @endif
        </td>
        <td style="text-align: center; padding-top: 10px;padding-bottom: 10px;">
            @php
                $detail = [
                    'pemohon' => 'ID: ' . $ijin_absen->id . "\n" . 
                                    'Kode Formulir: ' . $ijin_absen->no.'-'.$ijin_absen->created_at->format('Ymd') . "\n" . 
                                    'Signature: ' . $ijin_absen->nama.' ('.$ijin_absen->nik.')' . "\n" . 
                                    'Tanggal Formulir: ' . $ijin_absen->created_at->isoFormat('LL'),
                ];
            @endphp
            <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['pemohon'], 'QRCODE', 1.7, 1.7) !!} . '"/>
        </td>
        <td style="text-align: center; padding-top: 10px;padding-bottom: 10px;">
            @php
                $detail = [
                    'saksi_1' => 'ID: ' . $ijin_absen->id . "\n" . 
                                    'Kode Formulir: ' . $ijin_absen->no.'-'.$ijin_absen->created_at->format('Ymd') . "\n" . 
                                    'Signature: ' . $explode_saksi_1_1.' ('.$explode_saksi_1_2.')' . "\n" . 
                                    'Tanggal Formulir: ' . $ijin_absen->created_at->isoFormat('LL'),
                ];
            @endphp
            @if ($explode_saksi_1_3 == 'Approved')
            <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['saksi_1'], 'QRCODE', 1.7, 1.7) !!} . '"/>
            @elseif ($explode_saksi_1_3 == 'Waiting')
            <div>WAITING</div>
            @elseif ($explode_saksi_1_3 == 'Rejected')
            <div>REJECTED</div>
            @endif
        </td>
        <td style="text-align: center; padding-top: 10px;padding-bottom: 10px;">
            @php
                $detail = [
                    'saksi_2' => 'ID: ' . $ijin_absen->id . "\n" . 
                                    'Kode Formulir: ' . $ijin_absen->no.'-'.$ijin_absen->created_at->format('Ymd') . "\n" . 
                                    'Signature: ' . $explode_saksi_2_1.' ('.$explode_saksi_2_2.')' . "\n" . 
                                    'Tanggal Formulir: ' . $ijin_absen->created_at->isoFormat('LL'),
                ];
            @endphp
            @if ($explode_saksi_2_3 == 'Approved')
            <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['saksi_2'], 'QRCODE', 1.7, 1.7) !!} . '"/>
            @elseif ($explode_saksi_2_3 == 'Waiting')
            <div>WAITING</div>
            @elseif ($explode_saksi_2_3 == 'Rejected')
            <div>REJECTED</div>
            @endif
        </td>
    </tr>
    <tr>
        <td class="text-center" style="font-size: 10pt">Mgr. Adm & Personalia</td>
        <td class="text-center" style="font-size: 10pt">{{ $explode_signature_bersangkutan[0] }}</td>
        <td class="text-center" style="font-size: 10pt">{{ $ijin_absen->nama }}</td>
        <td class="text-center" style="font-size: 10pt">{{ $explode_saksi_1[0] }}</td>
        <td class="text-center" style="font-size: 10pt">{{ $explode_saksi_2[0] }}</td>
    </tr>
</table>