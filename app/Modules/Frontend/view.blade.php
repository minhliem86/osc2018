@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Modify Promotion</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
			{!!Form::model($promotion,array('route'=>array('admin.promotion.update',$promotion->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))!!}
				<div class="form-group">
					<label for="">Tên bài viết</label>
					{!!Form::text('name',old('name'),array('class'=>'form-control'))!!}
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
					<label for="" >Sắp xếp</label>
					{!!Form::text('order',old('order'),array('class'=>'form-control'))!!}
				</div>

				<div class="form-group">
					<label for="" >Hình đại diện</label>
					<p>
						<img src="{!!$promotion->img_icon!!}" width="150" alt="">
						{!!Form::hidden('img-bk',$promotion->img_icon)!!}
					</p>
					{!!Form::file('img')!!}
				</div>
				<div class="form-group">
					<label for="" >Hình trang chi tiết</label>
					<p>
						<img src="{!!$promotion->img_avatar!!}" width="150" alt="">
						{!!Form::hidden('img-bk-chitiet',$promotion->img_avatar)!!}
					</p>
					{!!Form::file('img-slide')!!}
				</div>
				<div class="form-group">
					<span class="inline-radio"><input type="radio" name="status" value="1" {!!$promotion->status == 1 ? 'checked' : ''!!}> <b>Active</b> </span>
					<span class="inline-radio"><input type="radio" name="status" value="0" {!!$promotion->status == 0 ? 'checked' : ''!!}> <b>Deactive</b> </span>
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