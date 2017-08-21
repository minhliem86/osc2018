@extends('Admin::layouts.layout')

@section('content')
 <section class="content-header">
  <h1>
    Testimonial Page
    <small>Testimonial</small>
  </h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <div class="pull-right">
                    <a href="{!!route('admin.testimonial.create')!!}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i> Add New</a>
                       <button class="btn btn-danger btn-xs" id="btn-count">Remove data selected</button>
                        <button type="button" id="btn-updateOrder" class="btn btn-warning btn-xs">Update Order</button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="table-post" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th data-width="5%">ID</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th data-width="10%">Order</th>
                            <th data-width="10%">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  </table>
                </div> <!-- /.box-body -->
            </div> <!-- end box -->
		</div>	<!-- end ajax-table-->
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
                url:  '{!! route('admin.testimonial.getData') !!}',
                data: function(d){
                    d.name = $('input[type="search"]').val();
                }
            },
            columns: [
               {data: 'id', name: 'id', 'orderable': false},
               {data: 'name', name: 'name'},
               {data: 'author', name: 'author'},
               {data: 'order', name: 'order' , 'orderable': false},
               {data: 'status', name: 'status', 'orderable': false},
               {data: 'action', name: 'action', 'orderable': false}
           ],
           initComplete: function(){
                var table_api = this.api();
                var data = [];
                var data_order = {};
                $('#btn-count').click( function () {
                    var rows = table_api.rows('.selected').data();
                    rows.each(function(index, e){
                        data.push(index.id);
                    })
                    alertify.confirm('You can not undo this action. Are you sure ?', function(e){
                        if(e){
                            $.ajax({
                                'url':"{!!route('admin.testimonial.deleteAll')!!}",
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
                        url: '{{route("admin.testimonial.postAjaxUpdateOrder")}}',
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

                $('input[name="status"]').on('change', function(){
                    var rows_order = table_api.rows().data();
                    var value;
                    if($(this).is(':checked')){
                        value = 1;
                    }else{
                        value = 0;
                    }
                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{route("admin.testimonial.postAjaxUpdateStatus")}}',
                        type:'POST',
                        data: {value: value, id: id ,  _token:$('meta[name="csrf-token"]').attr('content') },
                        success: function(rs){
                            if(rs.code == 200){
                                // location.reload(true);
                                alertify.success('The data is updated.');

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
