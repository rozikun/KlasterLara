<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    protected $table = 'datas';
    protected $fillable = ['kota','siswa','sekolah','TI','DKV','PBM','Akuntansi','tahun','created_at','updated_at'];
    //
}
