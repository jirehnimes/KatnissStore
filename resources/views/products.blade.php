@extends('layouts.app')

@section('content')
<style type="text/css">
	.prodPanel {
		padding: 10px;
	}

	.prodPanel:hover {
		border: 1px solid black;
		cursor: pointer;
		border-color: white;
		border-radius: 5px;
	}

	.prodPanel img {
		height: 100px;
		width: auto;
	}

	.prodPanel .title {
		background-color: rgb(51, 102, 255);
		color: white;
		width: 100%;
		padding: 5px;
	}

	.prodPanel .title > h3 {
		padding: 0;
		margin: 0;
	}

	.prodPanel .btn-success {
		background-image: none;
		border-radius: 0;
	}
</style>

<script type="text/javascript">
function errorImg(that) {
	$(that).attr('src', '/images/default-thumbnail.jpg');
}

$(function() {
	$('.prodPanel .btn-success').click(function() {
		var _prodVal = $(this).closest('.prodPanel').find('input[name="id"]').val();

		if (typeof(Storage) !== 'undefined') {
			sCart = [];
			if (sessionStorage.cart) {
				sCart = JSON.parse(sessionStorage.cart);
				if ($.inArray(_prodVal, sCart) !== -1) {
					alert('Item is already belong to the cart.');
					return false;
				}
			}
			sCart.push({id : _prodVal, qty : 0});
			$('#app-layout .nav.navbar-nav .cartCnt').text(sCart.length);
	    	sessionStorage.setItem('cart', JSON.stringify(sCart));
		} else {
		    console.error('No web localstorage in this browser.');
		}
	});
});
</script>

@php
$aItems = array_chunk($aProds->items(), 3, true);
@endphp

<div class="container">
	@if ($aProds->total() !== 0)
		@foreach ($aItems as $aGroup)
	    <div class="row">
	    	@foreach ($aGroup as $aProd)
	    	<div class="col-md-4 prodPanel">
	    		<img src="/storage/images/products/{{ $aProd->image }}" onerror="errorImg(this)">
				<div class="title">
					<h3>{{ $aProd->name }}</h3>
				</div>
				<h5>Php {{ number_format($aProd->price) }}</h5>
				<input type="hidden" name="id" value="{{ $aProd->id }}">
				<span class="">
					<button class="btn btn-success"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Add To Cart</button>
				</span>
			</div>
			@endforeach
	    </div>
	    @endforeach
    @else
    	<h1>No available products.</h1>
    @endif
</div>
@endsection

