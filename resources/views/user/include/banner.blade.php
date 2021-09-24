<div class="row justify-content-center" style="margin-top: 1em; margin-bottom: 0px;">
@if(count($banner) > 2)
    <div class="col-lg-8 text-center" style="padding: 0;">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?=url('/')?>/img/banner/{{$banner[0]->foto}}" class="d-block w-100" alt="...">
                </div>
                @for ($i = 1; $i < count($banner); $i++)
                <div class="carousel-item">
                    <img src="<?=url('/')?>/img/banner/{{$banner[$i]->foto}}" class="d-block w-100" alt="...">
                </div>
                @endfor
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-lg-4" style="padding: 0px; padding-left: 0.2em;">
        <img src="<?=url('/')?>/img/banner/{{$banner[1]->foto}}" class="d-block w-100" alt="...">
        <img src="<?=url('/')?>/img/banner/{{$banner[2]->foto}}" class="d-block w-100" alt="..." style="margin-top: 0.2em;">
    </div>
@else
<div class="col-lg-12 text-center" style="padding: 0;">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?=url('/')?>/img/banner/{{$banner[0]->foto}}" class="d-block w-100" alt="...">
            </div>
            @for ($i = 1; $i < count($banner); $i++)
            <div class="carousel-item">
                <img src="<?=url('/')?>/img/banner/{{$banner[$i]->foto}}" class="d-block w-100" alt="...">
            </div>
            @endfor
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@endif
    
</div>