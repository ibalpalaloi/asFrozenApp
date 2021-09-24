@extends('layouts.admin')

@section('header')
    <style>
        th, td {
            padding: 15px;
            }
    </style>
@endsection

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="card">
              <div class="card-body">
                <table>
                    @foreach ($banner as $data)
                        <tr>
                            <td>
                                <img height="200px" width="650px" src="<?=url('/')?>/img/banner/{{$data->foto}}" alt="...">
                            </td>
                            <td>
                                <button onclick="modal_ubah_foto('{{$data->id}}')">Ubah</button>
                                <button>hapus</button>
                            </td>
                        </tr>
                    @endforeach
                    
                </table>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection