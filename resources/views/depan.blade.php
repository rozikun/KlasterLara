@extends('layout.header')
@section('title','Halaman Awal')
@section('title1','active')
@section('body')
    <div class="container">
        <div class="container-fluid">
            <br>
            Anda Memasuki Halaman Awal Kami
            @if (session()->has('msg'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Oops!</strong> Tampaknya Kamu Belum Login. untuk login silahkan <a href="/login" class="link">kesini</a>.
                </div>
            @endif
        </div>
    </div>
@endsection