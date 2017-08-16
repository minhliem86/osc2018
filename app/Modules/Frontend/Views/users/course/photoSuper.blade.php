@extends('Frontend::layouts.layout')

@section('title', 'ILA Du Học Hè 2017 - Thư viện hình ảnh')
@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/css/customer.min.css">
@stop
@section('script')
  <script src="{!!asset('public/assets/frontend/')!!}/js/swiper.min.js"></script>
  {{-- REMODAL --}}
  <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/js/remodal/remodal.css">
  <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/js/remodal/remodal-default-theme.css">
  <script src="{!!asset('public/assets/frontend/')!!}/js/remodal/remodal.min.js"></script>
  <script>
    $(document).ready(function(){
      const inst =  $('[data-remodal-id=modal]').remodal();

      const photoSwiper = new Swiper('#photo-swiper', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
    });

    // FB SHARE
    $('body').on('click', '.btn-share', function(){
        const title = 'ILA Du Hoc Hè';
        const desc = $(this).data('desc');
        const img = $(this).data('img');
        const link = $(this).data('link');
        postFacebook(link, title, desc, img);

    })

      // LOAD PHOTO
      $('body').on('click','.each-all a',function(e){
        e.preventDefault();
        const index = $(this).data('index');
        inst.open();
        photoSwiper.update(true);
        photoSwiper.slideTo(index);
      });

      // PAGINATION
      $('body').on('click' , '.pagination a', function(e){
        e.preventDefault();
        const url = $(this).attr('href');
        loadPaginate(url);
        window.history.pushState("", "", url);
      })
    })

    function loadPaginate(url){
      $.ajax({
        url:url,
        type: 'GET',
        success:function(data){
          $('.load-photo').html(data);
        }
      })
    }
  </script>

  <script>
      /*FB INIT*/
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '{!!env("FACEBOOK_APP_ID")!!}',
          cookie      : true,
        // xfbml  : true,
          version    : 'v2.8'
        });
        FB.AppEvents.logPageView();
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
       /*END*/

       function postFacebook(link, title, desc, img){
         FB.api('https://graph.facebook.com/', 'post', {
             id: link,
             scrape: true
         }, function(response) {
           FB.ui({
             method: 'share',
             display: 'popup',
             title: title,
             caption: 'ILA - Du Học Hè',
             description: desc,
             picture: img,
             href : link,
           },function(res){
             if(typeof res !== 'undefined'){

             }else{
            //    alert('Để hoàn tất cuộc thi, bạn phải share bài viết của bạn trên status ở chế độ public!');
             }
           })
         });
       }
  </script>
@stop
@section('content')

  <section class="banner container clearfix">
      <div class="row">
          <div class="banner-destination">
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
          </div>  <!-- banner-destination-->
      </div>
  </section>
  <!-- **************** Wellcome ****************-->
  <section class="wellcome">
      <div class="container">
          <div class="row">
              <div class="inner-section">
                  <center>
                    <div class="wrap-photo-super">
                      <h2>{!!$title_album!!}</h2>
                      <hr class="hr">
                      @if(Auth::client()->get()->super)
                          <a href="{!!route('f.showAlbumBySuper',$album_id)!!}" class="btn-back">Quay lại</a>
                      @endif

                    </div>
                  </center>
              </div>
          </div>
      </div>
  </section>
  <!-- **************** /Wellcome ****************-->

  <section class="all-album">
    <div class="container">
      <div class="row">
        @if(!$image->isEmpty())
        <div class="inner-section">
          <div class="load-photo">
            @include('Frontend::ajax.paginatePhoto')
          </div>
        </div>
        @endif
      </div>
    </div>
  </section>  <!-- end all-album -->

  @include('Frontend::users.course.loadPopup')
@stop
