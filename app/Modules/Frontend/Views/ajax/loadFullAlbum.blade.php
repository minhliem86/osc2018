@foreach($all_album->chunk(3) as $chunk)
<div class="clearfix">
    @foreach($chunk as $item_all)
        <div class="col-sm-4">
          <div class="each-all each">
            <a href="{!!route('f.photo', $item_all->slug)!!}">
              <img src="{!!$item_all->img_url!!}" class="img-responsive" alt="">
              <div class="overlay"></div>
              <h3 class="title-album">{!!Str::words($item_all->title, 20)!!}</h3>
            </a>
          </div>  <!--end each all -->
        </div>
    @endforeach
</div>
@endforeach
