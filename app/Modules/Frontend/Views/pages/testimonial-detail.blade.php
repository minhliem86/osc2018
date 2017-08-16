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
    <script>
    $(document).ready(function(){
        var testiDetail = new Swiper('.testidetial-swiper',{
            direction: 'vertical',
            slidesPerView: 4,
            height: 600,
            autoplay: 3500,
            speed: 900,
            paginationClickable: true,
            pagination: '.swiper-pagination-testidetail',
        })
    })
    </script>
@stop

@section('content')
    <!-- **************** Banner ****************-->
    @include('Frontend::layouts.banner')
    <!-- **************** /Banner ****************-->
	<section class="testimonial-detail">
        <div class="container">
            <div class="row">
                <div class="inner-section testtimonial testtimonial-detail">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="wrap-title-page-testi">
                                    <h4 class="title-testi">CHIA SẺ TRẢI NGHIỆM DU HỌC HÈ</h4>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <div class="wrap-content-testimonial">
                                    <div class="testimonial-img-box">
                                        <img src="{!!$testimonial_detail->img_slides!!}" class="img-responsive" alt="">
                                    </div>
                                    <div class="authorsign visible-xs visible-sm">
                                        <p style="margin:10px 0 0;"><b>{!!$testimonial_detail->author!!}</b></p>
                                    </div>
                                    <div class="box-text">
                                        <p>{!!$testimonial_detail->content!!}</p>
                                    </div>
                                    <div class="authorsign text-right hidden-xs hidden-sm">
                                        <p><b>{!!$testimonial_detail->author!!}</b></p>
                                    </div>
                                    @if($tour_rec)
                                    <div>
                                        <p class="text-bold recommend">Các chương trình du học hấp dẫn</p>
                                        <ul class="list-duhoc">
                                            @foreach($tour_rec as $item_tour_rec)
                                                <li><a href="{!!route('quocgia.detail',[App\Models\Country::find($item_tour_rec->country_id)->slug,$item_tour_rec->slug])!!}">{!!$item_tour_rec->title!!}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div> <!-- end wrap-content-testimonial -->
                            </div>
                            <div class="col-xs-12 col-md-4 hidden-sm hidden-xs">
                                <div class="testtimanial-avartar-slider">
                                    <div class="swiper-container testidetial-swiper">
                                        <div class="swiper-wrapper">
                                            @if($testimonial_relate)
                                                @foreach($testimonial_relate as $item_list_v)
                                                    <div class="swiper-slide">
                                                        <div class="testtimonial-list-item clearfix">
                                                            <div class="col-xs-12 col-sm-4 col-md-3 nopadding">
                                                                <img src="{!!$item_list_v->img_avatar!!}" class="img-circle" width="80" height="80" alt="{!!$item_list_v->author!!}">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-8 col-md-9">
                                                                <h4>{!!$item_list_v->author!!}</h4>
                                                                <p>{!!Str::words($item_list_v->description,25)!!}</p>
                                                                <a href="{!!route('trainghiem.detail',$item_list_v->slug)!!}" class="btn-readmore btn">XEM THÊM</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <!--Add Pagination -->
                                    <div class="swiper-pagination swiper-pagination-testidetail"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- **************** /Testtimonial ****************-->
    <!-- **************** Promotion ****************-->
    <section class="promotion-bar hidden-xs hidden-sm">
        <div class="container">
            <div class="row">
                <div class="promotion-bottom">
                    <div class="wrap-promo-bottom">
                        <div class="left-promo-inner">
                            <h3>Đăng Ký Sớm</h3>
                            <p>Để nhận ngay ưu đãi lên đến <b>12.500.000đ </b></p>
                        </div>
                        <div class="right-promo-inner">
                            <a href="{!!route('contact')!!}" class="btn btn-register">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- **************** /Promotion ****************-->
    <!-- **************** Discover ****************-->
    @include('Frontend::layouts.listCountries')
    <!-- **************** /Discover ****************-->
@stop