@extends('Frontend::layouts.layout')

@section('title', 'ILA Du Học Hè 2017 - Thư viện hình ảnh')

@section('meta')
    <meta property="og:url" content="{!!route('f.hinhanh',$img->id)!!}" />
    <meta property="og:image" content="{!!$img->img_url!!}" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:description" content="{!! isset($img->title) && $img->title != '' ? $img->title : 'ILA Du Học giới thiệu chương trình Du Học Hè 2017 với 4 giá trị cốt lõi: Phiêu Lưu, Trải Nghiệm, Tự Lập và Trưởng Thành.'!!}" />
@stop
@section('css')
  <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/css/customer.min.css">
@stop
@section('script')
  <script src="{!!asset('public/assets/frontend/')!!}/js/swiper.min.js"></script>
@stop
@section('content')

  @include('Frontend::layouts.banner')


  <section class="all-album">
    <div class="container">
      <div class="row">
        @if(count($img))
        <div class="inner-section">
          <div class="load-photo text-center">
            <img src="{!!$img->img_url!!}" class="img-responsive" alt="">
            <p class="caption">{!!$img->title!!}</p>
          </div>
        </div>
        @endif
      </div>
    </div>
  </section>  <!-- end all-album -->

@stop
