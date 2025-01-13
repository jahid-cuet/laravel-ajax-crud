<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Form Example</title>

    <!-- Jquery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

    <table id="students-table" border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>SI NO.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <script>
        $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "{{ route('getStudent') }}",
            success: function (data) {  
                console.log(data);
                if(data.students.length> 0){


                    for (let i = 0; i < data.students.length; i++) {
                       
                        let img=data.students[i]['image'];

                        $("#students-table").append(
                            
                        `<tr>
                        <td>`+(i+1)+`</td>
                        <td>`+(data.students[i]['name'])+`</td>
                        <td>`+(data.students[i]['email'])+`</td>


                        <td>
                            
                            <img src="{{asset('storage/`+img+ `')}}"  alt="` + img + `" width="100px" height="100px">
                            </td>  
                            
                             <td>
                                <a href="edit-student/`+(data.students[i]['id'])+`">Edit</a>
                                <a href="#" class="deleteData" data-id= "`+(data.students[i]['id'])+`">Delete</a>
                                
                                </td>


                        </tr>`);
                    }
                }

                else{

                    $("#students-table").append("<tr><td colspan='4'>Data Not Found </td></tr>");

                }

            },
            error:function(err){

               console.log(err.responseText);
               
            }

            });

    $("#students-table").on("click",".deleteData",function () {
    

        var id = $(this).attr("data-id");
        var obj = $(this);

        $.ajax({
            type: "GET",
            url: "delete-student/"+id,
            success: function (data) {
                $(obj).parent().parent().remove();
                $("#output").text(data.result);
                },

                error:function(err){
                    console.log(err.responseText);
                }
        });
});
 });
        
</script>
</body>
</html>
