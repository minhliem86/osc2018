@extends('Admin::layouts.layout')
@section('content')
<section class="content-header">
  <h1>Change Password</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				{!!Form::open(array('route'=>'admin.postChangePass') )!!}
				<div class="form-group">
					{!!Form::password('oldpassword',array('class'=>'form-control', 'placeholder' => 'Enter your password') )!!}
				</div>
				<div class="form-group">
					{!!Form::password('newpassword',array('class'=>'form-control', 'placeholder' => 'Enter your new password') )!!}	
				</div>
				<div class="form-group">
					{!!Form::password('newpassword_confirmation',array('class'=>'form-control', 'placeholder' => 'Enter your new password again'))!!}	
				</div>
				<div class="form-group">
					{!!Form::submit('Saves changes',array('class'=>'btn btn-info') )!!}	
				</div>
				
				{!!Form::close()!!}
				@include('Admin::errors.listerror')
			</div>
		</div>
	</div>
</section>

@stop