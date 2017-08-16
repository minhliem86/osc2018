<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Customer-Dashboard</title>
</head>
<body>
  {!!Form::open(['route'=>['f.postChangePass'],'class'=>'formLogin' ])!!}

    <div class="form-group">
      {!!Form::password('new_password', ['class'=>'forn-control'] )!!}
    </div>
    <div class="form-group">
      {!!Form::password('new_password_confirmation', ['class'=>'forn-control'] )!!}
    </div>
    <div class="form-group">
      {!!Form::submit('Thay đổi')!!}
    </div>
  {!!Form::close()!!}

  @if($errors->any())
    @foreach($errors->all() as $error)
      <p>{{$error}}</p>
    @endforeach
  @endif
</body>
</html>
