<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
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
                <div class="pull-left">
                    <h2>Edit Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('Product.list') }}">Back</a>
                </div>
            </div>
        </div>
            
     
        <form name="myform" action="{{ route('Product.update',$product->id) }}" onsubmit="return validateForm()" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="productName" class="form-label">Name:</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="productName" placeholder="Name" required>
                        <span id="name-error" class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="productDescription" class="form-label">Descriptions:</label>
                        <textarea class="form-control" style="height:150px" name="description" id="productDescription" placeholder="Detail" required>{{ $product->description }}</textarea>
                        <span id="description-error" class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="productPrice" class="form-label">Price:</label>
                        <input type="text" name="price" value="{{ $product->price }}" class="form-control" id="productPrice" placeholder="Price" required>
                        <span id="price-error" class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="productFlag" class="form-label">Flag:</label>
                        <input type="text" name="flag" value="{{ $product->flag }}" class="form-control" id="productFlag" placeholder="Flag" required>
                        <span id="flag-error" class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var nameInput = document.getElementById('productName');
            var descriptionInput = document.getElementById('productDescription');
            var priceInput = document.getElementById('productPrice');
            var flagInput = document.getElementById('productFlag');

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

            flagInput.addEventListener('input', function () {
                validateFlag();
            });

            function validateName() {
                var nameError = document.getElementById('name-error');
                // Reset error message
                nameError.textContent = '';

                // Validate name
                if (nameInput.value.trim() === '') {
                    nameError.textContent = 'Name is required';
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
                    descriptionError.textContent = 'Description is required';
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
                    priceError.textContent = 'Price must be a valid number';
                    return false;
                }

                return true;
            }

            function validateFlag() {
                var flagError = document.getElementById('flag-error');
                // Reset error message
                flagError.textContent = '';

                // Validate flag
                if (isNaN(flagInput.value) || flagInput.value.trim() === '') {
                    flagError.textContent = 'Flag must be a valid number';
                    return false;
                }

                return true;
            }

            function validateForm() {
                return validateName() && validateDescription() && validatePrice() && validateFlag();
            }
        });
    </script>
</body>

</html>
