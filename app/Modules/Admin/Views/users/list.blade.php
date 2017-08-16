@extends('Admin::layouts.layout')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
	      @if($user->count() != 0)
				<div class="box-body">
				  <table id="table-post" class="table table-bordered table-striped">
				    <thead>
					    <tr>
							<th>ID</th>
							<th data-width="30%">Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
				    </thead>
				    <tbody>
					    @foreach($user as $item)
						<tr>
							<td >{!!$item->id!!}</td>
							<td><b>{!!$item->name!!}</b></td>
							<td>{!!$item->email!!}</td>
							<td>
							  @foreach($item->roles()->get() as $item_role)
                  {!!$item_role->display_name!!}
                @endforeach
							</td>
							<td>
							{!!Form::open(array('route'=>array('admin.deleteUser',$item->id),'method'=>'DELETE', 'class' => 'inline'))!!}
							<button class="btn  btn-danger btn-xs remove-btn" type="button" attrid="{!!$item->id!!}" onclick="confirm_remove(this);"   > Remove </button>
							{!!Form::close()!!}
							</td>
						</tr>
						@endforeach
				    </tbody>
				  </table>
				</div>
				@else
					<h2 class="text-center">No Data</h2>
				@endif
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
        'ordering': false,
        "bLengthChange": false,
        "bFilter" : false,
      });
      /*SELECT ROW*/
      $('#table-post tbody').on('click','tr',function(){
        $(this).toggleClass('selected');
      })

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
