<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Authencate email</title>
</head>
<body>
  @if (session('status'))
      <div class="alert alert-success">
          {!! session('status') !!}
      </div>
  @endif

  @if($errors->any())
    @foreach($errors->all() as $error)
      <p>{{$error}}</p>
    @endforeach
  @endif

  <form class="form-horizontal" role="form" method="POST" action="{!! route('f.getSendEmailReset') !!}">
      <input type="hidden" name="_token" value="{!! csrf_token() !!}">

      <div class="form-group">
          <label class="col-md-4 control-label">E-Mail Address</label>
          <div class="col-md-6">
              <input type="email" class="form-control" name="email" value="{!! old('email') !!}">
          </div>
      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                  Reset Password
              </button>
          </div>
      </div>
  </form>
</body>
</html>
