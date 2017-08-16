@extends('Admin::layouts.layout')

@section('content')
<section class="content-header">
  <h1>Modify Image</h1>
</section>
<section class="content">
	<div class="box">
		<div class="container-fluid">
                <div class="row" style="margin-bottom:10px">
                    <div class="col-sm-12">
                        {!!Form::select('tour_id', ['' => 'Select a Tour']+$tour,'', ['class' => 'form-control'] )!!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select name="album_id" id="" class="form-control" disabled>
                            <option value="" >Select an Album</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="container-fluid">
                        <div class="wrap-photo clearfix" style="margin-top:20px;">

                        </div>    <!-- end wrap-photo -->
                    </div>
                </div>


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
                url: "{!!route('admin.photo.postAjaxGetAlbum')!!}",
                type: "POST",
                data: {data_tour : tour_id, _token:$('meta[name="csrf-token"]').attr('content') },
                success: function(rs){
                    if(rs.code == 200){
                        $('select[name="album_id"]').prop('disabled', false);
                        $('select[name="album_id"]').append(rs.msg)
                    }else{
                        // $('.wrap-photo').html(rs.msg);
                        alert(rs.msg);
                    }
                }
            })
        });

        $('select[name="album_id"]').on('change',function(){
            var album_id = $(this).val();
            $.ajax({
                url: "{!!route('admin.photo.postAjaxGetPhoto')!!}",
                type: "POST",
                data: {data : album_id, _token:$('meta[name="csrf-token"]').attr('content') },
                success: function(rs){
                    if(rs.code == 200){
                        $('.wrap-photo').html(rs.msg);
                    }else{
                        $('.wrap-photo').html(rs.msg);
                    }
                }
            })
        });

        $(document).on('click', '#btn-edit', function(){
            var arr_data = {};
            $('textarea[name="title"]').each(function(i){
                var id = $(this).data('id');
                var value = $(this).val();
                arr_data[id] = value;
            })
            $.ajax({
                url: "{{route('admin.photo.postAjaxEditPhoto')}}",
                type: 'POST',
                data: {data: arr_data,  _token:$('meta[name="csrf-token"]').attr('content') },
                success: function(rs){
                    if(rs.code =- 200){
                        location.reload(true);
                    }
                }
            })
        })
    });
</script>
@stop
