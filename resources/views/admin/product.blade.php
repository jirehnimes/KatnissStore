@extends('adminlte::page')

@section('content_header')
    <h1>Products</h1>
@stop

@section('content')
	@include('status')

	<section id="product">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">List Of Products</h3>

				<!-- Go To New Product Page -->
				<a href="/admin/product/create">
					<button class="btn btn-primary btn-flat pull-right btnNew">
						<i class="fa fa-plus"></i> New
					</button>
				</a>
			</div>
			<div class="box-body">
				<table id="table_all" class="display" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>Image</th>
			                <th>Name</th>
			                <th>Category</th>
			                <th>Description</th>
			                <th>Price</th>
			                <th>Quantity</th>
			                <th>Date Registered</th>
			                <th>Date Updated</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tfoot>
			            <tr>
			            	<th>Image</th>
			                <th>Name</th>
			                <th>Category</th>
			                <th>Description</th>
			                <th>Price</th>
			                <th>Quantity</th>
			                <th>Date Registered</th>
			                <th>Date Updated</th>
			                <th>Action</th>
			            </tr>
			        </tfoot>
			    </table>
			</div>
		</div>

		<form id="delete" role="form" action="" method="POST">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<input type="hidden" name="_method" value="DELETE">
		</form>
	</section>
@stop