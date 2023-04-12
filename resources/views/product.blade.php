<!-- resources/views/product.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>
    <h1>Create Product</h1>

    <h1 id="#success-message"></h1>

<form method="POST" action="{{ route('product.store') }}" id="create-product-form">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="default_code">Default Code:</label>
        <input type="text" name="default_code" id="default_code">
    </div>
    <div>
        <label for="list_price">List Price:</label>
        <input type="number" name="list_price" id="list_price" step="0.01">
    </div>
    <div>
        <label for="standard_price">Standard Price:</label>
        <input type="number" name="standard_price" id="standard_price" step="0.01">
    </div>
    <button type="submit" id="create-product-btn">Create</button>
</form>
<p id="text"></p>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
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
    });
</script>

</body>
</html>
