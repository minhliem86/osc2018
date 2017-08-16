@extends('Frontend::layouts.layout')

@section('meta')
 <meta property="og:image" content="{!!asset('public/assets/frontend/')!!}/images/fb-share/fb-share-my.jpg">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">
    
    <meta name="keywords" content="du học hè, du học hè 2017, ila du học hè">
    <meta name="description" content="Chương trình Du Học Hè 2017 với 4 giá trị cốt lõi: Phiêu Lưu, Trải Nghiệm, Tự Lập và Trưởng Thành.">
@stop

@section('title','Đăng ký tham gia Du học hè 2017 - ILA Du Học')

@section('script')
    <script src="{!!asset('public/assets/frontend')!!}/js/jquery.md5.js"></script>
    <script src="{!!asset('public/assets/frontend/')!!}/js/customScript.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var swiper_promotion = new Swiper('.swiper-promotion',{
                speed: 800,
                autoplay: 3000,
                slidesPerView: 1,
            })
        })
    </script>
@stop

@section('content')
    <!-- **************** Banner ****************-->
    <section class="banner container clearfix">
        <div class="row">
            <div class="banner-homepage visible-md visible-lg">
                <div class="tp-banner-container">
                    <div class="tp-banner" >
                        <ul>
                            <li data-transition="boxslide" data-slotamount="7" data-masterspeed="500" data-link="{!!route('contact')!!}">
                                <!-- MAIN IMAGE -->
                                <img src="{!!asset('public/assets/frontend/images/slider/OSChe_Web_banner.png')!!}"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                <div class="caption sfr" 
                                    data-x="40" data-y="100" data-speed="700" data-start="200" data-easing="easeOutBack">
                                    <img src="{!!asset('public/assets/frontend/images/slider/OSChe_Web_text01.png')!!}" class="img-responsive" alt="">
                                </div>
                            </li>
                            <li data-transition="slideleft" data-slotamount="7" data-masterspeed="500" data-link="{!!route('contact')!!}">
                                <!-- MAIN IMAGE -->
                                <img src="{!!asset('public/assets/frontend/images/slider/OSChe_Web_banner02.png')!!}"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                <div class="caption sfr" 
                                    data-x="40" data-y="100" data-speed="700" data-start="200" data-easing="easeOutBack">
                                    <img src="{!!asset('public/assets/frontend/images/slider/OSChe_Web_text01.png')!!}" class="img-responsive" alt="">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>  <!-- banner-homepage -->
        </div>
    </section>
    <!-- **************** /Banner ****************-->
	<section class="contact-footer">
       <div class="container">
            <div class="row">
                <div class="inner-section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6  contact-left ">
                                <div class="wrap-new-promotion">
                                    <div class="pro-text">
                                        <h2>[CƠ HỘI HỌC BỔNG] 4 HỌC BỔNG 50% ĐẾN MỸ - ÚC - SINGAPORE</h2>
                                    </div>
                                    <div class="new-promotion-content">
                                    	<p >
                                    		ILA Du Học hân hạnh trao <b>04 Học Bổng Du Học Hè</b> đến Mỹ - Úc – Singapore, mỗi học bổng <b>trị giá 50% tổng chi phí</b> đã bao gồm học phí, ăn ở, vé máy bay, sách và thiết bị học tập cùng nhiều chi phí khác.
                                    	</p>

                                        <p><b>Áp dụng cho: các bạn đăng ký tham gia ILA Du Học Hè trước 17/5/2017.</b></p>

                                    	<p >Hãy có một mùa hè tuyệt vời nhất, cùng học và kết bạn với các du học sinh đến từ khắp nơi trên thế giới, riêng tiếng Anh là 15 giờ mỗi tuần, tham quan các công trình kiến trúc vĩ đại và thưởng thức những tác phẩm văn hóa nghệ thuật nổi tiếng ở Mỹ - Úc – Singapore…</p>

                                        <p><b>Đăng ký ngay!</b></p>
                                    	
                                    </div>
                                    <!-- <div class="new-promotion-content">
                                        <ul class="list-new-promotion">
                                            <li>Tặng <b>Ipad mini cho 2 khách hàng may mắn</b> khi đăng ký và đặt cọc trước và trong ngày 16/4</li>
                                            <li>Đăng ký và đặt cọc 20,000,000đ trước ngày 16/4: <b>Tặng 2,500,000 VND</b></li>
                                            <li>Đặc biệt, <b>tặng 500,000đ</b> khi đăng ký và đặt cọc trước hoặc trong sự kiện</li>
                                            <li>Rút thăm các phần quà xinh xắn từ ILA Du học khi đăng ký tham gia chương trình Du học Hè</li>
                                        </ul>

                                        <div class="location">
                                            <p class="locate">Tại TP.HCM:</p>
                                            <p>- <b>Thời gian:</b> 9:00 - 15:00; Thứ 7 ngày  15/04/2017</p>
                                            <p>- <b>Địa điểm:</b> ILA Du học, 146 Nguyển Đình Chiểu, Q3</p>
                                            <p>- <b>Liên hệ:</b> 0903 891 511 - 0938 264 343</p>
                                        </div>

                                        <div class="location">
                                            <p class="locate">Tại Đà Nẵng:</p>
                                            <p>- <b>Thời gian:</b> 9:00 - 12:00; Chủ nhật, ngày 16/4/2017</p>
                                            <p>- <b>Địa điểm:</b> 169-171 Nguyễn Văn Linh, Quận Thank Khê, Đà Nẵng</p>
                                            <p>- <b>Liên hệ:</b> 0905 100 910 - 0979 779 155 - 0914 022 599</p>
                                        </div>

                                        <div class="location">
                                            <p class="locate">Tại Hà Nội:</p>
                                            <p>- <b>Thời gian:</b> 9:00 - 15:00; Thứ 7 ngày  15/04/2017</p>
                                            <p>- <b>Địa điểm:</b> ILA Du Học, số 6 Phố Huế, Q. Hoàn Kiếm</p>
                                            <p>- <b>Liên hệ:</b> 0986 149 583 – 0902 284 573</p>
                                        </div>

                                        <div class="location">
                                            <p class="locate">Vũng Tàu:</p>
                                            <p>- <b>Thời gian:</b> 9:00 - 15:00; Chủ nhật ngày  16/04/2017</p>
                                            <p>- <b>Địa điểm:</b> ILA Du học, 155 Nguyễn Thái Học, Phường 7</p>
                                            <p>- <b>Liên hệ:</b> 0909 753 363</p>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="wrap-promotion-contactv hidden">
                                    <div class="pro-text">
                                        <h2>Chương trình khuyến mãi</h2>
                                        <!-- <hr class="hr"> -->
                                    </div>
                                    @if($promotion)
                                    <div class="promotionhome-area clearfix">
                                        @foreach($promotion as $item_promotion)
                                        <div class="wrap-each-promotionhome2">
                                            <div class="wrap-inner-img">
                                                <div class="wrap-img">
                                                    <img src="{!!$item_promotion->img_icon!!}" alt="" class="img-circle img-responsive">
                                                </div>
                                                <div class="table-cell">
                                                    <h4>{!!$item_promotion->name!!}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                        <p>Chúng tôi đang cập nhật thêm các chương trình khuyến mãi.</p>
                                    @endif
                                </div>

                                <div class="promotion-yellow visible-md visible-lg">
                                    <h2 class="title-promotion-yellow">Chương trình khuyến mãi</h2>
                                    @if($promotion)
                                    <div class="promotionhome-area clearfix">
                                        @foreach($promotion as $item_promotion)
                                        <div class="wrap-promotion-yellow">
                                            <img src="{!!$item_promotion->img_icon!!}" alt="" class="img-circle img-responsive">
                                            <h4>{!!$item_promotion->name!!}</h4>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- <div class="wrap-btn">
                                        <a href="{!!route('contact')!!}" class="btn btn-readmore">ĐĂNG KÝ</a>
                                    </div> -->
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6  contact-right">
                                <h4>ĐĂNG KÝ ĐỂ ĐƯỢC TƯ VẤN</h4>
                                <form class="reg-box" accept-charset="true" method="POST" action="{!!route('contact.postRegister')!!}" id="formOSC">
                                    {!!Form::token()!!}
                                    <input type="hidden" name="content_type" value="osc@du-hoc-he"/>
                                    <input type="hidden" name="id_program" value="21" />
                                    <input type="hidden" name="id_center" id="id_center" />
                                    <input type="hidden" name="inquiry" value="Du Hoc He 2017" />
                                    <input type="hidden" name="id_hash"  />

                                    <div class="form-group">
                                        <input class="form-control" value="{!!old('name')!!}" name="name" required title="Ho Ten" type="text" placeholder="Họ và Tên">
                                    </div>
                                    <div class="form-group">
                                         <input class="form-control" value="{!!old('email')!!}" name="email" required title="Email" type="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                         <input class="form-control" value="{!!old('phone')!!}" name="phone" required title="So dien thoai" type="tel" placeholder="Số điện thoại">
                                    </div>
                                    @if($location_list)
                                    <div class="form-group">
                                        {!!Form::select('id_city',[''=>'Chọn Thành Phố']+$location_list,old('id_city'),['class'=>'form-control','id'=>'id_city'])!!}
                                    </div>
                                    @endif
                                    @if($country_list)
                                    <div class="form-group">
                                        {!!Form::select('country',[''=>'Quốc gia']+$country_list,old('country'),['class'=>'form-control'])!!}
                                    </div>
                                    @endif
                                    <!-- <div class="col-xs-12">
                                       <textarea name="message" rows="3" class="form-control" placeholder="Ý kiến của bạn"></textarea>
                                    </div> -->
                                    <div class="form-group text-center">
                                         {!!Form::submit('ĐĂNG KÝ',['class' => 'btn btn-reg btn-lp'])!!}
                                    </div>
                                    @if(Session::has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {!!Session::get('success')!!}
                                        </div>
                                    @endif

                                    @include('Admin::errors.listerror')
                                    <script type="text/javascript" src="{!!asset('public/assets/backend')!!}/js/dms-analytics.js"></script>
                                    <script type="text/javascript">
                                        _swga.base_url_post = 'http://marketingtool.ilavietnam.edu.vn';
                                        _swga.init('SW-000019', "formOSC", "manual");
                                        _swga.loadForm({
                                            fullname: 'name',
                                            phone: 'phone',
                                            email: 'email',
                                            address: '',
                                            id_city: 'id_city',
                                            id_center: 'id_center',
                                            note: 'message',
                                            id_hash: 'id_hash',
                                            content_type: 'content_type',
                                        });
                                    </script>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
       </div>
    </section>
@stop