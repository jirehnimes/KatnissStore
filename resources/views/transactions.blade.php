@extends('layouts.app')

@section('content')
<style type="text/css">
</style>

<script type="text/javascript">
$(function() {
	var table = $('#table_all').DataTable({
        processing: true,
        // serverSide: true,
        ajax: {
            url: '{{ route("datatables.order") }}',
            type: 'GET'
        },
        columns: [
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
        ]
    });
});
</script>

<div class="container">
	@include('breadcrumb')
	<div class="row">
		<div class="col-md-12">
			<table id="table_all" class="display table table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Fare Type</th>
                        <th>Is Paid</th>
                        <th>Delivery Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Fare Type</th>
                        <th>Is Paid</th>
                        <th>Delivery Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </tfoot>
            </table>
		</div>
	</div>
</div>
@stop
