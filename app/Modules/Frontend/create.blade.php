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
					<label for="">Hình đại diện ()</label>
					{!!Form::file('img')!!}
					@if($errors->first('img'))
						<p class="error">{!!$errors->first('img')!!}</p>
					@endif
				</div>
				<div class="form-group">
					<label for="">Hình trang chi tiết()</label>
					{!!Form::file('img-slide')!!}
					@if($errors->first('img-slide'))
						<p class="error">{!!$errors->first('img-slide')!!}</p>
					@endif
				</div>
				<div class="form-group">
					<label for="">Tên bài viết</label>
					{!!Form::text('name',old('name'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Mô tả</label>
					{!!Form::textarea('description',old('description'),array('class'=>'form-control','rows'=>3))!!}
				</div>
				<div class="form-group">
					<label for="">Nội dung</label>
					{!!Form::textarea('content',old('content'),array('class'=>'form-control ckeditor'))!!}
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

</script>
@stop