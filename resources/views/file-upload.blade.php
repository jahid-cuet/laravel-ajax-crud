<!-- jQuery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<form id="fileUpload">
    @csrf
    <label for="file">Select File</label>
    <input type="file" name="file" id="file">
    <br><br>
    <button type="submit">Upload</button>
    <span id="error"></span>
</form>

<script>
$(document).ready(function () {
    $("#fileUpload").submit(function (e) { 
        e.preventDefault();

        $("#error").text('');
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{ route('file.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response) {
                    // Resetting the form
                    $("#fileUpload")[0].reset();
                    alert("File uploaded successfully");
                }
            },
            error: function (response) {
                if (response.responseJSON && response.responseJSON.message) {
                    $("#error").text(response.responseJSON.message);
                } else {
                    $("#error").text("An error occurred during file upload.");
                }
            }
        });
    });
});
</script>
