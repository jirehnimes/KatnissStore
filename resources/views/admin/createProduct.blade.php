@extends('adminlte::page')

@section('content_header')
    <h1>{{ $aStatus }} Product</h1>
@stop

@section('content')
	@include('status')

	<div class="box box-default">
<!-- 		<div class="box-header with-border">
			<h3 class="box-title">{{ isset($aBranch) ? 'UPDATE' : 'NEW' }}</h3>
		</div> -->
		<div class="box-body">
			<form role="form" action="{{ $aStatus === 'New' ? '/admin/product' : '' }}" method="POST">
				<div class="row">
		            <div class="form-group col-sm-6 col-xs-12">
		              	<img src="" style="height:200px;width:200px;background-color:red;">
		              	<br><br>
		              	<label for="image">Image</label>
		              	<input type="file" class="form-control" id="image" name="image">
		            </div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
		              	<label for="name">Name</label>
		              	<input type="text" class="form-control" id="name" name="name" value="" required>
		            </div>
		            <div class="form-group col-sm-6">
		              	<label for="price">Price</label>
	              		<input type="text" class="form-control" id="price" name="price" value="" required>
		            </div>
				</div>
				<div class="row">
					 <div class="form-group col-sm-6">
		              	<label>Description</label>
		              	<textarea class="form-control" rows="5" name="description" style="resize:none"></textarea>
		            </div>
		            <div class="form-group col-sm-6">
		            	<div class="row">
		            		<div class="col-xs-12">
		            			<label for="quantity">Quantity</label>
	              				<input type="number" class="form-control" id="quantity" name="quantity" value="" required>
		            		</div>
		            	</div>
		            	<div class="row">
		            		<div class="col-xs-12">
		            			<label for="category">Category</label>
	            				<select class="form-control" id="category" name="category">
	            					@foreach ($aCats as $aCat)
	            						<option value="{{ $aCat->id }}">{{ $aCat->name }}</option>
	            					@endforeach
	            				</select>
		            		</div>
		            	</div>
		            </div>
				</div>

				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<!-- <input type="hidden" name="_method" value="PUT"> -->

				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
@stop