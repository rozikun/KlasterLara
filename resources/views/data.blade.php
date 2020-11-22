@extends('layout.header')
@section('title','Data')
@section('title2','active')
@section('body')

    <div class="container">
        <h3>Data</h3>
        <p>Tambah Data</p>
        <form action="/input" method="POST" enctype="multipart/form-data">
            @csrf
            <p>Upload Data</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                </div>
            @endif
            <input type="file" name="filenya" id="">
            <button type="submit" class="btn btn-info">Upload Data</button>
        </form>
        <br>
        {{-- Wilayah Tabel --}}
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th class="center">No</th>
                    <th class="center">Kota</th>
                    <th class="center">Siswa</th>
                    <th class="center">Sekolah</th>
                    <th class="center">TI</th>
                    <th class="center">DKV</th>
                    <th class="center">PBM</th>
                    <th class="center">AK</th>
                    <th class="center">Tahun</th>
                    <th class="center">Aksi</th>
                </tr>
            </thead>
            <tbody>
               @for ($i = 0; $i < count($dataku); $i++)
                <tr>
                <td scope="row">{{$dataku[$i]->id}}</td>
                    <td>{{$dataku[$i]->kota}}</td>
                    <td>{{$dataku[$i]->siswa}}</td>
                    <td>{{$dataku[$i]->sekolah}}</td>
                    <td>{{$dataku[$i]->TI}}</td>
                    <td>{{$dataku[$i]->DKV}}</td>
                    <td>{{$dataku[$i]->PBM}}</td>
                    <td>{{$dataku[$i]->Akuntansi}}</td>
                    <td>{{$dataku[$i]->tahun}}</td>
                    <td>
                        <div class="row">
                            <div clas=col>
                            <a href="/update/{{$dataku[$i]->id}}" class="btn btn-warning">Update Data</a>
                            </div>
                            &nbsp
                            <div clas=col>
                                <a href="/delete/{{$dataku[$i]->id}}" class="btn btn-danger">Delete Data</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection