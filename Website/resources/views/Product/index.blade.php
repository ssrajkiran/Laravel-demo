<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Example</title>
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
                    <h2>CRUD Example</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('Product.create') }}">Create product</a>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('Auth.logout') }}">Logout</a>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="flagFilter">Filter by Flag:</label>
            <select id="flagFilter" class="form-control">
                <option value="">All</option>
                <option value="1">Flag 1</option>
                <option value="0">Flag 0</option>
            </select>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Flag</th>
                    <th></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>

                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->flag }}</td> 
                        <td>
                            <a class="btn btn-info" href="{{ route('Product.show', $product->id) }}">Show</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('Product.destroy', $product->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure do you want to delete this record')">Delete</button>
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('Product.edit', $product->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Add this script for AJAX filtering -->
    <!-- Update your existing script -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#flagFilter').on('change', function () {
            var flag = $(this).val();
            updateTable(flag);
        });

        function updateTable(flag) {
            $.ajax({
                url: '{{ route('getFilteredProducts') }}',
                type: 'POST',
                data: { flag: flag, _token: '{{ csrf_token() }}' },
                success: function (response) {
                    $('tbody').html(response);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
</script>

</body>
</html>
