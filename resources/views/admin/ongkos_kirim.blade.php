@extends('layouts.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection

@section('body')

{{-- modal ubah ongkir --}}
<div class="modal" tabindex="-1" role="dialog" id="modal_ubah_ongkir">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Ongkir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?=url('/')?>/admin-post-ubah-ongkir" method="post">
                @csrf
                <input type="text" name="id_kelurahan" id="input_id_kelurahan" hidden>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Ongkir</label>
                    <input type="number" class="form-control" id="input_ongkir" name="ongkir">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </form>
      </div>
    </div>
  </div>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="card">
              <div class="card-body">
                  <br><br>
                    <table id="example1" class="table">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kelurahan</th>
                              <th>Ongkos Kirim</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $no=1;
                          @endphp
                          @foreach ($ongkos_kirim as $data)
                              <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$data['kelurahan']}}</td>
                                  <td>Rp. {{number_format($data['ongkir'],0,',','.')}}</td>
                                  <td>
                                    <button onclick="modal_ubah_ongkir('{{$data['id_kelurahan']}}', '{{$data['ongkir']}}')" type="button" class="btn btn-primary">Ubah Ongkir</button>
                                  </td>
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

@section('footer')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    } );

    function modal_ubah_ongkir(id_kelurahan, ongkir){
        $('#input_id_kelurahan').val(id_kelurahan);
        $('#input_ongkir').val(ongkir);
        $('#modal_ubah_ongkir').modal('show');
    }
</script>
@endsection