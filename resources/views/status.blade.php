@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-ban"></i> Error!</h4>
	{{ session()->get('error') }}
</div>
@endif

@if (session()->has('ok'))
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-check"></i> Success!</h4>
	{{ session()->get('ok') }}
</div>
@endif

<script type="text/javascript">
	$('.alert').delay(1500).slideUp('slow', function() {
		$(this).finish();
	});
</script>