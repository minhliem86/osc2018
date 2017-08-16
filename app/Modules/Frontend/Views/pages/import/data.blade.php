<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h2>Upload file Excel</h2>
  {!!Form::open(['route'=>['f.postImportUser'], 'files' => true, 'class'=> '' ])!!}
    <input type="file" name="file" value="" >
    <div class="form-group">
      <input type="submit" name="submit" value="Upload">
    </div>
  {!!Form::close()!!}
</body>
</html>
