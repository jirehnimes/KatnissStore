@extends('adminlte::page')

@section('content_header')
    <h1>Orders</h1>
@stop

@section('content')
	@include('status')

	<section id="order">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">List Of Orders</h3>
			</div>
			<div class="box-body">
				<table id="table_all" class="display" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>User Name</th>
			                <th>Invoice Number</th>
			                <th>Fare Type</th>
			                <!-- <th>Shipping Address</th>
			                <th>Message</th>
			                <th>Delivery Start</th>
			                <th>Delivery End</th> -->
			                <th>Is Paid</th>
			                <th>Delivery Status</th>
			                <th>Date Registered</th>
			                <th>Date Updated</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tfoot>
			            <tr>
			            	<th>User Name</th>
			                <th>Invoice Number</th>
			                <th>Fare Type</th>
			                <!-- <th>Shipping Address</th>
			                <th>Message</th>
			                <th>Delivery Start</th>
			                <th>Delivery End</th> -->
			                <th>Is Paid</th>
			                <th>Delivery Status</th>
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

		<div id="modalOrder" class="modal modal-primary fade" role="dialog">
			<div class="modal-dialog">

				<form id="form" role="form" action="" method="POST">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<input type="hidden" name="_method" value="PUT">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><span id="status">Edit</span> Order</h4>
						</div>

						<div class="modal-body">
							<div class="form-group">
	                            <label for="invoice_number">Invoice Number:</label>
	                            <input id="invoice_number" type="text" class="form-control" value="" disabled>
	                        </div>
						</div>

						<div id="ispaiddiv" class="modal-body">
							<div class="form-group">
	                            <label for="ispaid">Is Paid:</label>
	                            <select id="ispaid" name="ispaid" class="form-control">
									<option value="1">Paid</option>	                            	
									<option value="0">Not Paid</option>	                            	
	                            </select>
	                        </div>
						</div>

						<div class="modal-body">
							<div class="form-group">
	                            <label for="delstatus">Delivery Status:</label>
	                            <select id="delstatus" name="delstatus" class="form-control">
									<option value="waiting">Waiting</option>	                            	
									<option value="delivering">Delivering</option>	                            	
									<option value="completed">Completed</option>	                            	
	                            </select>
	                        </div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</div>	
				</form>

			</div>
		</div>
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
            {data: 'fare_type', render: function (data, type, row) {
            	if (data === 'paypal') {
            		return 'PayPal';
            	} else {
            		return 'Cash';
            	}
            }},
            {data: 'paid', render: function (data, type, row) {
            	if (data === 0) {
            		return 'Not Paid';
            	} else {
            		return 'Paid';
            	}
            }},
            {data: 'delivery_status', render: function (data, type, row) {
            	return data.charAt(0).toUpperCase() + data.slice(1);
            }},
            {data: 'created_at', render: function (data, type, row) {
            	return moment(data).format('MMMM DD, YYYY');
            }},
            {data: 'updated_at', render: function (data, type, row) {
            	return moment(data).format('MMMM DD, YYYY');
            }},
            {data: 'action', defaultContent: '<button class="btn btn-success btn-flat btnEdit" data-toggle="modal" data-target="#modalOrder"><i class="fa fa-edit"></i></button>'}
        ]
    });

    $('#order tbody').on('click', '.btnEdit', function () {
    	var oDOM = $('#modalOrder');
    	var form = $('#modalOrder #form');
    	var data = table.row($(this).parents('tr')).data();

    	form.attr('action', '/admin/order/'+data.id);
    	oDOM.find('#invoice_number').val(data.invoice_number);
    	oDOM.find('select[name="ispaid"]').val(data.paid);
    	oDOM.find('select[name="delstatus"]').val(data.delivery_status);

    	if (data.fare_type === 'paypal') {
    		oDOM.find('#ispaiddiv').hide();
    	}
    });
});
</script>
@stop