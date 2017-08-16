@extends('Frontend::layouts.layout')

@section('meta')
 	<meta property="og:image" content="{!!$tour_detail->img_sharing!!}">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">
@stop

@section('script')
	<script src="{!!asset('public/assets/frontend')!!}/js/customScript.js" type="text/javascript"></script>
@stop

@section('content')
<!-- **************** Course Deltail ****************-->
@if(count($tour_detail))
<section>
    <div class="container">
        <div class="row">
            <div class="inner-section bg-yellow course-detail-main">
                <center>
                    <h2>Du Học Hè {!!$tour_detail->title!!}</h2>
                    <hr class="hr">
                    <!-- <p class="title-sub">{!!$tour_detail->description!!}</p> -->
                </center>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-7  ">
                            <!-- <h4>LOREM IPSUM DOLOR CONSE <br>CTETUR ADIPISCING ELIT SIT AMET</h4> -->
                            <p>{!!$tour_detail->content!!}</p>
                            <div class="text-right wrap-btn">
                                <a href="{!!route('contact')!!}" class="btn btn-course-dk">ĐĂNG KÝ</a>
                            </div>

                        </div>

                        <!-- <div class="col-xs-12 col-sm-4 col-md-4">
                            <h4>THỜI GIAN</h4>
                            <div class="clearfix">
                                <div class="col-xs-2">
                                    <img src="{!!asset('public/assets/frontend')!!}/images/icon-clock.png" alt="">
                                </div>
                                <div class="col-xs-10">Từ {!!$tour_detail->start!!} đến {!!$tour_detail->end!!}</div>
                            </div>
                        </div> -->
                        <div class="col-xs-12 col-sm-5">
                            <div class="img-box">
                                <img src="{!!$tour_detail->img_avatar!!}" class="img-responsive" alt="">
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</section>
@endif
<!-- **************** Discover ****************-->
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
@include('Frontend::layouts.listCountries')
@include("Frontend::layouts.keypoint")
@stop