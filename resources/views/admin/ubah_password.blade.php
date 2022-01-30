@extends('layouts.admin')

@section('body')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="card">
            <div class="card-body">
                <form action="<?=url('/')?>/admin-post-ubah-password" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Password Baru</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="password">
                        </div>
                    </div>
                    <br>
                    <div style="float: right">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
                
            </div>
          </div>
      </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $(document).ready(function(){
        @if (session('success'))
          alert('Password berhasil diubah')
        @endif
        
      })
    </script>
@endsection