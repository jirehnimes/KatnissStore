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

@section('js')
<script type="text/javascript">
function errorImg(that) {
	$(that).attr('src', '/images/default-thumbnail.jpg');
}

$(function() {
	var table = $('#table_all').DataTable({
        processing: true,
        // serverSide: true,
        ajax: {
            url: '{{ route("datatables.admin.product") }}',
            type: 'GET'
        },
        columns: [
        	{data: 'image', render: function (data, type, row) {
            	return '<img src="/storage/images/products/'+data+'" class="img-responsive" style="height:auto;width:100%;" onerror="errorImg(this)">';
            }},
            {data: 'name', name: 'name'},
            {data: 'category.name', name: 'category.name'},
            {data: 'description', name: 'description'},
            {data: 'price', render: function (data, type, row) {
            	return 'Php '+data;
            }},
            {data: 'quantity', render: function (data, type, row) {
            	return data+' pc/s';
            }},
            {data: 'created_at', render: function (data, type, row) {
            	return moment(data).format('MMMM DD, YYYY');
            }},
            {data: 'updated_at', render: function (data, type, row) {
            	return moment(data).format('MMMM DD, YYYY');
            }},
            {data: 'action', defaultContent: '<button class="btn btn-success btn-flat btnEdit"><i class="fa fa-edit"></i></button>&nbsp;<button class="btn btn-danger btn-flat btnDel"><i class="fa fa-trash"></i></button>'},
        ],
        order: [ [5, 'desc'] ]
    });

    $('#product tbody').on('click', '.btnEdit', function () {
        var data = table.row($(this).parents('tr')).data();
        window.location.replace('/admin/product/'+data.id+'/edit');
    });

    $('#product tbody').on('click', '.btnDel', function () {
    	var form = $('#product #delete');
    	var data = table.row($(this).parents('tr')).data();
    	form.attr('action', '/admin/product/'+data.id);
    	form.submit();
    });
});
</script>
@stop
