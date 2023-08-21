<html>
<form action="<?= route_post('GemstonePatch.test1', 'Diamond');?>" method="post" enctype="multipart/form-data">
    <?= getcsrf() ;?>
    <?= method('PUT');?>


    <label for="fname">First name:</label><br>
    <input type="text" id="fname" name="fname"><br>


    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="lname">

    <label for="lname">Files:</label><br>
    <input type="file" id="lname" name="document">

    <button type="submit">Submit</button>
</form>
</html>
