@extends('adminlte::page')

@section('content_header')
    <h1>Orders</h1>
@stop

@section('content')
	@include('status')

	<section id="product">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">List Of Orders</h3>

				<!-- Go To New Product Page -->
				<a href="/admin/order/create">
					<button class="btn btn-primary btn-flat pull-right btnNew">
						<i class="fa fa-plus"></i> New
					</button>
				</a>
			</div>
			<div class="box-body">
				<table id="table_all" class="display" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>User Name</th>
			                <th>Invoice Number</th>
			                <!-- <th>Fare Type</th> -->
			                <!-- <th>Shipping Address</th>
			                <th>Message</th>
			                <th>Delivery Start</th>
			                <th>Delivery End</th> -->
			                <th>Is Paid</th>
			                <th>Delivery Status</th>
			                <th>Date Registered</th>
			                <th>Date Updated</th>
			            </tr>
			        </thead>
			        <tfoot>
			            <tr>
			            	<th>User Name</th>
			                <th>Invoice Number</th>
			                <!-- <th>Fare Type</th> -->
			                <!-- <th>Shipping Address</th>
			                <th>Message</th>
			                <th>Delivery Start</th>
			                <th>Delivery End</th> -->
			                <th>Is Paid</th>
			                <th>Delivery Status</th>
			                <th>Date Registered</th>
			                <th>Date Updated</th>
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
$(function() {
	var table = $('#table_all').DataTable({
        processing: true,
        // serverSide: true,
        ajax: {
            url: '{{ route("datatables.admin.order") }}',
            type: 'GET'
        },
        columns: [
            {render: function(data, type, full, meta) {
                return full.user.first_name+' '+full.user.last_name;
            }},
            {data: 'invoice_number', name: 'invoice_number'},
            {data: 'paid', name: 'paid'},
            {data: 'delivery_status', name: 'delivery_status'},
            {data: 'created_at', render: function (data, type, row) {
            	return moment(data).format('MMMM DD, YYYY');
            }},
            {data: 'updated_at', render: function (data, type, row) {
            	return moment(data).format('MMMM DD, YYYY');
            }},
            // {data: 'action', defaultContent: '<button class="btn btn-success btn-flat btnEdit"><i class="fa fa-edit"></i></button>&nbsp;<button class="btn btn-danger btn-flat btnDel"><i class="fa fa-trash"></i></button>'},
        ]
    });

    // $('#product tbody').on('click', '.btnEdit', function () {
    //     var data = table.row($(this).parents('tr')).data();
    //     window.location.replace('/admin/product/'+data.id+'/edit');
    // });

    // $('#product tbody').on('click', '.btnDel', function () {
    // 	var form = $('#product #delete');
    // 	var data = table.row($(this).parents('tr')).data();
    // 	form.attr('action', '/admin/product/'+data.id);
    // 	form.submit();
    // });
});
</script>
@stop