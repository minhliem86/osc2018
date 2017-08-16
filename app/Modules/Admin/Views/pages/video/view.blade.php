@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Modify Video</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
			{!!Form::model($inst,array('route'=>array('admin.video.update',$inst->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))!!}
                <div class="form-group">
                    <label for="">Tour Code</label>
                    {!!Form::select('tour_id', ['' => 'Select Tour'] + $tour, '', ['class' => 'form-control'])!!}
                </div>
                <div class="form-group">
                    <div class="ajax-album">
                        <label for="">Album</label>
                        {!!Form::select('album_id', ['' => 'Select Album'] + $album, $inst->album_id, ['class' => 'form-control'])!!}
                    </div>
                </div>
				<div class="form-group">
					<label for="">Tiêu đề</label>
					{!!Form::text('title',old('title'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="">Video ID</label>
					{!!Form::text('video_url',old('video_url'),array('class'=>'form-control'))!!}
				</div>
				<div class="form-group">
					<label for="" >Sắp xếp</label>
					{!!Form::text('order',old('order'),array('class'=>'form-control'))!!}
				</div>

				<div class="form-group">
					<label for="" >Hình đại diện</label>
					<p>
						<img src="{!!$inst->img_url!!}" width="150" alt="">
						{!!Form::hidden('img-bk',$inst->img_url)!!}
					</p>
					{!!Form::file('img')!!}
                    @if($errors->first('img'))
                        <p class="error">{!!$errors->first('img')!!}</p>
                    @endif
				</div>
				<div class="form-group">
					<span class="inline-radio"><input type="radio" name="status" value="1" {!!$inst->status == 1 ? 'checked' : ''!!}> <b>Active</b> </span>
					<span class="inline-radio"><input type="radio" name="status" value="0" {!!$inst->status == 0 ? 'checked' : ''!!}> <b>Deactive</b> </span>
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
$(document).ready(function(){
    $('select[name="tour_id"]').change(function(){
        var tour_id = $(this).val();
        $.ajax({
            url: "{{route('admin.video.postAjaxGetAlbum')}}",
            type: 'POST',
            data: {tour_id: tour_id,  _token:$('meta[name="csrf-token"]').attr('content') },
            success:function(data){
                $('.ajax-album').html(data.rs)
            }
        })
    })
})
</script>
@stop
