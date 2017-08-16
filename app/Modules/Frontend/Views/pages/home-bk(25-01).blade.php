@extends('Frontend::layouts.layout')

@section('meta')

@stop

@section('script')
    <script src="{!!asset('public/assets/frontend')!!}/js/jquery.md5.js"></script>
    <script src="{!!asset('public/assets/frontend')!!}/js/common.js"></script>
    <!-- VIDEO -->
    <link rel="stylesheet" href="{!!asset('public/assets/frontend')!!}/js/video/plyr.css">
    <script src="{!!asset('public/assets/frontend')!!}/js/video/plyr.js"></script>
    <!-- END -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.same-height').matchHeight({});
            var swiper_promotion = new Swiper('.swiper-promotion',{
                speed: 800,
                autoplay: 3000,
                slidesPerView: 1,
            })

            /*VIDEO*/
            plyr.setup();
        })
    </script>
@stop

@section('content')
<!-- **************** Wellcome ****************-->
<section class="wellcome">
    <div class="container">
        <div class="row">
            <div class="inner-section">
                <center>
                    <h2>CHÀO MỪNG ĐẾN VỚI <br>CHƯƠNG TRÌNH DU HỌC HÈ 2017</h2>
                    <hr class="hr">
                    <p class="title-sub">ILA Du Học giới thiệu chương trình Du Học Hè 2017<Br/>với 4 giá trị cốt lõi dành cho học sinh: Phiêu Lưu, Trải Nghiệm, Tự Lập và Trưởng Thành.</p>
                </center>
            </div>
        </div>
    </div>
</section>
<!-- **************** /Wellcome ****************-->
@include('Frontend::layouts.listCountries')
<!-- **************** Pro - Testi ****************-->

<section class="pro-test">
    <div class="container">
        <div class="row">
            <div class="inner-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="pro-text">
                                <h2>Chương trình khuyến mãi</h2>
                                <hr class="hr">
                            </div>
                            @if($promotion)
                            <div class="wrap-slider-promotion ">
                                <div class="swiper-container swiper-promotion">
                                    <div class="swiper-wrapper">
                                        @foreach($promotion as $item_promotion)
                                        <div class="swiper-slide">
                                            <div class="wrap-each-promo">
                                                <div class="each-promo same-height">
                                                    <h4 class="title-each-promo">{!!$item_promotion->name!!}</h4>
                                                    <p>{!!Str::words($item_promotion->description,25)!!}</p>
                                                    <a href="{!!route('contact')!!}" class="btn btn-readmore">ĐĂNG KÝ NGAY</a>
                                                </div>
                                                <img src="{!!$item_promotion->img_avatar!!}" class="img-responsive" alt="">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @else
                                <p>Chúng tôi đang cập nhật thêm các chương trình khuyến mãi.</p>
                            @endif

                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="pro-text">
                                <h2>Trải nghiệm du học</h2>
                                <hr class="hr">
                            </div>
                            @if($testimonial)
                            <div class="img-box">
                                <div class="swiper-container slider-lv3">
                                    <div class="swiper-wrapper promo-testi">
                                        @foreach($testimonial as $item_testimonial)
                                        <div class="swiper-slide">
                                            <div class="wrap-each-testimotion">
                                                <div class="wrap-top-testi same-height">
                                                    <h4>{!!$item_testimonial->author!!}</h4>
                                                    <p>{!!Str::words($item_testimonial->description,25)!!}</p>
                                                    <a href="{!!route('trainghiem.detail',$item_testimonial->slug)!!}" class="btn btn-readmore">ĐỌC THÊM</a>
                                                </div>
                                                <img src="{!!$item_testimonial->img_slides!!}" class="img-responsive img-each-testi" alt="">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- **************** /Pro - Testi ****************-->
<!-- **************** Video ****************-->
<section class="video">
    <div class="container">
        <div class="row">
            <div class="inner-section">
                <center>
                    <h2>Ila Du Học Hè 2016<br/>Bước chân nhỏ - Khám phá thế giới lớn</h2>
                    <div class="container-fluid">
                        <div class="video-box">
                            <div data-type="youtube" data-video-id="pRrfNtJpwzs"></div>
                       </div>
                    </div>
               </center>
            </div>
        </div>
    </div>
</section>
<!-- **************** /Video ****************-->
<section class="key-point">
    <div class="container">
        <div class="row">
            <div class="inner-section">
                <div class="container-fluid">
                    <h2 class="title">Tại sao nên chọn ILA?</h2>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="swiper-container slider-lv1">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="wrap-keypoint">
                                            <img src="{!!asset('public/assets/frontend')!!}/images/icon-earth.png" alt="">
                                            <hr class="hr">
                                            <p class="title-slider">Mở rộng tầm nhìn<br>ra thế giới </p>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="wrap-keypoint">
                                            <img src="{!!asset('public/assets/frontend')!!}/images/icon-feather.png" alt="">
                                            <hr class="hr">
                                            <p class="title-slider">Rèn luyện tính<br>tự lập </p>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="wrap-keypoint">
                                            <img src="{!!asset('public/assets/frontend')!!}/images/icon-user.png" alt="">
                                            <hr class="hr">
                                            <p class="title-slider">Gặp gỡ và giao lưu<br>bạn bè quốc tế </p>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="wrap-keypoint">
                                            <img src="{!!asset('public/assets/frontend')!!}/images/icon-hanhtrinh.png" alt="">
                                            <hr class="hr">
                                            <p class="title-slider">Thử nghiệm hành trình<br>du học</p>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="wrap-keypoint">
                                            <img src="{!!asset('public/assets/frontend')!!}/images/icon-kytucxa.png" alt="">
                                            <hr class="hr">
                                            <p class="title-slider">Trải nghiệm thực tế cuộc sống tại nhà bản xứ hoặc ký túc xá</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Arrows -->
                               <!--  <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- **************** Register ****************-->
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
<!-- **************** /Register ****************-->
@stop