@extends('layouts.admin')

@section('body')

{{-- modal video --}}
<div class="modal fade" id="modal_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Video</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input type="text" id="modal_id_video" hidden>
        <div class="modal-body">
            <iframe id="modal_video_embed" width="100%" height="220"  src="https://www.youtube.com/embed/{{$list_video[2]['link_embed']}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
            <br><br>
            <div class="input-group date" id="tgl_akhir" data-target-input="nearest">
                <input type="text" id="modal_link_video" class="form-control" data-target="#tgl_akhir"/>
                <div class="input-group-append">
                    <div class="input-group-text"><i onclick="get_embed_link()" class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="simpan_video()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
  

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="card">
              <div class="card-body">
                <div class="row">
                    <div class="col">
                        <iframe id="iframe_{{$list_video[0]['id']}}" width="100%" height="220"  src="https://www.youtube.com/embed/{{$list_video[0]['link_embed']}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
                    </div>
                    <div class="col">
                        <iframe id="iframe_{{$list_video[1]['id']}}" width="100%" height="220"  src="https://www.youtube.com/embed/{{$list_video[1]['link_embed']}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
                    </div>
                    <div class="col">
                        <iframe id="iframe_{{$list_video[2]['id']}}" width="100%" height="220"  src="https://www.youtube.com/embed/{{$list_video[2]['link_embed']}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button onclick="modal_video('{{$list_video[0]['id']}}', '{{$list_video[0]['link_embed']}}', '{{$list_video[0]['link']}}')">Video 1</button>
                    </div>
                    <div class="col">
                        <button onclick="modal_video('{{$list_video[1]['id']}}', '{{$list_video[1]['link_embed']}}', '{{$list_video[1]['link']}}')">Video 2</button>
                    </div>
                    <div class="col">
                        <button onclick="modal_video('{{$list_video[2]['id']}}', '{{$list_video[2]['link_embed']}}', '{{$list_video[2]['link']}}')">Video 3</button>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function modal_video(id, link_embed, link){
            $('#modal_id_video').val(id);
            $('#modal_link_video').val(link);
            $('#modal_video_embed').attr('src', 'https://www.youtube.com/embed/'+link_embed);
            $('#modal_video').modal('show');
        }

        function simpan_video(){
            var id = $('#modal_id_video').val();
            var link = $('#modal_link_video').val();

            $.ajax({
                type: "POST",
                url: "/admin-post-video",
                data: {'id':id, 'link':link},
                success:function(data){
                    $('#iframe_'+id).attr('src', 'https://www.youtube.com/embed/'+data.embed_link);
                    $('#modal_video').modal('hide');
                }
            })
        }

        function get_embed_link(){
            var link = $('#modal_link_video').val();
            $.ajax({
                type: "POST",
                url: "/get-embed-link/",
                data: {'link':link},
                success:function(data){
                    $('#modal_video_embed').attr('src', 'https://www.youtube.com/embed/'+data.link_embed);
                }
            })
        }
    </script>
@endsection