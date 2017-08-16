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
        <div class="wrap-form">
          @if(Session::has('success'))
              <div class="alert alert-success" role="alert">
                <p>{!!Session::get('success')!!}</p>
              </div>
          @endif
          {!!Form::open(['route'=>['f.postLoginCustomer'],'class'=>'form' , 'id'=>'form-login'])!!}
            <div class="form-group has-feedback">
              <i class="form-control-feedback right-feedback glyphicon glyphicon-user"></i>
              <input type="text" name="username" class="form-control" placeholder="Username" value="{!!old('username')!!}">
            </div>
            <div class="form-group has-feedback">
              <i class="form-control-feedback right-feedback glyphicon glyphicon-lock"></i>
              <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group text-center">
              <input type="submit" class="btn-submit-login" value="Travel Blog">
              <a href="{!!route('home')!!}" class="back">Trang chủ</a>
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
