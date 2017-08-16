@if(!$image->isEmpty())
<div class="remodal" data-remodal-id="modal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <div class="remodal-body">
    <div class="wrap-swiper">
      <div class="swiper-container" id="photo-swiper">
        <div class="swiper-wrapper">
          @foreach($image as $item)
          <div class="swiper-slide">
            <div class="wrap-photo">
              <div class="share-area text-right" style="margin-bottom:20px">
                   <button style="border-radius:5px; padding:6px 20px; color:white; border:none; background:#050d9e" class="btn-share" data-desc="{!!$item->title!!}" data-img="{!!$item->img_url!!}" data-link="{!!route('f.hinhanh',$item->id)!!}"><i class="fa fa-facebook" aria-hidden="true"></i> Share</button>
              </div>
              <p class="caption">{!!$item->title!!}</p>
              <img src="{!!$item->img_url!!}" class="img-responsive" alt="">


            </div>
          </div>
          @endforeach
        </div>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

      </div>
    </div>  <!-- end wrap-swiper-->
  </div>
</div>
@endif
