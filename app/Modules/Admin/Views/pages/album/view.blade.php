@extends('Admin::layouts.layout')

@section('content')

<section class="content-header">
  <h1>Country</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
      {!!Form::model($album,array('route'=>array('admin.album.update',$album->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))!!}
				<div class="form-group">
					<label for="">Hình đại diện (555x292)</label>
          <p>
						<img src="{!!$album->img_url!!}" width="150" alt="">
						{!!Form::hidden('img-bk',$album->img_url)!!}
					</p>
					{!!Form::file('img')!!}
					@if($errors->first('img'))
						<p class="error">{!!$errors->first('img')!!}</p>
					@endif
				</div>
        <div class="form-group">
          <label for="">Chọn Tour</label>
          {!!Form::select('tour_id', ['' => 'Select Course'] + $tour_list, old('album_id'), ['class'=>'form-control'] )!!}
        </div>
				<div class="form-group">
					<label for="">Tiêu đề</label>
					{!!Form::text('title',old('title'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-margin">
					<label for="">Trạng thái</label>
					<div>
						<span class="inline-radio"><input type="radio" name="status" value="1" {!!$album->status ? 'checked' : ' '!!}> <b>Active</b> </span>
						<span class="inline-radio"><input type="radio" name="status" value="0" {!!!$album->status ? 'checked' : ' '!!}> <b>Deactive</b> </span>
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
	$('.remove-banner').click(function(){
		var thisbtn = $(this);
		var id = thisbtn.data('id');
		alertify.confirm('You can not undo this action. Are you sure ?', function(e){
			if(e){
				$.ajax({
					'url':'{!!route("admin.country.removeBanner")!!}',
					'data' : {id: id,_token:$('meta[name="csrf-token"]').attr('content')},
					'type':'POST',
					'success':function(data){
						thisbtn.parent().remove();
					}
				})
			}
		})
	})
})
</script>
@stop
