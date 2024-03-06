<html>
    <title> Show product</title>
    <body>
    <div class="row my-4">
	<div class="col-lg-2 mx-auto p-1" style="background-color: #1f386a;">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	</div>
</div>

<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8 my-4">
		<div class="float-start">
			<h4>View Post</h4>
		</div>
		<div class="float-end">
			<a class="btn btn-sm btn-primary" href="{{ route('Product.list') }}"><i class="fa fa-chevron-left"></i> Back</a>
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>

<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">

			<div class="mb-3">
				<h6>Name:</h6>
				<p>{{ $product->name }}</p>
			</div>

			<div class="mb-3">
				<h6>Description:</h6>
				<p>{{ $product->description }}</p>
			</div>

            <div class="mb-3">
				<h6>Price:</h6>
				<p>{{ $product->price }}</p>
			</div>

	</div>
	<div class="col-lg-2"></div>
</div>
    </body>
</html>