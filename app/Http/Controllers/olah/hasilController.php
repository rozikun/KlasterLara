<?php

namespace App\Http\Controllers\olah;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class hasilController extends Controller
{
    //
    public function lihat()
    {
        $hasil = new \App\evaluasi;
        $sql = $hasil->ALL();
        return view('hasil',['tahun'=>$sql]);
    }
    
    public function bukadata(Request $request)
    {
        $tahun1 = $request->tahun1;
        $tahun2 = $request->tahun2;

        $ulang = $tahun2 - $tahun1 + 1;
        
        $hasil = new \App\evaluasi;
        $sql = $hasil->ALL();

        return back()->with(['ulang' => $ulang, 'hasil'=>$sql]);
    }
}
