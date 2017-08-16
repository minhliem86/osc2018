<header>
    <div class="container">
        <div class="row">
            <div class="inner-section bg-yellow inner-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 hidden-xs hidden-sm">
                            <div class="logo-box">
                                <a href="{!!route('home')!!}"><img class="img-responsive" src="{!!asset('public/assets/frontend')!!}/images/logo.png" class="img-responsive" alt="Ila Du Học Hè 2017"></a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="topmenu">
                                <nav class="navbar navbar-default navbar-right" role="navigation">
                                        <div class="navbar-header">
                                            <a href="{!!route('home')!!}" class="visible-xs visible-sm logo-mobile"><img class="img-responsive" src="{!!asset('public/assets/frontend')!!}/images/logo.png" class="img-responsive" alt="Ila Du Học Hè 2017"></a>
                                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                                            <ul class="nav navbar-nav">
                                                <li class="{!!Active::setActive(1,'')!!}"><a href="{!!route('home')!!}">TRANG CHỦ</a></li>
                                                <li class="dropdown {!! Route::getCurrentRoute()->getActionName()!= null && Route::getCurrentRoute()->getActionName() == 'App\Modules\Frontend\Controllers\DestinationController@getCountry' ? 'active' : ''!!}">
                                                    <a href="destination.html" class="dropdown-toggle" data-toggle="dropdown">QUỐC GIA <span class="caret"></span></a>
                                                    @if($country)
                                                    <ul class="dropdown-menu">
                                                        @foreach($country as $item_country)
                                                         <li><a href="{!!route('quocgia',$item_country->slug)!!}">{!!$item_country->name!!}</a></li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                <li class="{!!Active::setActive(1,'khuyen-mai')!!}"><a href="{!!route('khuyenmai')!!}">KHUYẾN MÃI</a></li>
                                                <li class="{!!Active::setActive(1,'trai-nghiem-du-hoc')!!}"><a href="{!!route('trainghiem')!!}">TRẢI NGHIỆM DU HỌC</a></li>
                                                <li class="{!!Active::setActive(1,'lien-he')!!}"><a href="{!!route('contact')!!}"><b>ĐĂNG KÝ</b></a></li>
                                                <li class="dropdown">
                                                  @if(Auth::client()->check())
                                                  <a href="javascript:avoid()">Travel Blog</a>
                                                  <ul class="dropdown-menu">
                                                      @if(Auth::client()->get()->super)
                                                        <li><a href="{!!route('f.superAlbum')!!}">Kiểm tra hình ảnh </a></li>
                                                        <li><a href="{!!route('f.reportBySuper')!!}">Report </a></li>
                                                      @endif
                                                       <li><a href="{!!route('f.album')!!}">Thư viện hình ảnh</a></li>
                                                       <li><a href="{!!route('f.getChangePass')!!}">Thay đổi mật khẩu</a></li>
                                                       <li><a href="{!!route('f.getLogoutCustomer')!!}">Đăng xuất</a></li>
                                                  </ul>
                                                </li>
                                              @else
                                                <li ><a href="{!!route('f.getLoginCustomer')!!}">Travel Blog</a></li>
                                              @endif
                                            </ul>
                                        </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</header>
