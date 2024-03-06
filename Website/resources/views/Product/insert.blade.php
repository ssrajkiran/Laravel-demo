<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        @include('flash-message')
        @yield('content')
    </div>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('Product.list') }}">Back</a>
                </div>
            </div>
        </div>

       

        <form name="productForm" action="{{ route('Product.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="productName" class="form-label">Product Name:</label>
                        <input type="text" name="name" class="form-control" id="productName" placeholder="Product Name" required>
                        <span id="name-error" class="text-danger"></span>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="productDescription" class="form-label">Product Description:</label>
                        <input type="text" name="description" class="form-control" id="productDescription" placeholder="Product Description" required>
                        <span id="description-error" class="text-danger"></span>
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="productPrice" class="form-label">Product Price:</label>
                        <input type="text" name="price" class="form-control" id="productPrice" placeholder="Product Price" required>
                        <span id="price-error" class="text-danger"></span>
                        @error('price')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var nameInput = document.getElementById('productName');
            var descriptionInput = document.getElementById('productDescription');
            var priceInput = document.getElementById('productPrice');

            // Add event listeners for live validation
            nameInput.addEventListener('input', function () {
                validateName();
            });

            descriptionInput.addEventListener('input', function () {
                validateDescription();
            });

            priceInput.addEventListener('input', function () {
                validatePrice();
            });

            function validateName() {
                var nameError = document.getElementById('name-error');
                // Reset error message
                nameError.textContent = '';

                // Validate name
                if (nameInput.value.trim() === '') {
                    nameError.textContent = 'Product Name is required';
                    return false;
                }

                return true;
            }

            function validateDescription() {
                var descriptionError = document.getElementById('description-error');
                // Reset error message
                descriptionError.textContent = '';

                // Validate description
                if (descriptionInput.value.trim() === '') {
                    descriptionError.textContent = 'Product Description is required';
                    return false;
                }

                return true;
            }

            function validatePrice() {
                var priceError = document.getElementById('price-error');
                // Reset error message
                priceError.textContent = '';

                // Validate price
                if (isNaN(priceInput.value) || priceInput.value.trim() === '') {
                    priceError.textContent = 'Product Price must be a valid number';
                    return false;
                }

                return true;
            }

            function validateForm() {
                return validateName() && validateDescription() && validatePrice();
            }
        });
    </script>
</body>

</html>
