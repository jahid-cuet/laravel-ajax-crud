<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Name Input</title>
    <!-- Bootstrap CSS -->
    
    <!-- Jquery CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <label for="name">Student Name</label>
   <input type="text" class="form-control" id="name" name="name" placeholder="Enter student name">
   <div id="product_list"></div>
</div>


<script>
    $(document).ready(function () {
    $("#name").on('keyup', function (e) {
        var value = $(this).val();

        $.ajax({
            type: "GET",
            url: "{{ route('search') }}",
            data: { 'name': value },
            success: function (data) {
                $("#product_list").html(data);
            }
        });
    });

    $(document).on('click', 'li', function () {
        var value = $(this).text();
        $("#name").val(value);
        $("#product_list").html("");
    });
});


</script>

<!-- Bootstrap JS, Popper.js, and jQuery -->

</body>
</html>
