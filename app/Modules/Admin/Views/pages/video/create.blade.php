@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Video</h1>
</section>
<section class="content">

	<div class="box">
		<div class="container-fluid">
			{!!Form::open(array('route'=>array('admin.video.store'),'class'=>'formAdmin form-horizontal','files'=>true))!!}
                <div class="form-group">
                    <label for="">Tours</label>
                    {!!Form::select('tour_id', ['' => 'Select Tour'] + $tour,'', ['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    <div class="ajax-album"></div>
                </div>
				<div class="form-group">
					<label for="">Title Video</label>
					{!!Form::text('title',old('title'),array('class'=>'form-control'))!!}
				</div>
                <div class="form-group">
					<label for="">Video ID</label>
					{!!Form::text('video_url',old('video_url'),array('class'=>'form-control'))!!}
				</div>
                <div class="form-group">
                    <label for="">Hình đại diện ()</label>
                    {!!Form::file('img')!!}
                    @if($errors->first('img'))
                        <p class="error">{!!$errors->first('img')!!}</p>
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
