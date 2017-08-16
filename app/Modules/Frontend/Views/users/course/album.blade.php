@extends('Frontend::layouts.layout')

@section('title', 'ILA Du Học Hè 2017 - Thư viện hình ảnh')
@section('css')
  <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/css/customer.min.css">
@stop

@section('ga-travel')
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-60129748-15', 'auto');
      ga('send', 'pageview');

    </script>
@stop
@section('script')
    <link rel="stylesheet" href="{!!asset('public/assets/frontend/js/video/plyr.css')!!}">
    <script src="{!!asset('public/assets/frontend/js/video/plyr.js')!!}"></script>

  <script>
    $(document).ready(function(){
      $(document).on('click', '.btn-showall', function(e){
        e.preventDefault();
        $.ajax({
          url: '{!!route("f.ajaxAlbum")!!}',
          type: 'GET',
          success:function(data){
            if(data.error){
              console.log(data.msg);
            }
            $('.load-album').html(data.msg);
          }
        })
      })

    //   VIDEO
    plyr.setup();

    })
  </script>
@stop
@section('content')
  <section class="banner container  clearfix">
      <div class="row">
          <div class="banner-destination visible-lg visible-md">
              <div class="tp-banner-container fullwidthbanner-container">
                  <div class="tp-banner fullwidthbanner" >
                      <ul>
                          <li data-transition="boxslide" data-slotamount="7" data-masterspeed="500" data-link="{!!route('contact')!!}">
                              <!-- MAIN IMAGE  -->
                             <img src="{!!$banner_desk!!}"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                              <div class="tp-caption sft large_text"  data-x="400" data-y="100" data-speed="700" data-start="1700" data-easing="easeOutBack">{!! str_word_count($country_name) <= 3 ? "<p>Du học hè ".$country_name."</p>"   :  '<p>Du học hè</p><p>'.$country_name.'</p>' !!}</div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>  <!-- banner-destination-->
          <div class="banner-destination visible-sm visible-xs">
              <div class="tp-banner-container fullwidthbanner-container">
                  <div class="tp-banner fullwidthbanner" >
                      <ul>
                          <li data-transition="boxslide" data-slotamount="7" data-masterspeed="500" data-link="{!!route('contact')!!}">
                              <!-- MAIN IMAGE  -->
                             <img src="{!!$banner_mobile!!}"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                              <div class="tp-caption sft large_text"  data-x="400" data-y="100" data-speed="700" data-start="1700" data-easing="easeOutBack">{!! str_word_count($country_name) <= 3 ? "<p>Du học hè ".$country_name."</p>"   :  '<p>Du học hè</p><p>'.$country_name.'</p>' !!}</div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>  <!-- banner-destination-->
      </div>
  </section>
  <!-- **************** Wellcome ****************-->
  <section class="wellcome">
      <div class="container">
          <div class="row">
              <div class="inner-section">
                  <center>
                    <div class="wrap-title-blog">
                      <h2>CHÀO MỪNG ĐẾN VỚI TRAVEL BLOG <br/>CỦA CHƯƠNG TRÌNH DU HỌC HÈ 2017</h2>
                      <hr class="hr">
                      <p class="title-sub">Travel Bolg là nơi cập nhật hình ảnh của các đoàn Du Học Hè xuyên suốt hành trình của các Đoàn, giúp các bậc phụ huynh có thể dõi theo những trải nghiệm mỗi ngày của con em mình.</p>
                      <p class="title-sub">Hình ảnh sẽ được ILA Du Học cập nhật tại Travel Blog hàng ngày.</p>
                      <p class="title-sub">Mời Quý Phụ Huynh đón xem!</p>
                    </div>
                  </center>
              </div>
          </div>
      </div>
  </section>
  <!-- **************** /Wellcome ****************-->
@if(!$video->isEmpty())
  <section class="lastest-album section-show">
    <div class="container">
      <div class="row">
        <div class="inner-section bg-yellow">
          <h2 class="title-page">Video Clip - Du học hè - {!!$tour_name!!}</h2>
          <div class="container-fluid">
            <div class="row">
              @foreach($video as $item_video)
                  <div class="col-sm-4">
                    <div class="each-lastest each" style="margin-bottom:10px">
                        <div class="video-wrap" style="margin-bottom:10px;">
                            <div data-type="youtube" data-video-id="{!!$item_video->video_url!!}"></div>
                        </div>
                        <p class="title-video" style="text-align:center; font-weight:600">{!!$item_video->title!!}</p>
                    </div>  <!-- each lastest -->
                  </div>
                @endforeach
            </div>
          </div>
        </div>  <!-- end inner-section -->
      </div>
    </div>
  </section>   <!-- end lastes album -->
  @endif

  <section class="lastest-album section-show">
    <div class="container">
      <div class="row">
        <div class="inner-section bg-yellow">
          @if(!$lastest_album->isEmpty())
          <h2 class="title-page">Du học hè - {!!$tour_name!!}</h2>
          <div class="container-fluid">
            <div class="row">
              @foreach($lastest_album as $item_lastest)
              <div class="col-sm-6">
                <div class="each-lastest each">
                  <a href="{!!route('f.photo', $item_lastest->slug)!!}">
                    <img src="{!!$item_lastest->img_url!!}" class="img-responsive" alt="">
                    <div class="overlay"></div>
                    <h3 class="title-album">{!!$item_lastest->title!!}</h3>
                  </a>
                </div>  <!-- each lastest -->
              </div>
            @endforeach
            </div>
          </div>
          @else
            <h2 class="title-page">Hình ảnh đang được cập nhật, vui lòng quay lại sau. Xin cảm ơn.</h2>
          @endif
        </div>  <!-- end inner-section -->
      </div>
    </div>
  </section>   <!-- end lastes album -->


@if(!$all_album->isEmpty())
  <section class="all-album section-show">
    <div class="container">
      <div class="row">
        <div class="inner-section bg-yellow">
          <div class="wrap-title-page">
            <h2 class="title-page">Tất cả hình ảnh</h2>
            <a href="#" class="btn-showall">Xem tất cả</a>
          </div>

          <div class="container-fluid">
            <div class="row load-album">
              @foreach($all_album->chunk(3) as  $item_chunk)
                  <div class="clearfix">
                      @foreach($item_chunk as $item_all)
                      <div class="col-sm-4">
                        <div class="each-all each">
                          <a href="{!!route('f.photo', $item_all->slug)!!}">
                            <img src="{!!$item_all->img_url!!}" class="img-responsive" alt="">
                            <div class="overlay"></div>
                            <h3 class="title-album">{!!$item_all->title!!}</h3>
                          </a>
                        </div>  <!--end each all -->
                      </div>
                      @endforeach
                  </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  <!-- end all-album -->
  @endif


@stop
