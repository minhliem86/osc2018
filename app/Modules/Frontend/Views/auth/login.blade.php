<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Customer Login</title>
</head>
<body>
  {!!Form::open(['route'=>['f.postLoginCustomer'],'class'=>'formLogin' ])!!}
    <div class="form-group">
      {!!Form::text('username',old('username'), ['class'=>'forn-control'] )!!}
    </div>
    <div class="form-group">
      {!!Form::password('password', ['class'=>'forn-control'] )!!}
    </div>
    <div class="form-group">
      {!!Form::submit('Login')!!}
    </div>
  {!!Form::close()!!}

  @if($errors->any())
    @foreach($errors->all() as $error)
      <p>{{$error}}</p>
    @endforeach

  @endif
</body>
</html>
