<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!!csrf_token()!!}">
    <meta property="og:description" content="ILA Du Học giới thiệu chương trình Du Học Hè 2017 với 4 giá trị cốt lõi: Phiêu Lưu, Trải Nghiệm, Tự Lập và Trưởng Thành." >

    @yield('meta')
    <title>@yield('title','ILA Du Học Hè 2017')</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <!-- Custom Css -->
    <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/css/swiper.css">
    <link href="{!!asset('public/assets/frontend/')!!}/css/style.css" rel="stylesheet">
    <link href="{!!asset('public/assets/frontend/')!!}/css/reponsive.css" rel="stylesheet">
    <link href="{!!asset('public/assets/frontend/')!!}/css/custom-lp.css" rel="stylesheet">
    @yield('css')
    <!-- Custom JS -->
    <!-- <script src="{!!asset('public/assets/frontend/')!!}js/scrip.js"></script> -->

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
fbq('init', '1074624056001173');
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1"
src="https://www.facebook.com/tr?id=1074624056001173&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->


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
fbq('init', '955386641272538');
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1"
src="https://www.facebook.com/tr?id=955386641272538&ev=PageView
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

@yield('ga-travel')

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W8GRGZX');</script>
<!-- End Google Tag Manager -->
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=592c008ede4761001225d34c&product=sop' async='async'></script>
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
                @include('Frontend::layouts.header')
                <!--====================== / Header ======================-->

                <!--====================== Content ======================-->
                <article class="container-fluid">
                    <div class="row {!!Route::getCurrentRoute()->getActionName() == 'App\Modules\Frontend\Controllers\DestinationController@getCountry' ? 'destination' : ''!!} {!!Request::segment(1) == '' ? 'home' : ''!!} {!!Request::segment(1) == 'lien-he' ? 'contact' : ''!!} {!!Route::getCurrentRoute()->getActionName() == 'App\Modules\Frontend\Controllers\DestinationController@getTour' ? 'course-detail' : ''!!} {!!Request::segment(1) == 'khuyen-mai' ? 'promotion' : ''!!} {!!Request::segment(1) == 'trai-nghiem-du-hoc' ? 'testtimonial-box' : ''!!} ">

                        @yield('content')
                    </div>
                </article>
                <!--====================== /Content ======================-->

                <!--====================== Footer ======================-->
                @include('Frontend::layouts.footer')
                <!--====================== /Footer ======================-->
            </div>
        </div>
    </div>
    <script src="{!!asset('public/assets/frontend/')!!}/js/jquery-2.1.1.js" type="text/javascript"></script>
    <script src="{!!asset('public/assets/frontend/')!!}/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{!!asset('public/assets/frontend')!!}/js/jquery.validate.min.js"></script>
    <script src="{!!asset('public/assets/frontend/')!!}/js/swiper.min.js"></script>
    <script src="{!!asset('public/assets/frontend/')!!}/js/jquery.matchHeight.js"></script>
    <script src="{!!asset('public/assets/frontend/')!!}/js/jquery.md5.js"></script>
    <!-- REVOLUTION -->
    <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/js/revolution/css/settings.css">
    <script src="{!!asset('public/assets/frontend/')!!}/js/revolution/jquery.themepunch.plugins.min.js"></script>
    <script src="{!!asset('public/assets/frontend/')!!}/js/revolution/jquery.themepunch.revolution.min.js"></script>
    <!-- END -->
    <script>
        $(document).ready(function () {
            $('.wrap-multi-country').matchHeight({})
            $('#id_city').on('change',function(){
                var id_city = $(this).val();
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{!!route('contact.postAjaxCenter')!!}",
                    data: {'_token':token, 'data':id_city},
                    type: "POST",
                    success:function(data){
                        $('#id_center').val(data.rs);
                    },
                })
            });
        });
    </script>
     <script>
        $(document).ready(function(){
            $('.banner-homepage .tp-banner').revolution({
                delay:5000,
                startwidth:1170,
                startheight:350,
                hideThumbs:10,
                navigationType:'none'
            })

            $('.banner-mobile .tp-banner').revolution({
                delay:5000,
                startwidth:800,
                startheight:600,
                hideThumbs:10,
                navigationType:'none'
            })


        })
        $(document).ready(function(){
        $('#formOSC').validate({
            errorElement: "span",
            rules: {
                name: "required",
                email: "required",
                phone: {required: true, digits: true, minlength: 10, maxlength: 11},
                id_city: "required",
                country: "required"
            },
            messages: {
                name: "Vui lòng nhập họ tên",
                phone: {
                    required: "Vui lòng nhập số điện thoại di động",
                    digits: "Vui lòng nhập số điện thoại di động",
                    minlength: "Vui lòng nhập số điện thoại di động",
                },
                email: "Vui lòng nhập email",
                id_city: "Vui lòng chọn Thành Phố bạn đăng ký",
                country: "Vui lòng chọn quốc gia bạn muốn du học"
            },
            submitHandler:function(data){
                var strRandom = Math.random().toString(36);
                var d = new Date();
                strRandom += d.toLocaleString();
                $("input[name='id_hash']").val($.md5(strRandom));
                _swga.postLead();
            },
        })
    })
    </script>
    @yield('script')



    <!-- Google Code for Remarketing Tag -->
    <!--
    Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
    -->
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 934827352;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/934827352/?value=0&amp;guid=ON&amp;script=0"/>
    </div>
    </noscript>
    <!-- END -->

</body>

</html>
