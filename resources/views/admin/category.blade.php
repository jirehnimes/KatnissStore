@extends('adminlte::page')

@section('content_header')
    <h1>Orders</h1>
@stop

@section('content')
	@include('status')

	<section id="category">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">List Of Orders</h3>

				<!-- Go To New Product Page -->
				<button class="btn btn-primary btn-flat pull-right btnNew" data-toggle="modal" data-target="#modalCategory"> 
					<i class="fa fa-plus" ></i> New
				</button>
			</div>
			<div class="box-body">
				<table id="table_all" class="display" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>Name</th>
			                <th>Date Registered</th>
			                <th>Date Updated</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tfoot>
			            <tr>
			            	<th>Name</th>
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

		<div id="modalCategory" class="modal modal-primary fade" role="dialog">
			<div class="modal-dialog">

				<form id="form" role="form" action="/admin/category" method="POST">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><span id="status">New</span> Category</h4>
						</div>

						<div class="modal-body">
							<div class="form-group">
	                            <label for="name">Name:</label>
	                            <input id="name" type="text" class="form-control" name="name" value="">
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
            url: '{{ route("datatables.admin.category") }}',
            type: 'GET'
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'created_at', render: function (data, type, row) {
            	return moment(data).format('MMMM DD, YYYY');
            }},
            {data: 'updated_at', render: function (data, type, row) {
            	return moment(data).format('MMMM DD, YYYY');
            }},
            {data: 'action', defaultContent: '<button class="btn btn-success btn-flat btnEdit" data-toggle="modal" data-target="#modalCategory"><i class="fa fa-edit"></i></button>&nbsp;<button class="btn btn-danger btn-flat btnDel"><i class="fa fa-trash"></i></button>'},
        ]
    });

    $('#category tbody').on('click', '.btnEdit', function () {
    	var oDOM = $('#modalCategory');
    	var form = $('#modalCategory #form');
    	var data = table.row($(this).parents('tr')).data();

    	oDOM.find('.modal-title #status').text('Edit');
        
        form.attr('action', '/admin/category/'+data.id);
        form.find('input#name').val(data.name);
        form.append('<input type="hidden" name="_method" value="PUT">');
    });

    $('#category tbody').on('click', '.btnDel', function () {
    	var form = $('#category #delete');
    	var data = table.row($(this).parents('tr')).data();
    	form.attr('action', '/admin/category/'+data.id);
    	form.submit();
    });
});
</script>
@stop