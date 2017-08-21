@extends('Admin::layouts.layout')

@section('content')

<section class="content-header">
  <h1>Promotion</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
			{!!Form::model($promotion,array('route'=>array('admin.promotion.update',$promotion->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))!!}
          <div class="form-group">
              <label for="">Avatar Photo</label>
              <p>
    						<img src="{!!asset('public/upload')!!}/{!!$promotion->img_avatar!!}" width="150" alt="">
    						{!!Form::hidden('img-bk',$promotion->img_avatar)!!}
    					</p>
              {!!Form::file('img_avatar')!!}
              @if($errors->first('img_avatar'))
                  <p class="error">{!!$errors->first('img_avatar')!!}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="">Icon Photo</label>
              <p>
    						<img src="{!!asset('public/upload')!!}/{!!$promotion->img_icon!!}" width="150" alt="">
    						{!!Form::hidden('img-bk',$promotion->img_icon)!!}
    					</p>
              {!!Form::file('img_icon')!!}
              @if($errors->first('img_icon'))
                  <p class="error">{!!$errors->first('img_icon')!!}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="">Country</label>
              {!!Form::text('name',old('name'),array('class'=>'form-control'))!!}
          </div>
          <div class="form-group">
              <label for="">Description</label>
              {!!Form::textarea('description',old('description'),array('class'=>'form-control'))!!}
          </div>
          <div class="form-group">
              <label for="">Order</label>
              {!!Form::text('order',old('order'),array('class'=>'form-control'))!!}
          </div>
          <div class="form-group">
              <label for="">Status</label>
              <div>
                  <span class="inline-radio"><input type="radio" name="status" value="1" {!!$promotion->status == 1 ? 'checked' : ''!!}> <b>Active</b> </span>
                  <span class="inline-radio"><input type="radio" name="status" value="0" {!!$promotion->status == 0 ? 'checked' : ''!!}> <b>Deactive</b> </span>
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
