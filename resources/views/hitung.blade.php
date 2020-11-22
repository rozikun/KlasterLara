@extends('layout.header')
@section('title','Perhitungan')
@section('title3','active')
@section('body')
    <div class="container">
        <div class="container-fluid">
            <br>
            <h4>Perhitungan</h4>
            <form action="/menghitung" method="Get">
                @csrf
                <select name="tahun" id="tahun">
                    @foreach ($tahun as $item)
                    <option value="{{$item->tahun}}">{{$item->tahun}}</option>
                    @endforeach
                </select>
                <button type="sumit" class="btn btn-info">Hitung Tahun</button>
            </form>
            <br>
            @if (!empty(session()->get('hasil')))
             <div class="card bg-dark text-white">
                 <img class="card-img-top" src="holder.js/100x180/" alt="">
                 <div class="card-body">
                     <h4 class="card-title">Hasil Perhitungan Klastering</h4>
                     <span>Dalam Bentuk Rangkuman</span>
                     <p class="card-text">
                         DBI : {{session()->get('hasil')}}
                     </p>
                     <p>Jumlah Anggota Masing-Masing Klaster</p>
                     <p>
                         Klaster 1 : {{session()->get('k1')}} &nbsp Klaster 2 : {{session()->get('k2')}} &nbsp Klaster 3 : {{session()->get('k3')}} &nbsp
                     </p>
                 </div>
                 <div class="card-footer">
                     <div class="row">
                        <div class="col">
                            <p>Hasil Lebih Detail</p>
                        </div>
                        <div class="col">
                            <a href="/hasil" class="btn btn-success form-control">Klik Untuk Lebih Detail</a>
                        </div>
                     </div>
                 </div>
             </div>    
             <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kota</th>
                                <th>Klaster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count(session()->get('klaster')); $i++)
                            <tr>
                            <td scope="row">{{$i+1}}</td>
                            <td>{{session()->get('kota')[$i]}}</td>
                            <td>{{session()->get('klaster')[$i]}}</td>
                        </tr>
                            @endfor
                        </tbody>
                    </table>          
            @endif

        </div>
    </div>
@endsection