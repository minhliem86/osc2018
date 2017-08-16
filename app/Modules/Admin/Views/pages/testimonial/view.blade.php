@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Modify Testimonial</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
			{!!Form::model($testimonial,array('route'=>array('admin.testimonial.update',$testimonial->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))!!}
				<div class="form-group">
					<label for="">Tên bài viết</label>
					{!!Form::text('title',old('title'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Tác giả</label>
					{!!Form::text('author',old('author'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Mô tả</label>
					{!!Form::textarea('description',old('description'),array('class'=>'form-control','rows'=>3))!!}
				</div>
				<div class="form-group">
					<label for="" >Nội dung</label>
					{!!Form::textarea('content',old('content'),array('class'=>'form-control ckeditor'))!!}
				</div>
				
				<div class="form-group">
					<label for="" >Thứ tự</label>
					{!!Form::text('order',old('order'),array('class'=>'form-control'))!!}
				</div>

				<div class="form-group">
					<label for="" >Hình đại diện</label>
					<p>
						<img src="{!!$testimonial->img_avatar!!}" width="150" alt="">
						{!!Form::hidden('img-bk',$testimonial->img_avatar)!!}
					</p>
					{!!Form::file('img')!!}
				</div>
				<div class="form-group">
					<label for="" >Hình slideshow</label>
					<p>
						<img src="{!!$testimonial->img_slides!!}" width="150" alt="">
						{!!Form::hidden('imgslide-bk',$testimonial->img_slides)!!}
					</p>
					{!!Form::file('imgslide')!!}
				</div>
				<div class="form-group">
					<span class="inline-radio"><input type="radio" name="status" value="1" {!!$testimonial->status == 1 ? 'checked' : ''!!}> <b>Active</b> </span>
					<span class="inline-radio"><input type="radio" name="status" value="0" {!!$testimonial->status == 0 ? 'checked' : ''!!}> <b>Deactive</b> </span>
				</div>
				<div class="form-group">
					<label for="">Nổi bật</label>
					<div>
						<span class="inline-radio"><input type="radio" name="focus" value="1" {!!$testimonial->focus == 1 ? 'checked' : ''!!}> <b>Active</b> </span>
						<span class="inline-radio"><input type="radio" name="focus" value="0" {!!$testimonial->focus == 0 ? 'checked' : ''!!}> <b>Deactive</b> </span>
					</div>
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