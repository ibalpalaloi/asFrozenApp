@extends('layouts.admin')

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Diskon</th>
                            <th>Tgl Awal</th>
                            <th>Tgl Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diskon as $data)
                            <tr>
                                <td>{{$data->produk->nama}}</td>
                                <td>{{$data->diskon}}</td>
                                <td>{{$data->diskon_mulai}}</td>
                                <td>{{$data->diskon_akhir}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection