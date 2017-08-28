@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Testimonial</h1>
</section>
<section class="content">

	<div class="box">
		<div class="container-fluid">
			{!!Form::open(array('route'=>array('admin.testimonial.store'),'class'=>'formAdmin form-horizontal','files'=>true))!!}
				<div class="form-group">
					<label for="">Hình đại diện</label>
					{!!Form::file('img_avatar')!!}
					@if($errors->first('img_avatar'))
						<p class="error">{!!$errors->first('img_avatar')!!}</p>
					@endif
				</div>
                <div class="form-group">
					<label for="">Author</label>
					{!!Form::text('author',old('author'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Title</label>
					{!!Form::text('title',old('title'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Description</label>
					{!!Form::textarea('description',old('description'),array('class'=>'form-control ckeditor'))!!}
				</div>
                <div class="form-group">
					<label for="">Content</label>
					{!!Form::textarea('content',old('content'),array('class'=>'form-control ckeditor'))!!}
				</div>
                <div class="form-group">
                    <label for="banner">Web Banner</label>
                    <input type="file" name="web[]"  class="web_banner" multiple>
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

    <script>
        $(document).ready(function(){
            $('.web_banner').fileinput({
                uploadUrl: '{!!route('admin.testimonial.create')!!}',
                uploadAsync: false,
                dropZoneEnabled:false,
                showCaption: false,
                showUpload: false,
                fileActionSettings:{
                    showDrag: true,
                    showUpload: false,
                }
            })
        })
    </script>

@stop
