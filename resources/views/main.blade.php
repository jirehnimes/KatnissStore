@extends('layouts.app')

@section('content')
<style type="text/css">
	.slider {
		height: 300px;
	}

	.slider div {
		height: 100%;
	}

    .slider div[class*="container"] {
        height: 100%;
        width: 100%;
        background-repeat: no-repeat;
        background-size: auto 100%;
        text-align: right;
        padding: 10px;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
    }

    .slider div.container1 {
        background-image: url('storage/images/banner/h4-slide.png');
    }

    .slider div.container2 {
        background-image: url('storage/images/banner/h4-slide2.png');
    }

    .slider div.container3 {
        background-image: url('storage/images/banner/h4-slide3.png');
    }

    .slider .btn {
        border-radius: 0;
    }
</style>

<script type="text/javascript">
    $(function() {
        $('.slider').slick({
			infinite: true,
			dots: true,
			speed: 300,
			autoplay: true
		});
    });
</script>

<div class="container">
    @include('status')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<div class="slider">
    			<div>
                    <div class="container1">
                        <span>
                            <h4>Get the latest smart phones here...</h4>
                            <a href="products/Technology" class="btn btn-success btn-flat"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Buy Now</a>
                        </span>
                    </div>
    			</div>
    			<div>
    				<div class="container2">
                        <span>
                            <h4>Cool bags?<br>Shop at Katniss Store!</h4>
                            <a href="products/Bags" class="btn btn-success btn-flat"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Buy Now</a>
                        </span>
                    </div>
    			</div>
    			<div>
    				<div class="container3">
                        <span>
                            <h4>Gadgets and more... more... more..</h4>
                            <a href="products/Technology" class="btn btn-success btn-flat"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Buy Now</a>
                        </span>
                    </div>
    			</div>
        	</div>
        </div>
    </div>
</div>
@endsection


