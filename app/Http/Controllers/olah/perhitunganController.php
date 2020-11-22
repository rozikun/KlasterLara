<?php

namespace App\Http\Controllers\olah;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class perhitunganController extends Controller
{
    public function tampil()
    {
        $data = new \App\data;
        $sql = $data::distinct('tahun')->Get('tahun');
        return view('hitung',['tahun'=>$sql]);
    }

    public function hitung(Request $request)
    {
        $hasil = new \App\evaluasi;
        $data = new \App\data;
        $sql = $data::where('tahun',$request->tahun)->get();

        $rsiswa = $data::where('tahun',$request->tahun)->avg('siswa');
        $rsekolah = $data::where('tahun', $request->tahun)->avg('sekolah');
        $rti = $data::where('tahun', $request->tahun)->avg('TI');
        $rdkv = $data::where('tahun', $request->tahun)->avg('DKV');
        $rpbm = $data::where('tahun', $request->tahun)->avg('PBM');
        $rak = $data::where('tahun', $request->tahun)->avg('Akuntansi');
        
        for ($i=0; $i < count($sql) ; $i++) { 
            $siswa[$i]   = $sql[$i]->siswa;            
            $sekolah[$i] = $sql[$i]->sekolah;
            $ti[$i]      = $sql[$i]->TI;
            $dkv[$i]     = $sql[$i]->DKV;
            $pbm[$i]     = $sql[$i]->PBM;
            $ak[$i]      = $sql[$i]->Akuntansi;
        }

        //Perhitungan Deviasi Siswa
        $Ssiswa = pow($siswa[0]-$rsiswa,2) + pow($siswa[1]-$rsiswa,2);
        for ($i=2; $i < count($siswa); $i++) { 
            $Ssiswa = $Ssiswa + pow($siswa[$i]-$rsiswa,2);
        }
        $DevSiswa = round(sqrt( $Ssiswa / (count($siswa)-1) ), 9 );
        
        //Perhitungan Deviasi Sekolah
        $Ssekolah = pow($sekolah[0]-$rsekolah,2) + pow($sekolah[1]-$rsekolah,2);
        for ($i=2; $i < count($sekolah); $i++) { 
            $Ssekolah = $Ssekolah + pow($sekolah[$i]-$rsekolah,2);
        }
        $DevSekolah = round(sqrt( $Ssekolah / (count($sekolah)-1) ), 9 );
        
        //Perhitungan Deviasi TI
        $Ssti = pow($ti[0]-$rti,2) + pow($ti[1]-$rti,2);
        for ($i=2; $i < count($ti); $i++) { 
            $Ssti = $Ssti + pow($ti[$i]-$rti,2);
        }
        $DevTi = round(sqrt( $Ssti / (count($ti)-1) ), 9 );
        
        //Perhitungan Deviasi DKV
        $Sdkv = pow($dkv[0]-$rdkv,2) + pow($dkv[1]-$rdkv,2);
        for ($i=2; $i < count($dkv); $i++) { 
            $Sdkv = $Sdkv + pow($dkv[$i]-$rdkv,2);
        }
        $DevDkv = round(sqrt( $Sdkv / (count($dkv)-1) ), 9 );

        //Perhitungan Deviasi PBM
        $Spbm = pow($pbm[0]-$rpbm,2) + pow($pbm[1]-$rpbm,2);
        for ($i=2; $i < count($pbm); $i++) { 
            $Spbm = $Spbm + pow($pbm[$i]-$rpbm,2);
        }
        $DevPbm = round(sqrt( $Spbm / (count($pbm)-1) ), 9 );
        
        //Perhitungan Deviasi Akuntansi
        $Sak = pow($ak[0]-$rak,2) + pow($ak[1]-$rak,2);
        for ($i=2; $i < count($ak); $i++) { 
            $Sak = $Sak + pow($ak[$i]-$rak,2);
        }
        $DevAk = round(sqrt( $Sak / (count($ak)-1) ), 9 );

        //Zscore Dan Perhitungan
        $zSiswa = array();
        $zSekolah = array();
        $zTI = array();
        $zDKV = array();
        $zPBM = array();
        $zAK = array();
        $c1 = array();
        $c2 = array();
        $c3 = array();
        $klaster = array();
        $klasterb = array();
        $k1s = array(); $k1se = array(); $k1ti = array(); $k1dkv = array(); $k1pbm = array(); $k1ak = array();
        $k2s = array(); $k2se = array(); $k2ti = array(); $k2dkv = array(); $k2pbm = array(); $k2ak = array();
        $k3s = array(); $k3se = array(); $k3ti = array(); $k3dkv = array(); $k3pbm = array(); $k3ak = array();

        // Zscore
        for ($i=0; $i < count($sql) ; $i++) { 
            # code...
            $kota[$i] = $sql[$i]->kota;
            $zSiswa[$i] = round( ( $sql[$i]->siswa - $rsiswa ) / $DevSiswa, 9 );
            $zSekolah[$i] = round( ( $sql[$i]->sekolah - $rsekolah ) / $DevSekolah, 9 );
            $zTI[$i] = round( ( $sql[$i]->TI - $rti ) / $DevTi, 9 );
            $zDKV[$i] = round( ( $sql[$i]->DKV - $rdkv ) / $DevDkv, 9 );
            $zPBM[$i] = round( ( $sql[$i]->PBM - $rpbm ) / $DevPbm, 9 );
            $zAK[$i] = round( ( $sql[$i]->Akuntansi - $rak ) / $DevAk, 9 );
        }
        //zscore terpilih
            $sqlter1 = $data::where('kota','Banyuwangi')->get();
            $sqlter2 = $data::where('kota','Bekasi')->get();
            $sqlter3 = $data::where('kota','Malang')->get();
        // Terpilih 1
            $zSiswaTer[0] = round( ( $sqlter1[0]->siswa - $rsiswa ) / $DevSiswa, 9 );
            $zSekolahTer[0] = round( ( $sqlter1[0]->sekolah - $rsekolah ) / $DevSekolah, 9 );
            $zTITer[0] = round( ( $sqlter1[0]->TI - $rti ) / $DevTi, 9 );
            $zDKVTer[0] = round( ( $sqlter1[0]->DKV - $rdkv ) / $DevDkv, 9 );
            $zPBMTer[0] = round( ( $sqlter1[0]->PBM - $rpbm ) / $DevPbm, 9 );
            $zAKTer[0] = round( ( $sqlter1[0]->Akuntansi - $rak ) / $DevAk, 9 );
         // Terpilih 2
            $zSiswaTer[1] = round( ( $sqlter2[0]->siswa - $rsiswa ) / $DevSiswa, 9 );
            $zSekolahTer[1] = round( ( $sqlter2[0]->sekolah - $rsekolah ) / $DevSekolah, 9 );
            $zTITer[1] = round( ( $sqlter2[0]->TI - $rti ) / $DevTi, 9 );
            $zDKVTer[1] = round( ( $sqlter2[0]->DKV - $rdkv ) / $DevDkv, 9 );
            $zPBMTer[1] = round( ( $sqlter2[0]->PBM - $rpbm ) / $DevPbm, 9 );
            $zAKTer[1] = round( ( $sqlter2[0]->Akuntansi - $rak ) / $DevAk, 9 );
         // Terpilih 3
            $zSiswaTer[2] = round( ( $sqlter3[0]->siswa - $rsiswa ) / $DevSiswa, 9 );
            $zSekolahTer[2] = round( ( $sqlter3[0]->sekolah - $rsekolah ) / $DevSekolah, 9 );
            $zTITer[2] = round( ( $sqlter3[0]->TI - $rti ) / $DevTi, 9 );
            $zDKVTer[2] = round( ( $sqlter3[0]->DKV - $rdkv ) / $DevDkv, 9 );
            $zPBMTer[2] = round( ( $sqlter3[0]->PBM - $rpbm ) / $DevPbm, 9 );
            $zAKTer[2] = round( ( $sqlter3[0]->Akuntansi - $rak ) / $DevAk, 9 );

        //klasterisas Iterasi 1
        for ($i=0; $i < count($kota) ; $i++) { 
            $c1[$i] = sqrt(pow($zSiswa[$i]-$zSiswaTer[0], 2 ) + pow($zSekolah[$i] - $zSekolahTer[0], 2) + pow($zTI[$i] - $zTITer[0], 2) + pow($zDKV[$i] - $zDKVTer[0], 2) + pow($zPBM[$i] - $zPBMTer[0], 2) + pow($zAK[$i] - $zAKTer[0], 2) );
            $c2[$i] = sqrt(pow($zSiswa[$i]-$zSiswaTer[1], 2 ) + pow($zSekolah[$i] - $zSekolahTer[1], 2) + pow($zTI[$i] - $zTITer[1], 2) + pow($zDKV[$i] - $zDKVTer[1], 2) + pow($zPBM[$i] - $zPBMTer[1], 2) + pow($zAK[$i] - $zAKTer[1], 2) );
            $c3[$i] = sqrt(pow($zSiswa[$i]-$zSiswaTer[2], 2 ) + pow($zSekolah[$i] - $zSekolahTer[2], 2) + pow($zTI[$i] - $zTITer[2], 2) + pow($zDKV[$i] - $zDKVTer[2], 2) + pow($zPBM[$i] - $zPBMTer[2], 2) + pow($zAK[$i] - $zAKTer[2], 2) );
            if ($c1[$i] < $c2[$i] && $c1[$i] < $c3[$i]) {
                $klaster[$i] = 1;
                array_push($k1s,$zSiswa[$i]);
                array_push($k1se,$zSekolah[$i]);
                array_push($k1ti,$zTI[$i]);
                array_push($k1dkv,$zDKV[$i]);
                array_push($k1pbm,$zPBM[$i]);
                array_push($k1ak,$zAK[$i]);
            }elseif($c2[$i] < $c1[$i] && $c2[$i] < $c3[$i]){
                $klaster[$i] = 2;
                array_push($k2s,$zSiswa[$i]);
                array_push($k2se,$zSekolah[$i]);
                array_push($k2ti,$zTI[$i]);
                array_push($k2dkv,$zDKV[$i]);
                array_push($k2pbm,$zPBM[$i]);
                array_push($k2ak,$zAK[$i]);
            }else{
                $klaster[$i] = 3;
                array_push($k3s,$zSiswa[$i]);
                array_push($k3se,$zSekolah[$i]);
                array_push($k3ti,$zTI[$i]);
                array_push($k3dkv,$zDKV[$i]);
                array_push($k3pbm,$zPBM[$i]);
                array_push($k3ak,$zAK[$i]);
            }
       }
       
       //centroid Baru
        $CentroSiswa[0] =  array_sum($k1s) / count($k1s);
        $CentroSiswa[1] =  array_sum($k2s) / count($k2s);
        $CentroSiswa[2] =  array_sum($k3s) / count($k3s);
        $CentroSekolah[0] = array_sum($k1se) / count($k1se);
        $CentroSekolah[1] = array_sum($k2se) / count($k2se);
        $CentroSekolah[2] = array_sum($k3se) / count($k3se);
        $CentroTi[0] = array_sum($k1ti) / count($k1ti);
        $CentroTi[1] = array_sum($k2ti) / count($k2ti);
        $CentroTi[2] = array_sum($k3ti) / count($k3ti);
        $CentroDkv[0] = array_sum($k1dkv) / count($k1dkv);
        $CentroDkv[1] = array_sum($k2dkv) / count($k2dkv);
        $CentroDkv[2] = array_sum($k3dkv) / count($k3dkv);
        $CentroPbm[0] = array_sum($k1pbm) / count($k1pbm);
        $CentroPbm[1] = array_sum($k2pbm) / count($k2pbm);
        $CentroPbm[2] = array_sum($k3pbm) / count($k3pbm);
        $CentroAk[0] = array_sum($k1ak) / count($k1ak);
        $CentroAk[1] = array_sum($k2ak) / count($k2ak);
        $CentroAk[2] = array_sum($k3ak) / count($k3ak);
        
        //hitung dengan do while
        do {
            //reset untuk perhitungan centroid baru
        unset($k1s); unset($k1se); unset($k1ti); unset($k1dkv); unset($k1pbm); unset($k1ak);
        unset($k2s); unset($k2se); unset($k2ti); unset($k2dkv); unset($k2pbm); unset($k2ak);
        unset($k3s); unset($k3se); unset($k3ti); unset($k3dkv); unset($k3pbm); unset($k3ak);
        unset($validasi);
        $k1s = array(); $k1se = array(); $k1ti = array(); $k1dkv = array(); $k1pbm = array(); $k1ak = array();
        $k2s = array(); $k2se = array(); $k2ti = array(); $k2dkv = array(); $k2pbm = array(); $k2ak = array();
        $k3s = array(); $k3se = array(); $k3ti = array(); $k3dkv = array(); $k3pbm = array(); $k3ak = array();

        $validasi = array();
        for ($i=0; $i < count($kota) ; $i++) { 
            $c1[$i] = round(sqrt(pow($zSiswa[$i]-$CentroSiswa[0], 2 ) + pow($zSekolah[$i] - $CentroSekolah[0], 2) + pow($zTI[$i] - $CentroTi[0], 2) + pow($zDKV[$i] - $CentroDkv[0], 2) + pow($zPBM[$i] - $CentroPbm[0], 2) + pow($zAK[$i] - $CentroAk[0], 2) ), 10);
            $c2[$i] = round(sqrt(pow($zSiswa[$i]-$CentroSiswa[1], 2 ) + pow($zSekolah[$i] - $CentroSekolah[1], 2) + pow($zTI[$i] - $CentroTi[1], 2) + pow($zDKV[$i] - $CentroDkv[1], 2) + pow($zPBM[$i] - $CentroPbm[1], 2) + pow($zAK[$i] - $CentroAk[1], 2) ), 10);
            $c3[$i] = round(sqrt(pow($zSiswa[$i]-$CentroSiswa[2], 2 ) + pow($zSekolah[$i] - $CentroSekolah[2], 2) + pow($zTI[$i] - $CentroTi[2], 2) + pow($zDKV[$i] - $CentroDkv[2], 2) + pow($zPBM[$i] - $CentroPbm[2], 2) + pow($zAK[$i] - $CentroAk[2], 2) ), 10);
            if ($c1[$i] < $c2[$i] && $c1[$i] < $c3[$i]) {
                $klasterb[$i] = 1;
                array_push($k1s,$zSiswa[$i]);
                array_push($k1se,$zSekolah[$i]);
                array_push($k1ti,$zTI[$i]);
                array_push($k1dkv,$zDKV[$i]);
                array_push($k1pbm,$zPBM[$i]);
                array_push($k1ak,$zAK[$i]);
            }elseif($c2[$i] < $c1[$i] && $c2[$i] < $c3[$i]){
                $klasterb[$i] = 2;
                array_push($k2s,$zSiswa[$i]);
                array_push($k2se,$zSekolah[$i]);
                array_push($k2ti,$zTI[$i]);
                array_push($k2dkv,$zDKV[$i]);
                array_push($k2pbm,$zPBM[$i]);
                array_push($k2ak,$zAK[$i]);
            }else{
                $klasterb[$i] = 3;
                array_push($k3s,$zSiswa[$i]);
                array_push($k3se,$zSekolah[$i]);
                array_push($k3ti,$zTI[$i]);
                array_push($k3dkv,$zDKV[$i]);
                array_push($k3pbm,$zPBM[$i]);
                array_push($k3ak,$zAK[$i]);
            }

            if ($klaster[$i] == $klasterb[$i]) {
                array_push($validasi,"Sama");
            }else{
                array_push($validasi,"Berbeda");
                $klaster[$i] = $klasterb[$i];
            }
            }

            //Hitung Centroid lagi
            $CentroSiswa[0] =  array_sum($k1s) / count($k1s);
            $CentroSiswa[1] =  array_sum($k2s) / count($k2s);
            $CentroSiswa[2] =  array_sum($k3s) / count($k3s);
            $CentroSekolah[0] = array_sum($k1se) / count($k1se);
            $CentroSekolah[1] = array_sum($k2se) / count($k2se);
            $CentroSekolah[2] = array_sum($k3se) / count($k3se);
            $CentroTi[0] = array_sum($k1ti) / count($k1ti);
            $CentroTi[1] = array_sum($k2ti) / count($k2ti);
            $CentroTi[2] = array_sum($k3ti) / count($k3ti);
            $CentroDkv[0] = array_sum($k1dkv) / count($k1dkv);
            $CentroDkv[1] = array_sum($k2dkv) / count($k2dkv);
            $CentroDkv[2] = array_sum($k3dkv) / count($k3dkv);
            $CentroPbm[0] = array_sum($k1pbm) / count($k1pbm);
            $CentroPbm[1] = array_sum($k2pbm) / count($k2pbm);
            $CentroPbm[2] = array_sum($k3pbm) / count($k3pbm);
            $CentroAk[0] = array_sum($k1ak) / count($k1ak);
            $CentroAk[1] = array_sum($k2ak) / count($k2ak);
            $CentroAk[2] = array_sum($k3ak) / count($k3ak);
        }while(array_count_values($validasi)['Sama'] != count($kota) );
        
        //Simpan Ke DataBase
        
    //Proses Perhitungan DBI Evaluation
    //Pencarian SSW1
    for ($i=0; $i < count($k1s); $i++) { 
        $sw1[$i] = round(pow($k1s[$i]-$CentroSiswa[0], 2 ) + pow($k1se[$i] - $CentroSekolah[0], 2) + pow($k1ti[$i] - $CentroTi[0], 2) + pow($k1dkv[$i] - $CentroDkv[0], 2) + pow($k1pbm[$i] - $CentroPbm[0], 2) + pow($k1ak[$i] - $CentroAk[0], 2 ), 9);
    }
    $ssw1 = array_sum($sw1) / count($sw1);
  
    //Pencarian SSW2
    for ($i=0; $i < count($k2s); $i++) { 
        $sw2[$i] = round(pow($k2s[$i]-$CentroSiswa[1], 2 ) + pow($k2se[$i] - $CentroSekolah[1], 2) + pow($k2ti[$i] - $CentroTi[1], 2) + pow($k2dkv[$i] - $CentroDkv[1], 2) + pow($k2pbm[$i] - $CentroPbm[1], 2) + pow($k2ak[$i] - $CentroAk[1], 2 ), 9);
    }
    $ssw2 = array_sum($sw2) / count($sw2);
    
    //Pencarian SSW3
    for ($i=0; $i < count($k3s); $i++) { 
        $sw3[$i] = round(pow($k3s[$i]-$CentroSiswa[2], 2 ) + pow($k3se[$i] - $CentroSekolah[2], 2) + pow($k3ti[$i] - $CentroTi[2], 2) + pow($k3dkv[$i] - $CentroDkv[2], 2) + pow($k3pbm[$i] - $CentroPbm[2], 2) + pow($k3ak[$i] - $CentroAk[2], 2  ), 9);
    }
    $ssw3 = array_sum($sw3) / count($sw3);

    // Pencarian SSB 
    $ssb = sqrt(( pow($CentroSiswa[0] - $CentroSiswa[1] - $CentroSiswa[2] ,2) ) + ( pow( $CentroSekolah[0] - $CentroSekolah[1] - $CentroSekolah[2] ,2) ) + ( pow($CentroTi[0] - $CentroTi[1] - $CentroTi[2], 2) ) + ( pow($CentroDkv[0] - $CentroDkv[1] - $CentroDkv[2],2)) + ( pow($CentroPbm[0] - $CentroPbm[1] - $CentroPbm[2],2)) + ( pow($CentroAk[0] - $CentroAk[1] - $CentroAk[2],2) ));

    $ssb1 = abs( ($CentroSiswa[0] - $CentroSiswa[1]) + (  $CentroSekolah[0] - $CentroSekolah[1])  + ($CentroTi[0] - $CentroTi[1])  + ($CentroDkv[0] - $CentroDkv[1]) + ( $CentroPbm[0] - $CentroPbm[1] ) + ($CentroAk[0] - $CentroAk[1] ) );
    $ssb2 = abs( ($CentroSiswa[0] - $CentroSiswa[2]) + (  $CentroSekolah[0] - $CentroSekolah[2])  + ($CentroTi[0] - $CentroTi[2])  + ($CentroDkv[0] - $CentroDkv[2]) + ( $CentroPbm[0] - $CentroPbm[2] ) + ($CentroAk[0] - $CentroAk[2] ) );
    $ssb3 = abs( ($CentroSiswa[1] - $CentroSiswa[2]) + (  $CentroSekolah[1] - $CentroSekolah[2])  + ($CentroTi[1] - $CentroTi[2])  + ($CentroDkv[1] - $CentroDkv[2]) + ( $CentroPbm[1] - $CentroPbm[2] ) + ($CentroAk[1] - $CentroAk[2] ) );

    $ratio = round( ($ssw1 + $ssw2 + $ssw3) / $ssb,8 );
    
    $rab = ($ssw1 + $ssw2) / $ssb1;
    $rac = ($ssw1 + $ssw3) / $ssb2;
    $rbc = ($ssw2 + $ssw3) / $ssb3;

    $dmax1 = max($rab,$rac);
    $dmax2 = max($rab,$rbc);
    $dmax3 = max($rac,$rbc);

    //dbi
    $dbi = ($dmax1+$dmax2+$dmax3)/3;
    
    $simpan = $hasil->updateOrCreate(['tahun' => $request->tahun],[
        'Klas1' => count($k1s),
        'Klas2' => count($k2s),
        'Klas3' => count($k3s),
        'SSW1' => $ssw1,
        'SSW2' => $ssw2,
        'SSW3' => $ssw3,
        'SSB'  => $ssb1,
        'DBI'  => $dbi,
    ]);


    // $simpan = $hasil->create([
    //     'tahun' => $request->tahun,
    //     'Klas1' => count($k1s),
    //     'Klas2' => count($k2s),
    //     'Klas3' => count($k3s),
    //     'SSW1' => $ssw1,
    //     'SSW2' => $ssw2,
    //     'SSW3' => $ssw3,
    //     'SSB'  => $ssb1,
    //     'DBI'  => $dbi,
    // ])->save();
    
    return back()->with(['hasil' => $dbi,'k1' => count($k1s),'k2' => count($k2s),'k3' => count($k3s),'kota' => $kota,'klaster'=>$klaster ]);
        
    }
   
}
