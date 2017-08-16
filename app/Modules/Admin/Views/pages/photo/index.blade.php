@extends('Admin::layouts.layout')

@section('content')
 <section class="content-header">
  <h1>
    Photo
    <!-- <small>Optional description</small> -->
  </h1>
  <!-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
  </ol> -->
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
	            <div class="box-header">
	              <div class="pull-right">
	              	<a href="{!!route('admin.photo.create')!!}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i> Add New</a>
		               <button class="btn btn-danger btn-xs" id="btn-count">Remove data selected</button>
                        <button type="button" id="btn-updateOrder" class="btn btn-warning btn-xs">Update Order</button>
	              </div>
	            </div>
	            <!-- /.box-header -->
				<div class="box-body">

				  <table id="table-post" class="table table-bordered table-striped">
				    <thead>
					    <tr>
							<th data-width="10%">ID</th>
							<th data-width="20%" >Image</th>
                            <th data-width="10%">Order</th>
							<th >Album</th>
							<th>Action</th>
						</tr>
				    </thead>
				  </table>
				</div>
            <!-- /.box-body -->
			</div>
			</div>	<!-- end ajax-table-->

		</div>
	</div>
</section>
@stop

@section('script')
	<!-- SCRIPT -->
	{!!Html::style(asset('public/assets/backend').'/js/DataTables/datatables.min.css')!!}
	{!!Html::script(asset('public/assets/backend').'/js/DataTables/datatables.min.js')!!}


	<script type="text/javascript">
		$(document).ready(function(){
			{!! Notification::showSuccess('alertify.success(":message");') !!}
			{!! Notification::showError('alertify.error(":message");') !!}

			var table = $('#table-post').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url:  '{!! route('admin.photo.getData') !!}',
                    data: function(d){
                        d.name = $('input[type="search"]').val();
                    }
                },
                columns: [
                   {data: 'photo_id', name: '.photos.id'},
                   {data: 'img_url', name: 'photos.img_url'},
                   {data: 'updateOrder', name: 'updateOrder'},
                   {data: 'title', name: 'title'},
                   {data: 'action', name: 'action'}
               ],
               initComplete: function(){
                    var table_api = this.api();
                    var data = [];
                    var data_order = {};
                    $('#btn-count').click( function () {
                        var rows = table_api.rows('.selected').data();
                        rows.each(function(index, e){
                            data.push(index.photo_id);
                        })
                    	alertify.confirm('You can not undo this action. Are you sure ?', function(e){
                    		if(e){
                    			$.ajax({
                    				'url':"{!!route('admin.photo.deleteall')!!}",
                    				'data' : {arr: data,_token:$('meta[name="csrf-token"]').attr('content')},
                    				'type': "POST",
                    				'success':function(result){
                    					if(result.msg = 'ok'){
                    						table.rows('.selected').remove();
                    						table.draw();
                    						alertify.success('The data is removed!');
                                            location.reload();
                    					}
                    				}
                    			});
                    		}
                        })
                    })

                    $('#btn-updateOrder').click(function(){
                        var rows_order = table_api.rows().data();
                        var data_order = {};
                        $('input[name="order"]').each(function(index){
                            var id = $(this).data('id');
                            var va = $(this).val();
                            data_order[id] = va;
                        });
                        $.ajax({
                            url: '{{route("admin.photo.postAjaxUpdateOrder")}}',
                            type:'POST',
                            data: {data: data_order,  _token:$('meta[name="csrf-token"]').attr('content') },
                            success: function(rs){
                                if(rs.code == 200){
                                    location.reload(true);
                                    // console.log(rs.msg);
                                }
                            }
                        })
                    })
               }
			});
			/*SELECT ROW*/
			$('#table-post tbody').on('click','tr',function(){
				$(this).toggleClass('selected');
			});

		})

		function confirm_remove(a){
			alertify.confirm('You can not undo this action. Are you sure ?', function(e){
				if(e){
					a.parentElement.submit();
				}
			});
		}
	</script>
@stop
