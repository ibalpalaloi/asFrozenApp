@extends('layouts.admin')

@section('body')


{{--  --}}
<div class="modal fade bd-example-modal-lg" id="modal_detail_pesanan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="content_modal_detail">
          
      </div>
    </div>
</div>

{{--  --}}


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="card">
              <div class="card-header">
                  
              </div>
              <div class="card-body">
                  <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th scope="col">ID Pesanan</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Jam Pesanan</th>
                            <th scope="col">Total Pesanan</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_nota as $data)
                            <tr>
                                <th scope="row"><a onclick="detail_pesanan('{{$data['id']}}')" href="#" style="color: black">{{$data['id_pesanan']}}</a></th>
                                <td>{{$data['nama_pemesan']}}</td>
                                <td>{{$data['waktu_pemesanan']}}</td>
                                <td>Rp. {{number_format($data['total_pemesanan'],0,',','.')}}</td>
                                <td>
                                    @if ($data['pembayaran'] == "COD")
                                        <button type="button" class="btn btn-warning btn-sm">COD</button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm">Tranfer</button>
                                    @endif

                                    @if ($data['pengantaran'] == "Diantarkan")
                                        <button type="button" class="btn btn-warning btn-sm">Diantarkan</button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm">Ambil Sendiri</button>
                                    @endif
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
    <script>
        function detail_pesanan(id_pesanan){
            $.ajax({
                type: "get",
                url: "<?=url('/')?>/admin/get_riwayat_pesanan/"+id_pesanan,
                success:function(data){
                    console.log(data);
                    $("#content_modal_detail").html(data.html);
                    $('#modal_detail_pesanan').modal('show');
                }
            })
        }
    </script>
@endsection