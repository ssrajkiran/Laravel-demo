<!-- resources/views/products/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<h1>Product List</h1>

<table id="product-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        <!-- Product data will be dynamically added here -->
    </tbody>
</table>

<script>
    $(document).ready(function () {
        getProducts();

        function getProducts() {
            $.ajax({
                type: "GET",
                url: "/get-products",
                dataType: "json",
                success: function (response) {
                    // Clear existing rows in the table body
                    $('#product-table tbody').empty();

                    // Loop through each product and append to the table
                    $.each(response.products, function (index, product) {
                        $('#product-table tbody').append(
                            '<tr>' +
                                '<td>' + product.id + '</td>' +
                                '<td>' + product.name + '</td>' +
                                '<td>' + product.description + '</td>' +
                                '<td>' + product.price + '</td>' +
                                '<td>' + product.created_at + '</td>' +
                                '<td>' + product.updated_at + '</td>' +
                                // Add more columns as needed
                            '</tr>'
                        );
                    });
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }
    });
</script>

</body>
</html>
