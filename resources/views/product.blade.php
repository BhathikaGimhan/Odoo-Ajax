<!-- resources/views/product.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Create Product</h1>

    <h1 id="#success-message"></h1>

<form method="POST" action="{{ route('product.store') }}" id="create-product-form">
    @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input class="form-control" type="text" name="name" id="name">
    </div>
    <div class="form-group">
        <label for="default_code">Default Code:</label>
        <input class="form-control" type="text" name="default_code" id="default_code">
    </div>
    <div class="form-group">
        <label for="list_price">List Price:</label>
        <input class="form-control" type="number" name="list_price" id="list_price" step="0.01">
    </div>
    <div class="form-group">
        <label for="standard_price">Standard Price:</label>
        <input class="form-control" type="number" name="standard_price" id="standard_price" step="0.01">
    </div>
    <button class="btn btn-outline-primary" type="submit" id="create-product-btn">Create</button>
</form>
<table class="table table-hover table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>Name</th>
            <th>Default Code</th>
            <th>List Price</th>
            <th>Standard Price</th>
        </tr>
        </thead>
        <tbody id="product-data">
            <!-- Product data will be loaded here -->
        </tbody>
</table>
<p id="text"></p>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        fechData();
        $("#success-message").text("hello");
        // $("#text").text("Your text here");

        $('#create-product-form').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            var form_data = $(this).serialize(); // Serialize the form data
            $.ajax({
                url: "{{ route('product.store') }}",
                method: 'post',
                data: form_data,
                success: function(response) {
                    // Check if the product was created successfully
                    if (response.success) {
                        fechData();
                        $('#create-product-form').trigger('reset'); // Clear the form inputs
                        $('#text').text(response.success); // Display success message


                        // console.log(response.success);
                        // alert('success to create product.');
                    } else {
                        alert('Failed to create product. Please try again.');
                    }
                },
                error: function() {
                    alert('Failed to create product. Please try again.');
                }
            });
        });

        function fechData(){
        $.ajax({
            url: '/api/data',
            type: 'GET',
            dataType: 'json',
            success: function(data) {

                var names = data.map(function(product) {
                // return product.name; // extract the name property from each product object
                console.log(product.name); // Handle the response data
                var product_data = $('#product-data');
                // Clear the table body
                product_data.empty();
                // Loop through the fetched data and append it to the table
                $.each(data, function(i, product) {
                    product_data.append('<tr><td>' + product.name + '</td><td>' + product.default_code + '</td><td>' + product.list_price + '</td><td>' + product.standard_price + '</td></tr>');
                });
            });
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error(errorThrown);
            }
        });
        }
    });


</script>

</body>
</html>
