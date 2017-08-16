@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Album</h1>
</section>
<section class="content">

	<div class="box">
		<div class="container-fluid">
			{!!Form::open(array('route'=>array('admin.album.store'),'class'=>'formAdmin form-horizontal','files'=>true))!!}
				<div class="form-group">
					<label for="">Hình đại diện (555x292)</label>
					{!!Form::file('img')!!}
					@if($errors->first('img'))
						<p class="error">{!!$errors->first('img')!!}</p>
					@endif
				</div>
        <div class="form-group">
          <label for="">Chọn Tour</label>
          {!!Form::select('tour_id',['' => 'Select Course']+ $tour_list, old('album_id'), ['class'=>'form-control'] )!!}
        </div>
				<div class="form-group">
					<label for="">Tiêu đề</label>
					{!!Form::text('title',old('title'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-margin">
					<label for="">Trạng thái</label>
					<div>
						<span class="inline-radio"><input type="radio" name="status" value="1" checked=""> <b>Active</b> </span>
						<span class="inline-radio"><input type="radio" name="status" value="0" > <b>Deactive</b> </span>
					</div>
				</div>
				<div class="form-group">
					{!!Form::submit('Save',array('class'=>'btn btn-primary'))!!}
					<a href="{!!URL::previous()!!}" class="btn btn-primary">Back</a>
				</div>
			{!!Form::close()!!}
		</div>
	</div>
</section>
@stop

@section('script')
<script>
    $(document).ready(function(){
        {!! Notification::showSuccess('alertify.success(":message");') !!}
        {!! Notification::showError('alertify.error(":message");') !!}
    })
</script>
@stop
