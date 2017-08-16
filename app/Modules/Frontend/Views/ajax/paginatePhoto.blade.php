@if(!$image->isEmpty())
<div class="container-fluid">
  <div class="row">
    @foreach($image as $k=> $item)
    <div class="col-sm-4">
      <div class="each-all">
        <a href="#" data-index="{!!$k!!}">
          <img src="{!!$item->thumbnail_url!!}" class="img-responsive" alt="">
          <div class="overlay"></div>
          <h3 class="title-album">{!!Str::words($item->title, 25)!!}</h3>
        </a>
      </div>  <!--end each all -->
    </div>
    @endforeach
  </div>
  {{-- <div class="row">
    <div class="col-sm-12">
      <div class="wrap-pagination text-center">
        {!!$image->setPath('')->render()!!}
      </div>
    </div>
  </div> --}}
</div>
@endif
