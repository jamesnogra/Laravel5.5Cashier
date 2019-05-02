@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>
        	All Products | 
        	<a href="{{ action('ProductController@addProduct') }}">Add Product</a>
        </h3>
        <div class="row">
        	@foreach ($all_products as $product)
				<div class="col-6 col-md-4">
					<h4 class="product-centered">{{ $product->name }}</h4>
					<div class="product-image" style="background-image:url('/images/products/{{ $product->image }}');"></div>
					<div class="product-centered">
						<span>$ {{ $product->cost }}</span> | 
						<span>
							<select id="product-quantity-{{ $product->id }}">
								@for ($x=1; $x<=10; $x++)
									<option value="{{ $x }}">{{ $x }}</option>
								@endfor
							</select>
							<button class="btn btn-primary btn-xs" onClick="addToCart({{ $product->id }});">Add to Cart</button>
						</span>
					</div>
				</div>
			@endforeach
		</div>
    </div>
</div>
<script>
	function addToCart(product_id) {
		let cart_data = {
			'product_id': 	product_id,
			'quantity': 	$('#product-quantity-'+product_id).val(),
		};
		alert("Added to cart!");
		$.post("{{ action('ProductController@postAddToCart') }}", cart_data, function(result){
			let shopping_cart_total = $('#shopping-cart-total').text();
			shopping_cart_total++;
			$('#shopping-cart-total').html(shopping_cart_total);
		});
	}
</script>
<style>
	.product-centered {
		text-align: center;
	}
	.product-image {
		height: 250px;
		background-color: #CCCCCC;
		overflow: hidden;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>
@endsection