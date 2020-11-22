@extends('layout.header')
@section('title','Hasil Perhitungan')
@section('title4','active')
@section('body')

<div class="container">
    <div class="container-fluid">
        <br>
        <h3>Hasil Perhitungan</h3>
      
        <form action="/hasilD" method="GET">
            @csrf
            <div class="form-row">
                <div class="col">
                    <span>Dari Tahun</span>
                    <select name="tahun1" id="tahun1" class="form-control">
                            @foreach ($tahun as $item)
                                <option value="{{$item->tahun}}">{{$item->tahun}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col">
                    <span>Ke-Tahun</span>
                    <select name="tahun2" id="tahun2" class="form-control">
                            @foreach ($tahun as $item)
                                <option value="{{$item->tahun}}">{{$item->tahun}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                <button type="submit" class="btn btn-info">Tampilkan Hasil</button>
                </div>
            </div>
        </form>
        @if (!empty(session()->get('ulang')))
        <br>
        <span>Hasil Pencarian:</span>
            <div class="row">
                @for ($i = 0; $i < session()->get('ulang'); $i++)
                    <div class="col">
                        <div class="card text-white bg-dark">
                          <div class="card-body">
                          <h4 class="card-title">Tahun {{session()->get('hasil')[$i]->tahun}}</h4>
                            <p class="card-text">
                                Klaster 1 : {{session()->get('hasil')[$i]->Klas1}} &nbsp Klaster 2 : {{session()->get('hasil')[$i]->Klas2}} &nbsp Klaster 3 : {{session()->get('hasil')[$i]->Klas3}} &nbsp
                            </p>
                            <h5>Hasil DBI : {{session()->get('hasil')[$i]->DBI}}</h5>
                          </div>
                        </div>
                    </div>
                @endfor
            </div>
        @endif
    </div>
</div>

@endsection