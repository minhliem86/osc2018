@extends('Admin::layouts.layout')

@section('content')

<section class="content-header">
  <h1>Promotion</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
			{!!Form::model($testimonial,array('route'=>array('admin.promotion.update',$testimonial->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))!!}
      <div class="form-group">
          <label for="">Avatar Photo</label>
          <p>
            <img src="{!!asset('public/upload')!!}/{!!$testimonial->img_avatar!!}" width="150" alt="">
            {!!Form::hidden('img-avatar-bk',$testimonial->img_avatar)!!}
          </p>
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
        {!!Form::textarea('description',old('description'),array('class'=>'form-control'))!!}
      </div>
      <div class="form-group">
        <label for="">Content</label>
        {!!Form::textarea('content',old('content'),array('class'=>'form-control'))!!}
      </div>
      <div class="form-group">
          <label for="">Order</label>
          {!!Form::text('order',old('order'),array('class'=>'form-control'))!!}
      </div>
      <div class="form-group">
          <label for="">Status</label>
          <div>
              <span class="inline-radio"><input type="radio" name="status" value="1" {!!$testimonial->status == 1 ? 'checked' : ''!!}> <b>Active</b> </span>
              <span class="inline-radio"><input type="radio" name="status" value="0" {!!$testimonial->status == 0 ? 'checked' : ''!!}> <b>Deactive</b> </span>
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
<link rel="stylesheet" href="{!!asset('public/assets/backend/js/bootstrap-upload/css/fileinput.min.css')!!}" />
<script src="{!!asset('public/assets/backend/js/bootstrap-upload/js/plugins/sortable.min.js')!!}"></script>
<script src="{!!asset('public/assets/backend/js/bootstrap-upload/js/fileinput.min.js')!!}"></script>
@stop
