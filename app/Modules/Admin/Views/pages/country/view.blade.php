@extends('Admin::layouts.layout')

@section('content')

<section class="content-header">
  <h1>Country</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
			{!!Form::model($country,array('route'=>array('admin.country.update',$country->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))!!}
                <div class="form-group">
                    <label for="">Hình đại diện</label>
                    <p>
						<img src="{!!asset('public/upload')!!}/{!!$country->img_avatar!!}" width="150" alt="">
						{!!Form::hidden('img-bk',$country->img_avatar)!!}
					</p>
                    {!!Form::file('img')!!}
                    @if($errors->first('img'))
                        <p class="error">{!!$errors->first('img')!!}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Quốc gia</label>
                    {!!Form::text('name',old('name'),array('class'=>'form-control'))!!}
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    {!!Form::textarea('description',old('description'),array('class'=>'form-control'))!!}
                </div>
                <div class="form-group">
                    <label for="">Kết hợp nhiều quốc gia</label>
                    <div>
                        <span class="inline-radio"><input type="radio" name="multi_countries" value="1" {!!$country->multi_countries == 1 ? 'checked' : ''!!}> <b>Có</b> </span>
                        <span class="inline-radio"><input type="radio" name="multi_countries" value="0" {!!$country->multi_countries == 0 ? 'checked' : ''!!}> <b>Không</b> </span>
                    </div>

                </div>
                <div class="form-group">
                    <label for="">Hiển thị theo lựa chọn</label>
                    <div>
                        <span class="inline-radio"><input type="radio" name="home_show" value="1" {!!$country->home_show == 1 ? 'checked' : ''!!}> <b>Có</b> </span>
                        <span class="inline-radio"><input type="radio" name="home_show" value="0" {!!$country->home_show == 0 ? 'checked' : ''!!}> <b>Không</b> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div>
                        <span class="inline-radio"><input type="radio" name="status" value="1" {!!$country->status == 1 ? 'checked' : ''!!}> <b>Active</b> </span>
                        <span class="inline-radio"><input type="radio" name="status" value="0" {!!$country->status == 0 ? 'checked' : ''!!}> <b>Deactive</b> </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Web banner </label>
                    <div class="col-md-10">
                      <div class="container-fluid">
                        @if($country->medias->count())
                          @foreach($country->medias()->get()->chunk(4) as $chunk )
                          <div class="row">
                            @foreach($chunk as $media)
                            <div class="col-md-3">
                              <div class="file-preview-frame krajee-default  file-preview-initial file-sortable kv-preview-thumb" data-template="image">
                                <div class="kv-file-content">
                                  <img src="{{asset('public/upload')}}/{{$media->img_url}}" class="file-preview-image kv-preview-data img-responsive" title="" alt="" style="width:auto;height:120px;">
                                </div>
                                <div class="photo-order-input" style="margin-bottom:10px">
                                  <input type="text" class="form-control text-center" name="photo_order" value="{{$media->order}}">
                                </div>
                                <div class="file-footer-buttons">
                                    <button type="button" class="kv-file-remove btn btn-xs btn-default" title="Cập nhật vị trí" onclick="updatePhoto(this,{{$media->id}})"><i class="glyphicon glyphicon-refresh text-warning"></i></button>
                                   <button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" onclick="removePhoto(this,{{$media->id}})"><i class="glyphicon glyphicon-trash text-danger"></i></button>
                                </div>
                              </div>
                            </div>
                            @endforeach
                          </div>
                          @endforeach
                        @endif
                      </div>
                      <input type="file" name="thumb-input[]" id="thumb-input" multiple >
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
                    <p>
						<img src="{!!asset('public/upload')!!}/{!!$country->meta_share!!}" width="150" alt="">
						{!!Form::hidden('img-bk-share',$country->meta_share)!!}
					</p>
                    {!!Form::file('img_share')!!}
                    @if($errors->first('img_share'))
                        <p class="error">{!!$errors->first('img_share')!!}</p>
                    @endif
                </div>

                <div class="form-group">
                    {!!Form::submit('Save',array('class'=>'btn btn-primary'))!!}
                    <a href="{!!URL::previous()!!}" class="btn btn-primary">Back</a>
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
    $("#thumb-input").fileinput({
      uploadUrl: "{{route('admin.country.update',$country->id)}}", // server upload action
      uploadAsync: true,
      showUpload: false,
      showCaption: false,
       dropZoneEnabled : false,
        fileActionSettings:{
          showUpload : false,
        }
    })
  })

  function removePhoto(e, id){
    $.ajax({
      url: '{{route("admin.country.AjaxRemovePhoto")}}',
      type: 'POST',
      data:{id_photo: id, _token:$('meta[name="csrf-token"]').attr('content')},
      success:function(data){
        if(!data.error){
          e.parentNode.parentNode.parentNode.remove();
        }
      }
    })
  }
  function updatePhoto(e, id){
    var value = e.parentNode.previousElementSibling.childNodes[1].value;
    $.ajax({
      url: '{{route("admin.country.AjaxUpdatePhoto")}}',
      type: 'POST',
      data:{id_photo: id, value: value, _token:$('meta[name="csrf-token"]').attr('content')},
      success:function(data){
        if(!data.error){
          alertify.success('Cập nhật thay đổi.');
        }
      }
    })
  }
})
</script>
@stop
