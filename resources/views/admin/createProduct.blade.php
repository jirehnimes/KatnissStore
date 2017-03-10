@extends('adminlte::page')

@section('content_header')
    <h1>Create Products</h1>
@stop

@section('content')
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">{{ isset($aBranch) ? 'UPDATE' : 'NEW' }}</h3>
		</div>
		<div class="box-body">
			<form role="form" action="{{ isset($aBranch) ? url('admin/branch/'.$aBranch->id) : url('admin/branch') }}" method="POST">
				<div class="row">
					<div class="form-group col-sm-6">
		              	<label for="name">Name</label>
		              	<input type="text" class="form-control" id="name" name="name" value="{{ isset($aBranch) ? $aBranch->name : '' }}" required>
		            </div>
		            <div class="form-group col-sm-6">
		              	<label>Address</label>
		              	<textarea class="form-control" rows="3" name="address" required>{{ isset($aBranch) ? $aBranch->address : '' }}</textarea>
		            </div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
		              	<label for="timein">Time In</label>
		              	<input type="time" class="form-control" id="timein" name="timein" value="{{ isset($aBranch) ? $aBranch->time_in : '' }}" required>
		            </div>
		            <div class="form-group col-sm-6">
		              	<label for="timeout">Time Out</label>
		              	<input type="time" class="form-control" id="timeout" name="timeout" value="{{ isset($aBranch) ? $aBranch->time_out : '' }}" required>
		            </div>
				</div>
				<div class="row">
					<div class="form-group col-sm-4">
		              	<label for="phone1">Phone 1</label>
		              	<input type="text" class="form-control inPhone" id="phone1" name="phone1" value="{{ isset($aBranch) ? $aBranch->phone1 : '' }}" maxlength="11" required>
		            </div>
		            <div class="form-group col-sm-4">
		              	<label for="phone2">Phone 2</label>
		              	<input type="text" class="form-control inPhone" id="phone2" name="phone2" value="{{ isset($aBranch) ? $aBranch->phone2 : '' }}" maxlength="11">
		            </div>
		            <div class="form-group col-sm-4">
		              	<label for="email">Email</label>
		              	<input type="text" class="form-control" id="email" name="email" value="{{ isset($aBranch) ? $aBranch->email : '' }}" required>
		            </div>
				</div>

				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				@if (isset($aBranch))
				<input type="hidden" name="_method" value="PUT">
				@endif

				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
@stop