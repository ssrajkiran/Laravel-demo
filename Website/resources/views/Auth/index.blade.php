<!-- resources/views/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
</head>
<body>

    <table border="1" id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <tr class="user-row">
                <td>
                    <select class="idDropdown form-control">
                        <option value="" selected>Select</option>

                        @foreach ($ids as $id)
                            <option value="{{ $id }}">{{ $id }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="nameColumn"></td>
                <td class="passwordColumn"></td>
            </tr>
        </tbody>
    </table>

    <button id="addRowButton">Add Row</button>
    

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initial row
            initializeRow();

            // Add row button click event
            $('#addRowButton').on('click', function () {
                addNewRow();
            });

    
            // Dropdown change event
            $(document).on('change', '.idDropdown', function () {
                var selectedId = $(this).val();
                fetchDetails($(this).closest('.user-row'), selectedId);
            });

            function initializeRow() {
                // Make the first row's dropdown interactive
                $('.user-row:first .idDropdown').on('change', function () {
                    var selectedId = $(this).val();
                    fetchDetails($('.user-row:first'), selectedId);
                });
            }

            function addNewRow() {
                // Clone the first row and append to the table
                var newRow = $('.user-row:first').clone();
                newRow.find('.idDropdown').val('');
                newRow.find('.nameColumn').text('');
                newRow.find('.passwordColumn').text('');
                $('#userTable tbody').append(newRow);

                // Set up the new row
                initializeRow();
            }

            function fetchDetails(row, userId) {
                $.ajax({
                    url: '/get-details/' + userId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        row.find('.nameColumn').text(response.name);
                        
                        row.find('.passwordColumn').text(response.password);
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
