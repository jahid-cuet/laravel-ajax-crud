<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Product</title>
    <!-- Bootstrap CSS -->
    
    <!-- Jquery CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="mb-3">
            <label for="category" class="form-label">Select Category</label>
            <select name="category" id="category" class="form-select">
                <option value="">Select Category</option>
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <table class="table table-striped table-bordered" id="productTable">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody id="tbody">
               
               
                @if (count($products) > 0)
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price}}</td>
                    <td>{{ $product->description}}</td>
                </tr>
            @endforeach
                
               
            @endif
               
               
                <!-- Products will be loaded here dynamically -->
            </tbody>
        </table>
    </div>

  



<script>
    $(document).ready(function () {
    $("#category").on('change', function () {
        var category = $(this).val();

        $.ajax({
            type: "GET",
            url: "{{ route('filter') }}",
            data: { 'category': category },
            success: function (data) {

                var products = data.products;
                var html='';
                if (products.length > 0) {

                    for (let i= 0; i < products.length; i++) {
                        html +='<tr>\
                            <td>'+(i+1)+'</td>\
                            <td>'+products[i]['name']+ '</td>\
                            <td>'+products[i]['price']+ '</td>\
                            <td>'+products[i]['description']+ '</td>\
                            </tr>';

                    }
                    
                } else {

                    html +='<tr>\
                        <td> No Data Found </td>\
                            </tr>'
                    
                }
                $("#tbody").html(html);
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
