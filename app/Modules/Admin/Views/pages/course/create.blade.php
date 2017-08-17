@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Tour</h1>
</section>
<section class="content">

	<div class="box">
		<div class="container-fluid">
			{!!Form::open(array('route'=>array('admin.course.store'),'class'=>'formAdmin form-horizontal','files'=>true))!!}
				<div class="form-group">
					<label for="">Hình đại diện</label>
					{!!Form::file('img')!!}
					@if($errors->first('img'))
						<p class="error">{!!$errors->first('img')!!}</p>
					@endif
				</div>
				<div class="form-group">
					<label for="">Tên tour</label>
					{!!Form::text('title',old('title'),array('class'=>'form-control'))!!}
				</div>
                <div class="form-group">
					<label for="">Code</label>
					{!!Form::text('tour_code',old('tour_code'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Thuộc quốc gia</label>
					{!!Form::select('country_id',$country,'',['class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					<label for="">Mô tả</label>
					{!!Form::textarea('description',old('description'),array('class'=>'form-control','rows'=>3))!!}
				</div>
				<div class="form-group">
					<label for="">Nội dung</label>
					{!!Form::textarea('content',old('content'),array('class'=>'form-control ckeditor'))!!}
				</div>
				<div class="form-group">
					<label for="">Đối tác</label>
					{!!Form::text('partner',old('partner'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Chỗ ở</label>
					{!!Form::text('stay',old('stay'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Thời gian dự kiến</label>
					{!!Form::text('week',old('week'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-4">
								<label for="">Bắt đầu ngày</label>
								{!!Form::text('start',old('start'),array('class'=>'form-control date'))!!}
							</div>
							<div class="col-sm-4">
								<label for="">Kết thúc ngày</label>
								{!!Form::text('end',old('end'),array('class'=>'form-control date'))!!}
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="">Giá </label>
					{!!Form::text('price',old('price'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Độ tuổi tham gia </label>
					{!!Form::text('age',old('age'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Trạng thái</label>
					<div>
						<span class="inline-radio"><input type="radio" name="status" value="1" checked=""> <b>Active</b> </span>
						<span class="inline-radio"><input type="radio" name="status" value="0" > <b>Deactive</b> </span>
					</div>
				</div>

                <div class="form-group">
                    <label for="web_banner">Web Banner</label>
                    <input type="file" name="web[]"  class="web_banner" multiple>
                </div>

                <div class="form-group">
                    <label for="web_banner">Mobile Banner</label>
                    <input type="file" name="mobile[]"  class="mobile_banner" multiple>
                </div>

                <div class="form-group">
					<label for="meta_keyword">Meta Keywords</label>
					{!!Form::text('meta_keyword',old('meta_keyword'),array('class'=>'form-control'))!!}
				</div>
                <div class="form-group">
					<label for="meta_description">Meta Description</label>
					{!!Form::text('meta_description',old('meta_description'),array('class'=>'form-control'))!!}
				</div>
                <div class="form-group">
					<label for="">Meta Share Image</label>
					{!!Form::file('img_share')!!}
					@if($errors->first('img_share'))
						<p class="error">{!!$errors->first('img_share')!!}</p>
					@endif
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
		$('.date').datepicker({
			'dateFormat': 'dd-mm-yy'
		});

        $('.web_banner, .mobile_banner').fileinput({
            uploadUrl: '{!!route('admin.country.create')!!}',
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
