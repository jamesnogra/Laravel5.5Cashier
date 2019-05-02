@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>
        	Add Product | 
        	<a href="{{ action('ProductController@index') }}">All Products</a>
        </h3>
        <form method="POST" action="{{ action('ProductController@addProduct') }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
	        <div class="form-group">
				<label for="product-name">Name</label>
				<input type="text" class="form-control" name="product_name" id="product-name" placeholder="Product Name">
			</div>
			<div class="form-group">
				<label for="product-cost">Price ($)</label>
				<input type="text" class="form-control" name="product_cost" id="product-cost" placeholder="0.00">
			</div>
			<div class="form-group">
				<label for="product-details">Description</label>
				<textarea class="form-control" name="product_details" id="product-details" style="resize:none;"></textarea>
			</div>
			<div class="form-group">
				<label for="product-photo">Product Photo</label>
				<input type="file" class="custom-file-input" name="product_photo" id="product-photo">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Add Product</button>
			</div>
		</form>
    </div>
</div>
@endsection