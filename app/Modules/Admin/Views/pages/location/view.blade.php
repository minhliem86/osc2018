@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Location</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
			{!!Form::model($location,array('route'=>array('admin.location.update',$location->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))!!}
				<div class="form-group">
					<label for="">Khu vực</label>
					{!!Form::text('title',old('title'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">ID City (get from http://ila.edu.vn/liem/public/dataMRT )</label>
					{!!Form::text('id_city',old('id_city'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">ID Center (get from http://ila.edu.vn/liem/public/dataMRT )</label>
					{!!Form::text('id_center',old('id_center'),array('class'=>'form-control'))!!}
				</div>
				
				<div class="form-group">
					<label for="" >Sắp xếp</label>
					{!!Form::text('order',old('order'),array('class'=>'form-control'))!!}
				</div>

				<div class="form-group">
					<span class="inline-radio"><input type="radio" name="status" value="1" {!!$location->status == 1 ? 'checked' : ''!!}> <b>Active</b> </span>
					<span class="inline-radio"><input type="radio" name="status" value="0" {!!$location->status == 0 ? 'checked' : ''!!}> <b>Deactive</b> </span>
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