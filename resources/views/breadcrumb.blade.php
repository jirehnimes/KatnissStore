@php
	$aURL = explode('/', url()->full());
	$sURL = ucfirst(array_pop($aURL));
@endphp
<div class="panel panel-default" id="breadcrumb">
	<div class="panel-heading"><h2>{{ $sURL }}</h2></div>
</div>