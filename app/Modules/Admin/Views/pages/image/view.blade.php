@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Modify Image</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
			{!!Form::model($image,array('route'=>array('admin.image.update',$image->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))!!}
				<div class="form-group">
					<label for="" >Hình ảnh</label>
					<p>
						<img src="{!!$image->img_url!!}" width="150" alt="">
						{!!Form::hidden('img-bk',$image->img_url)!!}
					</p>
					{!!Form::file('img')!!}
				</div>
				<div class="form-group">
					<label for="" >Thứ Tự</label>
					{!!Form::text('order',old('order'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="" >Loại (hint: banner)</label>
					{!!Form::text('type',old('type'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<span class="inline-radio"><input type="radio" name="status" value="1" {!!$image->status == 1 ? 'checked' : ''!!}> <b>Active</b> </span>
					<span class="inline-radio"><input type="radio" name="status" value="0" {!!$image->status == 0 ? 'checked' : ''!!}> <b>Deactive</b> </span>
				</div>

				<div class="form-group">
					{!!Form::submit('Save',array('class'=>'btn btn-primary'))!!}
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