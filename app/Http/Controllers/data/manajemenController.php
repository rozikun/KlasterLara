<?php

namespace App\Http\Controllers\data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\dataImport;
use Excel;

class manajemenController extends Controller
{
    public function tampil()
    {
        $data = new \App\data;
        $sql = $data::All();
        
         return view('data',['dataku'=>$sql]);
    }

    public function olahkeun(Request $request)
    {
        //kenali table 
        $data = new \App\data;

        //validate data
        $this->validate($request, [
            'filenya'  => 'required|file|mimes:xls,xlsx'
        ]);


        $path = $request->file('filenya')->getRealPath();
        // $excel = EXCEL::load($path)->Get();
        $excel = Excel::import(new dataImport, $request->filenya);
        
        return redirect('/lihat');
    }
    
    //edit
    public function editGet($id)
    {
        $data = new \App\data;
        $sql = $data::where('id',$id)->Get();

        return view('/updatekeun',['ambil'=>$sql]);
    }

    public function editPost(Request $request)
    {
        $data = new \App\data;
        $sql = $data::where('id',$request->id)->update([
            'kota' => $request->kota,
            'siswa' => $request->siswa,
            'sekolah' => $request->sekolah,
            'TI'  => $request->ti,
            'DKV' => $request->dkv,
            'PBM' => $request->pbm,
            'Akuntansi' => $request->ak,
            'tahun' => $request->tahun
        ]);
        
        return redirect('/lihat');
    }

    //delete
    public function hapus($id)
    {
        $data = new \App\data;
        $sql = $data::where('id',$id)->delete();

        return redirect('/lihat');
    }
}
