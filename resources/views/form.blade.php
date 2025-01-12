<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Form Example</title>

    <!-- Jquery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            width: 300px;
        }

        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <form id="my-form" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="file" required>

        <input type="submit" value="Add Student" id='btnSubmit'>
    </form>

<br>
    <span id="output">

    </span>

    <script>
        $(document).ready(function(){

            $("#my-form").submit(function (e) { 
                e.preventDefault();

            var form = $("#my-form")[0];  //Take form as a object
            var data = new FormData(form); //Give the data of the form .FormData Given this

            $("#btnSubmit").prop('disabled',true);  //Button disabled after submit the form

        $.ajax({
            type: "POST",
            url: "{{ route('addStudent') }}",
            data: data,
            processData:false,
            contentType:false,
        
            success: function (d) {
                $("#output").text(d.result)
                $("#btnSubmit").prop('disabled',false);  //If any error occurs then enabled the button     
           

                $("input[type='text']").val('');
                $("input[type='email']").val('');   //Empty the form value after form submitted done
                $("input[type='file']").val('');

            },
            error:function(e){
                $("#output").text(d.result);
                $("#btnSubmit").prop('disabled',false);  //If any error occurs then enabled the button
               
            }
            
        });


            });

        });
    </script>
</body>
</html>
