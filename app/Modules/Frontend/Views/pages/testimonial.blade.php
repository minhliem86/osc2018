@extends('Frontend::layouts.layout')

@section('meta')
        <meta property="og:image" content="{!!asset('public/assets/frontend/')!!}/images/fb-share.png">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">
    
    <meta name="keywords" content="du học hè, du học hè 2017, ila du học hè">
    <meta name="description" content="Chia sẻ trải nghiệm Du học hè của của các học viên đoàn ILA những năm trước">
@stop

@section('title','Trải nghiệm du học hè - ILA Du Học')

@section('script')
	<script src="{!!asset('public/assets/frontend')!!}/js/customScript.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.testimonial-slide-same-height').matchHeight({})

             var mySwiper = new Swiper ('.testimonial-slider-ver', {
                // Optional parameters
                direction: 'vertical',
                slidesPerView: 3,
                height: 440,
                pagination: '.swiper-pagination-ver',
                autoplay: 3000,
                speed: 1000,
                preventClicks: false,
                paginationClickable: true,
                breakpoints:{
                    480: {
                        slidesPerView: 2
                    }
                }
                // pagination: '.swiper-pagination',
            });
            var SwiperTestiHori = new Swiper ('.testimonial-slider-hori', {
                // Optional parameters
                slidesPerView: 1,
                autoplay: 3000,
                speed: 1000,
                pagination: '.swiper-pagination',
                spaceBetween: 5,
                autoplay: false,
                autoplayDisableOnInteraction: false,
                preventClicks: false,
                paginationClickable: true,
            });

            mySwiper.params.control = SwiperTestiHori;
            SwiperTestiHori.params.control = mySwiper;
        })
    </script>
@stop

@section('content')
<!-- **************** Banner ****************-->
@include('Frontend::layouts.banner')
<!-- **************** /Banner ****************-->
	 <!-- **************** Testtimonial ****************-->
    <section class="testtimonial">
        <div class="container">
            <div class="row">
                <div class="inner-section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wrap-top-testimonial clearfix hidden-xs hidden-sm">
                                <div class="col-xs-12 col-sm-8 testimonial-slide-same-height">
                                    <div class="row testtimanial-slider">
                                        <div class="wrap-slider-landscape">
                                            <div class="swiper-container testimonial-slider-hori">
                                                <div class="swiper-wrapper">
                                                    @if($testimonial_list)
                                                        @foreach($testimonial_list as $item_list)
                                                            <div class="swiper-slide">
                                                                <div class="each-wrap-landscape">
                                                                    <img src="{!!$item_list->img_slides!!}" class="img-responisve" alt="">
                                                                    <div class="col-xs-11 col-sm-10 col-md-6 testtimanial-slider-item">
                                                                        <h4>{!!$item_list->author!!}</h4>
                                                                        <blockquote>{!!Str::words($item_list->description,30)!!}</blockquote>
                                                                        <a href="{!!route('trainghiem.detail',$item_list->slug)!!}" class="btn btn-readmore">XEM THÊM</a>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        @endforeach

                                                    @endif

                                                </div>
                                                <!--Add Pagination -->
                                                <div class="swiper-pagination"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- testimonial-slider-ver -->
                                <div class="col-xs-12 col-sm-4 clearfix fullheight ">
                                    <div class="testimonial-list fullheight">
                                        <h4 class="title-testi">CHIA SẺ TRẢI NGHIỆM DU HỌC HÈ</h4>
                                        <div class="testtimanial-avartar-slider">
                                            <div class="swiper-container testimonial-slider-ver">
                                                <div class="swiper-wrapper">
                                                    @if($testimonial_list)
                                                        @foreach($testimonial_list as $item_list_v)
                                                            <div class="swiper-slide">
                                                                <div class="testtimonial-list-item ">
                                                                    <img src="{!!$item_list_v->img_avatar!!}" class="img-circle img-avatar" width="80" height="80" alt="{!!$item_list_v->author!!}">

                                                                    <div class="wrap-content-slide-v">
                                                                        <h4>{!!$item_list_v->author!!}</h4>
                                                                        <p>{!!Str::words($item_list_v->description,19)!!}</p>
                                                                        <a href="{!!route('trainghiem.detail',$item_list_v->slug)!!}" class="btn btn-readmore">XEM THÊM</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <!--Add Pagination -->
                                        <div class="swiper-pagination-ver swiper-pagination"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-mobile-type clearfix visible-sm visible-xs">
                            	<div class="col-xs-12 col-sm-12 ">
                            		<div class="wrap-title-page-testi">
                            			<h4 class="title-testi">CHIA SẺ TRẢI NGHIỆM DU HỌC HÈ</h4>
                            		</div>
                            	</div>
                                <div class="col-xs-12 col-sm-12 ">
                                    @if($testimonial_list)
                                        @foreach($testimonial_list as $item_list_mobile)

                                        <div class="wrap-each-testi-mobile">
                                            <a href="{!!route('trainghiem.detail',$item_list_mobile->slug)!!}"><img src="{!!$item_list_mobile->img_slides!!}" class="img-responsive" alt=""></a>
                                            <div class="testtimanial-slider-item">
                                                <h4><span>{!!$item_list_mobile->author!!}</span><a href="{!!route('trainghiem.detail',$item_list_mobile->slug)!!}" class="xemthem">Đọc thêm</a></h4>
                                                <a href="{!!route('trainghiem.detail',$item_list_mobile->slug)!!}"><blockquote>{!!Str::words($item_list_mobile->description,25)!!}</blockquote></a>
                                            </div>
                                        </div>

                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- **************** /Testtimonial ****************-->
    <!-- **************** Discover ****************-->
   	@include('Frontend::layouts.listCountries')
    <!-- **************** /Discover ****************-->

    <!-- REGISTER -->
    <section class="reg">
        <div class="container">
            <div class="row">
                <div class="inner-section inner-reg">
                    <center>
                        <h2>ĐĂNG KÝ & TƯ VẤN</h2>
                        <hr class="hr">
                    </center>
                    @include('Frontend::layouts.formRegister')
                </div>
            </div>

        </div>
    </section>
    <!-- END REGISTER -->
@stop