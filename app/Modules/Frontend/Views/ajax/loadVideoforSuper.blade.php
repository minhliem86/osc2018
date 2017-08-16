@if(!$video->isEmpty())
<h2 class="title-page text-center">Video Clip</h2>
<div class="container-fluid">
  <div class="row">
    @foreach($video as $k => $item_video)
    <div class="col-sm-4">
      <div class="each-all">
          <div class="each-lastest each" style="margin-bottom:20px;">
              <div class="video-wrap" style="margin-bottom:10px">
                  <div data-type="youtube" data-video-id="{!!$item_video->video_url!!}"></div>
              </div>
              <p class="title-video" style="font-size:14px ">{!!$item_video->title!!}</p>
          </div>  <!-- each lastest -->
      </div>  <!--end each all -->
    </div>
  @endforeach
  </div>
</div>
@else
<p class="note"> Hiện chưa có Video.</p>
@endif
<script>
plyr.setup();
</script>
