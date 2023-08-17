<html>
<form action="<?= route_post('GemstonePatch.test1', 'Diamond');?>" method="post" enctype="multipart/form-data">
    <!-- The 'action' attribute specifies where the form data should be sent when submitted.
         The 'method' attribute specifies the HTTP method to be used (POST in this case).
         The 'enctype' attribute specifies how the form data should be encoded for submission. -->

    <input type="hidden" name="_method" value="PUT">
    <!-- This hidden input field is used to emulate a PUT request.
         Some web frameworks use a hidden input field like this to override the HTTP method. -->

    <label for="fname">First name:</label><br>
    <input type="text" id="fname" name="fname"><br>
    <!-- Text input fields for the first name and last name.
         The 'id' attribute is used to uniquely identify the input field.
         The 'name' attribute specifies the name of the input field, which is used when submitting the form data. -->

    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="lname">

    <label for="lname">Files:</label><br>
    <input type="file" id="lname" name="document">
    <!-- File input field for uploading files.
         Users can browse their system and select files for upload. -->

    <button type="submit">Submit</button>
    <!-- The submit button to send the form data to the specified 'action' URL. -->
</form>
</html>
