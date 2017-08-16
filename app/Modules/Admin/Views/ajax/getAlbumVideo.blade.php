<label for="">Select Album</label>
{!!Form::select('album_id',['' => 'Select Album'] + $album,'', ['class'=> 'form-control'])!!}
