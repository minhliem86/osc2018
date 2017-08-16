<section class="discover">
    <div class="container">
        <div class="row">
            <div class="inner-section bg-yellow {!!Route::getCurrentRoute()->getActionName() == 'App\Modules\Frontend\Controllers\DestinationController@getTour' || Request::segment(1) == 'khuyen-mai' || Request::segment(1) == 'trai-nghiem-du-hoc' ? 'bg-gray' : ''  !!}">
                <center>
                    <h2 class="title-list-country">KHÁM PHÁ ĐIỂM ĐẾN HẤP DẪN 2017</h2>
                    <hr class="hr hidden-sm hidden-xs">
                    @if($countries)
                        <ul class="to-local nopadding inline-list hidden-sm hidden-xs">
                            @foreach($countries as $country)
                            <li><a href="{!!route('quocgia',$country->slug)!!}">{!!$country->name!!}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </center>
                <div class="container-fluid {!!Request::segment(1) == '' ? 'bg-yellow' : ''!!}">
                    <div class="top-box hidden-xs hidden-sm clearfix">
                        <div class="col-xs12 col-md-7 nopadding">
                            <div class="wrap-content-country">
                                <div class="swiper-container slider-lv2">
                                    <div class="swiper-wrapper">
                                        @if($countries)
                                        @foreach($countries as $item_country)
                                        <div class="swiper-slide">
                                            <div class="wrap-slider-country">
                                                <a href="{!!route('quocgia',$item_country->slug)!!}"><img src="{!!$item_country->img_slide!!}"></a>
                                                <h3 class="title-country">{!!$item_country->name!!}</h3>
                                                <a href="{!!route('quocgia',$item_country->slug)!!}" class="btn-reg-slide">ĐĂNG KÝ NGAY</a>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-5 nopadding">
                            @if($list_a_country)
                                @foreach($list_a_country as $country_item)
                                    <div class="col-xs-6 nopadding">
                                        <div class="overlay-img">
                                            <img src="{!!$country_item->img_avatar!!}" class="img-responsive" alt="">
                                        </div>
                                        <p class="title-country">{!!$country_item->name!!}</p>
                                        <a href="{!!route('quocgia',$country_item->slug)!!}" class="btn btn-dis">ĐĂNG KÝ NGAY</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="bottom-box hidden-xs hidden-sm clearfix">
                        @if(!$list_multi_country->isEmpty())
                            @foreach($list_multi_country as $multi_item)
                            <div class="col-xs-12 col-sm-4 nopadding">
                                <div class="wrap-multi-country">
                                    <div class="overlay-img">
                                        <img src="{!!$multi_item->img_avatar!!}" class="img-responsive" alt="">
                                    </div>
                                    <p class="title-country">{!!$multi_item->name!!}</p>
                                    <a href="{!!route('quocgia',$multi_item->slug)!!}" class="btn btn-dis">ĐĂNG KÝ NGAY</a>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    @if(Request::segment(1) == '')
                    <div class="promotion-yellow visible-md visible-lg">
                        <h2 class="title-promotion-yellow">Chương trình khuyến mãi</h2>
                        <hr class="hr hidden-sm hidden-xs">
                        @if($promotion)
                        <div class="promotionhome-area clearfix">
                            @foreach($promotion as $item_promotion)
                            <div class="wrap-promotion-yellow">
                                <img src="{!!$item_promotion->img_icon!!}" alt="" class="img-circle img-responsive">
                                <h4>{!!$item_promotion->name!!}</h4>
                            </div>
                            @endforeach
                        </div>
                        <div class="wrap-btn">
                            <a href="{!!route('contact')!!}" class="btn btn-readmore">ĐĂNG KÝ NGAY</a>
                        </div>
                        @endif
                    </div>
                    @endif
                    <div class="list-countries-mobile visible-xs visible-sm clearfix">
                        @if(!$countries->isEmpty())
                            @foreach($countries as $country_mobile)
                            <div class="col-xs-12 nopadding each-country-mobile">
                                <div class="wrap-multi-country">
                                    <div class="overlay-img">
                                        <img src="{!!$country_mobile->img_avatar!!}" class="img-responsive" alt="">
                                    </div>
                                    <div class="wrap-button-mobile">
                                        <div class="inner-wrap-button">
                                            <div class="table-cell">
                                                <p class="title-country">
                                                {!! count(explode(' ',$country_mobile->name)) > 2 ? '<span class="multi">'.$country_mobile->name.'</span>' : '<span> Du học hè '.$country_mobile->name.' - </span>'!!}</span> <a href="{!!route('quocgia',$country_mobile->slug)!!}" class="btn-dk">Đăng ký ngay</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
