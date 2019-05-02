@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>
        	Shopping Cart
        </h3>
        <div class="row">
        	@foreach ($all_items as $item)
				<div class="col-6 col-md-4" id="cart-item-{{ $item->id }}">
					<h4 class="product-centered">{{ $item->name }}</h4>
					<div class="product-image" style="background-image:url('/images/products/{{ $item->image }}');"></div>
					<div class="product-centered">
						<span>$ {{ $item->cost }}</span> | 
						<span>
							<select id="product-quantity-{{ $item->id }}" onChange="changeQuantity({{ $item->id }}, {{ $item->cost }});">
								@for ($x=1; $x<=10; $x++)
									<option value="{{ $x }}" {{ ($item->quantity==$x) ? "selected" : "" }}>{{ $x }}</option>
								@endfor
							</select>
						</span> | 
						<span>Total: $<span class="item-total" id="item-total-{{ $item->id }}">{{ $item->cost*$item->quantity }}</span> | 
						<span><button class="btn btn-danger btn-xs" onClick="deleteFromCart({{ $item->id }});">Delete</button></span>
					</div>
				</div>
			@endforeach
		</div>
		<h3>Total: $<span id="total"></span></h3>
    </div>
</div>
<script type="text/javascript">
	function deleteFromCart(item_id) {
		if (!confirm('Are you sure you want to delete this item in your cart?')) {
			return;
		}
		$('#cart-item-'+item_id).hide();
		$.post("{{ action('ProductController@deleteFromCart') }}", {'id': item_id}, function(result){
			let shopping_cart_total = $('#shopping-cart-total').text();
			shopping_cart_total--;
			$('#shopping-cart-total').html(shopping_cart_total);
		});
	}
	function changeQuantity(item_id, item_cost) {
		let quantity = $('#product-quantity-'+item_id).val();
		let new_total = item_cost * quantity;
		$('#item-total-'+item_id).html(new_total.toFixed(2));
		//calculate the total again
		calculateTotal();
		//update the shopping card record
		$.post("{{ action('ProductController@updateShoppingCardRecordQuantity') }}", {'id': item_id, 'quantity': quantity}, function(result){
			
		});
	}
	function calculateTotal() {
		let total = 0;
		$('.item-total').each(function(i, obj) {
			total += parseFloat($(this).text());
		});
		$('#total').html(total.toFixed(2));
	}
	$(document).ready(function() {
		calculateTotal();
	});
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