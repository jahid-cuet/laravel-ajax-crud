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
<body class="container mt-4">

    <!-- Search Input -->
    <div class="form-group">
        <input type="search" id="search" name="search" placeholder="Search here..." class="form-control" aria-label="Search">
    </div>

    <!-- Table -->
    <table class="table table-bordered table-striped mt-3">
        <thead class="thead-dark">
            <tr>
                <th>SI NO.</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <!-- Sample data row -->
           @if (count($users) > 0)

           @foreach ($users as $user)

           <tr>
               <td>{{$user->id}}</td>
               <td>{{$user->name}}</td>
               <td>{{$user->email}}</td>
           </tr>
               
           @endforeach
               
           @else
           <tr>
            <td>No User Found</td>
           </tr>

           @endif
           
            <!-- More rows as needed -->
        </tbody>
    </table>



<script>
    $(document).ready(function () {
    $("#search").on('keyup', function () {
        var value = $(this).val();

        $.ajax({
            type: "GET",
            url: "{{ route('userSearch') }}",
            data: { 'search': value },
            success: function (data) {
               var users=data.users;
               var html='';
               if(users.length > 0){

                for(let i=0; i<users.length; i++){

                    html +='<tr>\
                    <td>'+users[i]['id']+'</td>\
                    <td>'+users[i]['name']+'</td>\
                    <td>'+users[i]['email']+'</td>\
                    </tr>';
                }

               }
               else{
                html +='<tr>\
                    <td>No Users Found </td>\
                    </tr>';
               }
                
    
        $("#tbody").html(html);
    
            }
        });
    });

  
});


</script>

</body>
</html>
