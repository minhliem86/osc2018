@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Promotion</h1>
</section>
<section class="content">

	<div class="box">
		<div class="container-fluid">
			{!!Form::open(array('route'=>array('admin.promotion.store'),'class'=>'formAdmin form-horizontal','files'=>true))!!}
				<div class="form-group">
					<label for="">Avatar Photo</label>
					{!!Form::file('img_avatar')!!}
					@if($errors->first('img_avatar'))
						<p class="error">{!!$errors->first('img_avatar')!!}</p>
					@endif
				</div>
        <div class="form-group">
					<label for="">Icon Photo</label>
					{!!Form::file('img_icon')!!}
					@if($errors->first('img_icon'))
						<p class="error">{!!$errors->first('img_icon')!!}</p>
					@endif
				</div>
				<div class="form-group">
					<label for="">Title</label>
					{!!Form::text('name',old('name'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Description</label>
					{!!Form::textarea('description',old('description'),array('class'=>'form-control'))!!}
				</div>
        <div class="form-group">
					<label for="">Content</label>
					{!!Form::textarea('content',old('content'),array('class'=>'form-control'))!!}
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
    <link rel="stylesheet" href="{!!asset('public/assets/backend/js/bootstrap-upload/css/fileinput.min.css')!!}" />
    <script src="{!!asset('public/assets/backend/js/bootstrap-upload/js/plugins/sortable.min.js')!!}"></script>
    <script src="{!!asset('public/assets/backend/js/bootstrap-upload/js/fileinput.min.js')!!}"></script>

@stop
