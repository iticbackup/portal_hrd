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

    .stamp {
        /* position: relative;
        display: inline-block; */
        color: rgb(255, 0, 0);
        /* padding: 15px; */
        /* background-color: white;
        box-shadow:inset 0px 0px 0px 5px rgb(255, 0, 0); */
    }
</style>
<title>
    Surat Ijin Keluar Masuk {{ $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')'.' '.$ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') }}
</title>
<div style="text-align: right; color: black">IT/HRGA/FR/06</div>
<table>
    <tr>
        <td style="width: 30%">
            <div class="text-center" style="font-weight: bold;">PT Indonesian Tobacco Tbk.</div>
            <div class="text-center">Jl. Letjen S. Parman 92 <br>Malang</div>
        </td>
        <td class="text-center" style="text-transform: uppercase; font-weight: bold; font-size: 14pt; width: 40%">Surat Ijin <br>Keluar - Masuk</td>
        <td style="width: 30%; padding-left: 8%">
            <div>NO. &nbsp;: {{ $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') }}</div>
            <div>TGL.&nbsp;: {{ $ijin_keluar_masuk->created_at->isoFormat('DD MMMM YYYY') }}</div>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="border-bottom: 0px">
            <table style="border: 0px solid black; margin-left: 1.5%; width: 60%">
                <tr style="border: 0px solid black;">
                    <td style="border: 0px solid black; text-transform: uppercase">Nama</td>
                    <td style="border: 0px solid black;">:</td>
                    <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' }}</td>
                </tr>
                <tr style="border: 0px solid black;">
                    <td style="border: 0px solid black; text-transform: uppercase">Jabatan</td>
                    <td style="border: 0px solid black;">:</td>
                    <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jabatan }}</td>
                </tr>
                <tr style="border: 0px solid black;">
                    <td style="border: 0px solid black; text-transform: uppercase">Unit Kerja</td>
                    <td style="border: 0px solid black;">:</td>
                    <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->unit_kerja }}</td>
                </tr>
                <tr style="border: 0px solid black;">
                    <td style="border: 0px solid black; text-transform: uppercase">Jenis Keperluan</td>
                    <td style="border: 0px solid black;">:</td>
                    <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->kategori_keperluan }}</td>
                </tr>
                <tr style="border: 0px solid black;">
                    <td style="border: 0px solid black; text-transform: uppercase">Keperluan</td>
                    <td style="border: 0px solid black;">:</td>
                    <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->keperluan }}</td>
                </tr>
                <tr style="border: 0px solid black;">
                    <td style="border: 0px solid black; text-transform: uppercase">Kendaraan</td>
                    <td style="border: 0px solid black;">:</td>
                    <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->kendaraan }}</td>
                </tr>
                <tr style="border: 0px solid black;">
                    <td style="border: 0px solid black; text-transform: uppercase">Jam Kerja</td>
                    <td style="border: 0px solid black;">:</td>
                    <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_kerja }}</td>
                </tr>
                <tr style="border: 0px solid black;">
                    <td style="border: 0px solid black; text-transform: uppercase">Jam Rencana Keluar</td>
                    <td style="border: 0px solid black;">:</td>
                    <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_rencana_keluar }}</td>
                </tr>
                <tr style="border: 0px solid black;">
                    <td style="border: 0px solid black; text-transform: uppercase">Jam Datang</td>
                    <td style="border: 0px solid black;">:</td>
                    <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_datang }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@php
    // $detail = [
    //     'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
    //                     'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
    //                     'Signature: ' . $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' . "\n" . 
    //                     'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
    // ];
    // $detail_manager_bagian = [
    //     'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
    //                     'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
    //                     'Signature: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager.' '.$ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_manager . "\n" . 
    //                     'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
    // ];
    // $detail_personalia = [
    //     'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
    //                     'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
    //                     'Signature: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia.' '.$ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_personalia . "\n" . 
    //                     'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
    // ];
    // $detail_kend_satpam = [
    //     'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
    //                     'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
    //                     'Signature: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam.' '.$ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_kend_satpam . "\n" . 
    //                     'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
    // ];
    // dd($ijin_keluar_masuk->ijin_keluar_masuk_ttd);
@endphp
<table>
    <tr>
        <td class="text-center" style="width: 25%">Pemohon</td>
        <td class="text-center" style="width: 25%">Mengetahui</td>
        <td class="text-center" style="width: 25%">Mengetahui</td>
        <td class="text-center" style="width: 25%">Mengetahui</td>
    </tr>
    <tr>
        <td style="text-align: center; padding-top: 10px;padding-bottom: 10px;">
            @php
                $detail = [
                    'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                    'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                    'Signature: ' . $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' . "\n" . 
                                    'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                ];
            @endphp
            <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail['identifier'], 'QRCODE', 2, 2) !!} . '"/>
        </td>
        <td style="text-align: center; padding-top: 10px;padding-bottom: 10px;">
            @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager))
            <div>-</div>
            @else
                @php
                    $explode_validasi_manager_bagian = explode('|',$ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager);
                    $detail_manager_bagian = [
                        'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                        'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                        'Signature: ' . $explode_validasi_manager_bagian[0].' ('.$explode_validasi_manager_bagian[1].') '. "\n" . 
                                        'Status Signature: ' . $explode_validasi_manager_bagian[2] . "\n" . 
                                        'Signature Date: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_manager . "\n" . 
                                        'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                    ];
                @endphp
                @if ($explode_validasi_manager_bagian[2] == 'Approved')
                {{-- <img src="data:image/png;base64,' . {!! \Image::make(public_path('logo/logo-itic.png'))->resize(42,60) !!} . '"/> --}}
                <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail_manager_bagian['identifier'], 'QRCODE', 2, 2) !!} . '"/>
                @elseif ($explode_validasi_manager_bagian[2] == 'Rejected')
                <div>REJECTED</div>
                @else
                <div>-</div>
                @endif
            @endif
        </td>
        <td style="text-align: center; padding-top: 10px;padding-bottom: 10px;">
            @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia))
            <div>-</div>
            @else
                @php
                    $explode_validasi_personalia = explode('|',$ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia);
                    $detail_personalia = [
                        'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                        'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                        'Signature: ' . $explode_validasi_personalia[0].' ('.$explode_validasi_personalia[1].') '. "\n" . 
                                        'Status Signature: ' . $explode_validasi_personalia[2] . "\n" . 
                                        'Signature Date: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_personalia . "\n" . 
                                        'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                    ];
                @endphp
                @if ($explode_validasi_personalia[2] == 'Approved')
                <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail_personalia['identifier'], 'QRCODE', 2, 2) !!} . '"/>
                @elseif ($explode_validasi_personalia[2] == 'Rejected')
                <div>REJECTED</div>
                @else
                <div>-</div>
                @endif
            @endif
        </td>
        <td style="text-align: center; padding-top: 10px;padding-bottom: 10px;">
            @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam))
            <div>-</div>
            @else
                @php
                    $explode_validasi_kend_satpam = explode('|',$ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam);
                    $detail_kend_satpam = [
                        'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                        'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                        'Signature: ' . $explode_validasi_kend_satpam[0].' ('.$explode_validasi_kend_satpam[1].') '. "\n" . 
                                        'Status Signature: ' . $explode_validasi_kend_satpam[2] . "\n" . 
                                        'Signature Date: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_kend_satpam . "\n" . 
                                        'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                    ];
                @endphp
                @if ($explode_validasi_kend_satpam[2] == 'Approved')
                <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG($detail_kend_satpam['identifier'], 'QRCODE', 2, 2) !!} . '"/>
                @elseif ($explode_validasi_kend_satpam[2] == 'Rejected')
                <div class="stamp">REJECTED</div>
                @else
                <div>-</div>
                @endif
            @endif
        </td>
    </tr>
    <tr>
        <td class="text-center">{{ $ijin_keluar_masuk->nama }}</td>
        <td class="text-center">Manager Bagian</td>
        <td class="text-center">Personalia</td>
        <td class="text-center">Ka, Kend / Satpam</td>
    </tr>
</table>