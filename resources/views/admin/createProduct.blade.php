@extends('adminlte::page')

@section('content_header')
    <h1>{{ $aStatus }} Product</h1>
@stop

@section('content')
	@include('status')

	<div class="box box-default">
		<div class="box-body">
			<form role="form" action="{{ $aStatus === 'New' ? '/admin/product' : (isset($aProd) ? '/admin/product/'.$aProd->id : '') }}" method="POST" enctype="multipart/form-data">
				<div class="row">
		            <div class="form-group col-sm-6 col-xs-12">
		              	<img src="{{ isset($aProd) ? '/storage/images/products/'.$aProd->image : '/images/default-thumbnail.jpg' }}" id="imgPrev" class="img-responsive" style="height:200px;width:auto;" onerror="errorImg(this)">
		              	<br><br>
		              	<label for="image">Image</label>
		              	<input type="file" class="form-control" id="image" name="image">
		            </div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
		              	<label for="name">Name</label>
		              	<input type="text" class="form-control" id="name" name="name" value="{{ isset($aProd) ? $aProd->name : '' }}" required>
		            </div>
		            <div class="form-group col-sm-6">
		              	<label for="price">Price</label>
	              		<input type="text" class="form-control" id="price" name="price" value="{{ isset($aProd) ? $aProd->price : '' }}" required>
		            </div>
				</div>
				<div class="row">
					 <div class="form-group col-sm-6">
		              	<label>Description</label>
		              	<textarea class="form-control" rows="5" name="description" style="resize:none">{{ isset($aProd) ? $aProd->description : '' }}</textarea>
		            </div>
		            <div class="form-group col-sm-6">
		            	<div class="row">
		            		<div class="col-xs-12">
		            			<label for="quantity">Quantity</label>
	              				<input type="number" class="form-control" id="quantity" name="quantity" value="{{ isset($aProd) ? $aProd->quantity : '' }}" required>
		            		</div>
		            	</div>
		            	<div class="row">
		            		<div class="col-xs-12">
		            			<label for="category">Category</label>
	            				<select class="form-control" id="category" name="category">
	            					@foreach ($aCats as $aCat)
	            						<option value="{{ $aCat->id }}" {{ (isset($aProd) && ($aCat->id === $aProd->category_id)) ? 'selected' : '' }}>{{ $aCat->name }}</option>
	            					@endforeach
	            				</select>
		            		</div>
		            	</div>
		            </div>
				</div>

				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				@if (isset($aProd))
				<input type="hidden" name="_method" value="PUT">
				@endif

				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
@stop

@section('js')
<script type="text/javascript">
	function errorImg(that) {
		$(that).attr('src', '/images/default-thumbnail.jpg');
	}
</script>
@stop