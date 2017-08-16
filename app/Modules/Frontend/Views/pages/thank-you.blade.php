<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank you</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <!-- Custom Css -->
    <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/css/swiper.css">
    <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/css/bootstrap.min.css">
    <link href="{!!asset('public/assets/frontend/')!!}/css/style.css" rel="stylesheet">
    <link href="{!!asset('public/assets/frontend/')!!}/css/reponsive.css" rel="stylesheet">
    <link href="{!!asset('public/assets/frontend/')!!}/css/custom-lp.css" rel="stylesheet">

 <!-- FB Fixel-->
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '130923730765955'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=130923730765955&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
    
    <!-- GOOGLE ANALYTIC -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-60129748-14', 'auto');
      ga('send', 'pageview');

    </script>
<!-- END -->

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W8GRGZX');</script>
<!-- End Google Tag Manager -->

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W8GRGZX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div class="osc-summer">
        <div class="container-fluid">
            <div class="row">
                <!--====================== Heade ======================-->
                <header>
                    <div class="container">
                        <div class="row">
                            <div class="inner-section bg-yellow inner-header">
                                <div class="container-fluid">
                                    <div class="row">
                                         <div class="col-xs-3">
                                            <div class="logo-box">
                                                <a href="{!!route('home')!!}"><img class="img-responsive" src="{!!asset('public/assets/frontend')!!}/images/logo.png" alt="Ila Edu"></a>
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="topmenu">
                                                <nav class="navbar navbar-default navbar-right" role="navigation">
                                                        <div class="navbar-header">
                                                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                                                <span class="icon-bar"></span>
                                                                <span class="icon-bar"></span>
                                                                <span class="icon-bar"></span>
                                                            </button>
                                                        </div>
                                                        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                                                            <ul class="nav navbar-nav">
                                                                <li class="{!!Active::setActive(1,'')!!}"><a href="{!!route('home')!!}">TRANG CHỦ</a></li>
                                                                <li class="dropdown ">
                                                                    <a href="destination.html" class="dropdown-toggle" data-toggle="dropdown">QUỐC GIA <span class="caret"></span></a>
                                                                    @if($countries)
                                                                    <ul class="dropdown-menu">
                                                                        @foreach($countries as $item_country)
                                                                         <li><a href="{!!route('quocgia',$item_country->slug)!!}">{!!$item_country->name!!}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                    @endif
                                                                </li>
                                                                <li class=""><a href="{!!route('khuyenmai')!!}">KHUYẾN MÃI</a></li>
                                                                <li class=""><a href="{!!route('trainghiem')!!}">TRẢI NGHIỆM DU HỌC</a></li>
                                                                <li class=""><a href="{!!route('contact')!!}"><b>ĐĂNG KÝ</b></a></li>
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
                <!--====================== / Header ======================-->

                <!--====================== Content ======================-->
                <article class="container-fluid">
                    <div class="row">
                        <!-- **************** Banner ****************-->
                        <section class="page-404">
                            <div class="container">
                                <div class="row">
                                    <div class="inner-section">
                                        <div class="wrap-404">
                                            <div class="wrap-table-cell">
                                                <h2 class="title">Cảm ơn bạn đã đăng ký thông tin tại ILA Du học.<br/>Nhân viên ILA sẽ liên lạc với bạn trong thời gian sớm nhất.</h2>
                                                <a class="btn btn-return" href="{!!route('home')!!}">Trở về trang chủ</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- **************** /Register ****************-->
                    </div>
                </article>
                <!--====================== /Content ======================-->

                <!--====================== Footer ======================-->
                <footer>
                    <div class="container bg-yellow footer-inner">
                        <div class="wrap-each-footer">
                            <h4>HỒ CHÍ MINH</h4>
                            <p><a href="tel:0903891511">0903 891 511</a> - <a href="tel:0909976636">0909 976 636</a><br/><a href="tel:0938264343">0938 264 343</a></p>
                            <h4>HÀ NỘI</h4>
                            <p><a href="tel:0912766549">0912 766 549</a> - <a href="tel:0938915488">0938 915 488</a></p>
                        </div>
                        <div class="wrap-each-footer">
                            <h4>ĐÀ NẴNG</h4>
                            <p><a href="tel:0914022599">0914 022 599</a> - <a href="tel:0905100910">0905 100 910</a></p>
                            <h4>VŨNG TÀU</h4>
                            <p><a href="tel:0909753363">0909 753 363</a></p>
                        </div>

                        <div class="wrap-each-footer">
                            <p class="website"><a href="http://www.ila-duhoc.edu.vn" target="_blank">ila-duhoc.edu.vn</a></p>
                            <p class="mail"><a href="mailto:duhoc@ilavietnam.edu.vn" >duhoc@ilavietnam.edu.vn</a></p>
                            <p class="fb"><a href="http://facebook.com/ILADuhoc" target="_blank">facebook.com/ILADuhoc</a></p>
                        </div>
                        <div class="wrap-each-footer">
                            <a href="{!!route('contact')!!}" class="btn btn-reg">ĐĂNG KÝ</a>
                        </div>
                    </div>
                </footer>
                <!--====================== /Footer ======================-->
            </div>
        </div>
    </div>
    <!-- Google Code for ILA Du H&#7885;c H&egrave; 2017 Conversion Page -->
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 934827352;
    var google_conversion_language = "en";
    var google_conversion_format = "3";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "wtezCJSf9m0Q2KrhvQM";
    var google_remarketing_only = false;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/934827352/?label=wtezCJSf9m0Q2KrhvQM&amp;guid=ON&amp;script=0"/>
    </div>
    </noscript>


</body>

</html>