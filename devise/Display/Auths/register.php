<html>
<h2> Register form </h2>
<form action="<?= route_post('GemstonePatch.test1','Diamond');?>" method="post">
    <label for="fname">First name:</label><br>
    <input type="text" id="fname" name="fname"><br>
    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="lname">
    <button type="submit">Submit</button>
</form>
</html>

