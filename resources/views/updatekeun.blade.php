@extends('layout.header')
@section('title',"Update Data")
@section('title2','active')
@section('body')
    
<div class="container">
<div class="container-fluid">
    <br>
<h4>Update Data {{$ambil[0]->kota}} Tahun {{$ambil[0]->tahun}}</h4>
<form action="/edit" method="post">
    @csrf
    <div class="form-row">
        <span>Kota</span>
        <input type="text" name="kota" id="kota" class="form-control" value="{{$ambil[0]->kota}}">
        <span><br>Jumlah Siswa</span>
        <input type="text" name="siswa" id="siswa" class="form-control" value="{{$ambil[0]->siswa}}">
        <span><br>Jumlah Sekolah</span>
        <input type="text" name="sekolah" id="sekolah" class="form-control" value="{{$ambil[0]->sekolah}}">        
        <div class="col">
        <span><br>TI</span>
        <input type="number" name="ti" id="ti" class="form-control" value="{{$ambil[0]->TI}}">
        </div>
        <div class="col">
        <span><br>DKV</span>
        <input type="number" name="dkv" id="dkv" class="form-control"value="{{$ambil[0]->DKV}}">
        </div>
        <div class="col">
        <Span><br>PBM</Span>
        <input type="number" name="pbm" id="pbm" class="form-control"value="{{$ambil[0]->PBM}}">
        </div>
        <div class="col">
        <span><br>Akuntansi</span>
        <input type="number" name="ak" id="ak" class="form-control"value="{{$ambil[0]->Akuntansi}}">
        </div>
    </div>
        <span><br>Tahun</span>
        <input type="number" name="tahun" id="tahun" class="form-control"value="{{$ambil[0]->tahun}}">
        <br>
        <input type="hidden" name="id" value="{{$ambil[0]->id}}">
        <div class="row">

            <div class="col">
                <button type="submit" class="btn btn-success form-control">Edit Data</button>
            </div>
            <div class="col">
            <a href="/lihat" class="btn btn-dark form-control">Kembali</a>
            </div>
        </div>
</form>
</div>
</div>
@endsection