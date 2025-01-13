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
    
          <div>
            <img src="{{asset('storage/')}}/{{ $student[0]->image }}"  alt="` + img + `" width="100px" height="100px">
        </div>                  

        
<br>
    <form id="update_form" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" value="{{ $student[0]->name }}" name="name" >

        <label for="email">Email:</label>
        <input type="email" id="email" value="{{ $student[0]->email }}" name="email" >

        <label for="image">Upload Image:</label>
        <input type="file" id="image"  value="{{ $student[0]->image }}"  name="file">

        <input type="hidden" name="id" value="{{ $student[0]->id }}">

        <br><br>
        <input type="submit" value="Update Student" id=''>
    </form>

<br>
    <span id="output">

    </span>

    <script>
        $(document).ready(function(){

            $("#update_form").submit(function (e) { 
                e.preventDefault();

            var form = $("#update_form")[0];  //Take form as a object
            var data = new FormData(form); //Give the data of the form .FormData Given this.

        $.ajax({
            type: "POST",
            url: "{{ route('updateStudent') }}",
            data: data,
            processData:false,
            contentType:false,
        
            success: function (data) {
                $("#output").text(data.result)
                window.open("/get-student","_self")
           
            },
            error:function(e){
                $("#output").text(data.result);
                
               
            }
            
        });


            });

        });
    </script>
</body>
</html>
