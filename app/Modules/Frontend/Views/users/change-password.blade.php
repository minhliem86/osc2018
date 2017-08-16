@extends('Frontend::users.layout-customer')

@section('content')
  <div class="fullwidth bg-login">
    <div class="wrap-panel">
      <div class="wrap-table-cell">
        <div class="logo">
          <a href="#" class="logo-href">
            <img src="{!!asset('public/assets/frontend/')!!}/images/customers/logo-login.png" alt="">
          </a>
        </div> <!-- end logo -->
        <h2 class="title">CHÀO MỪNG ĐẾN VỚI TRAVEL BLOG  <span>CỦA CHƯƠNG TRÌNH DU HỌC HÈ 2017</span></h2>
        <h3 class="note">
          {!! Session::has('first_time') ? 'Đây là lần đăng nhập đầu tiên hoặc bạn chưa thay đổi mật khẩu. Bạn có thể thay đổi mật khẩu hoặc bỏ qua bước này' : 'Thay đổi mật khẩu'  !!}
        </h3>
        <div class="wrap-form">
          {!!Form::open(['route'=>['f.postChangePass'],'class'=>'form' , 'id'=>'form-login'])!!}
            <div class="form-group has-feedback">
              <i class="form-control-feedback right-feedback glyphicon glyphicon-lock"></i>
              <input type="password" name="new_password" class="form-control" placeholder="New Password">
            </div>
            <div class="form-group has-feedback">
              <i class="form-control-feedback right-feedback glyphicon glyphicon-lock"></i>
              <input type="password" name="new_password_confirmation" class="form-control" placeholder="Password Confirmation">
            </div>
            <div class="form-group text-center">
              <input type="submit" class="btn-submit-login" value="thay đổi">
              <a href="{!!route('f.album')!!}" class="back">Bỏ qua</a>
            </div>
          {!!Form::close()!!}
          @if($errors->any())
            @foreach($errors->all() as $error)
              <div class="alert alert-danger" role="alert">
                <p>{!!$error!!}</p>
              </div>
            @endforeach
          @endif
        </div>

      </div>  <!-- end table - cell -->
    </div>  <!-- content- login -->
  </div>
@stop
