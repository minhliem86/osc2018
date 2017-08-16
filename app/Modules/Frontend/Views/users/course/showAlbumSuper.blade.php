@extends('Frontend::layouts.layout')

@section('title', 'ILA Du Học Hè 2017 - Thư viện hình ảnh')
@section('css')
  <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/css/customer.min.css">
@stop
@section('script')
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

@if(!$all_album->isEmpty())
  <section class="all-album section-show">
    <div class="container">
      <div class="row">
        <div class="inner-section bg-yellow">
          <div class="wrap-title-page">
            <h2 class="title-page">Du học hè - {!!$tour_name!!}</h2>
          </div>

          <div class="container-fluid">
            <div class="row load-album">
            @foreach($all_album->chunk(3) as $chunk)
                <div class="clearfix">
                    @foreach($chunk as $item_all)
                        <div class="col-sm-4">
                          <div class="each-all each">
                            <a href="{!!route('f.superAlbumPhoto',[$item_all->id, $item_all->slug] )!!}">
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
