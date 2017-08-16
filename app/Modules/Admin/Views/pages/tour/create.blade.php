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
					<label for="">Hình Sharing FB (600x315)</label>
					{!!Form::file('img-sharing')!!}
					@if($errors->first('img-sharing'))
						<p class="error">{!!$errors->first('img-sharing')!!}</p>
					@endif
				</div>

        <div class="form-group">
  					<label for="">Hình banner desktop (1170x350)</label>
  					{!!Form::file('banner_desktop')!!}
  					@if($errors->first('banner_desktop'))
  						<p class="error">{!!$errors->first('banner_desktop')!!}</p>
  					@endif
				</div>

        <div class="form-group">
  					<label for="">Hình banner mobile (768x450)</label>
  					{!!Form::file('banner_mobile')!!}
  					@if($errors->first('banner_mobile'))
  						<p class="error">{!!$errors->first('banner_mobile')!!}</p>
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
					<label for="">Khu vực đăng ký</label>
					{!!Form::select('location_id',$location,'',['class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					<label for="">Mô tả</label>
					{!!Form::textarea('description',old('description'),array('class'=>'form-control','rows'=>3))!!}
				</div>
				<div class="form-group">
					<label for="">Nội dung</label>
					{!!Form::textarea('content',old('content'),array('class'=>'form-control ckeditor'))!!}
				</div>

				<!-- SCHEDULE -->
				<!-- <div class="form-group">
					<label for="">Lịch trình</label>
					<div class="container-fluid">
						<div class="wrap-schedule">
							<div class="each-schedule" style="margin-bottom:10px;">
								<div class="form-group">
									<input type="text" name="scheduletitle[]" class="form-control" placeholder="Tiêu đề (vd Tuần 1: 15/01 - 20/01/2017)">
								</div>
								<div class="form-group">
									<textarea name="schedulecontent[]"  rows="3" class="form-control" placeholder="Nội dung Lịch trình"></textarea>
								</div>
								<div class="form-group">
									<input type="file" name="scheduleimg[]">
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-primary" id="addschedule">Thêm Lịch trình</button>
				</div> -->

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
		$('.date').datepicker({
			'dateFormat': 'dd-mm-yy'
		});

		// ADD SCHEDULE
		// $('#addschedule').on('click',function(){
		// 	$('.each-schedule:first-child').clone().appendTo('.wrap-schedule');
		// })
	})
</script>
@stop
