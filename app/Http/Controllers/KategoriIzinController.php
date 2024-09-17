<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriIzin;
use \Carbon\Carbon;

use Validator;
use DataTables;

class KategoriIzinController extends Controller
{
    function __construct(
        KategoriIzin $kategori_izin
    ){
        $this->kategori_izin = $kategori_izin;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->kategori_izin->all();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){

                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }

        return view('backend.kategori_izin.index');
    }

    public function create()
    {
        return view('backend.kategori_izin.create');
    }
}
