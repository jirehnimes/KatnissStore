@extends('layouts.app')

@section('content')
<style type="text/css">
	.slider {
		height: 300px;
	}

	.slider div {
		height: 100%;
		background-color: green;
		padding: 10px;
		color: white;
	}
</style>

<script type="text/javascript">
    $(function() {
        $('.slider').slick({
			infinite: true,
			dots: true,
			speed: 300,
			autoplay: true,
		});
    });
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<div class="slider">
    			<div>
    				<h1>Sample Content 1</h1>
    			</div>
    			<div>
    				<h1>Sample Content 2</h1>
    			</div>
    			<div>
    				<h1>Sample Content 3</h1>
    			</div>
        	</div>
        </div>
    </div>
</div>
@endsection


