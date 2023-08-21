<html>
<h2> Login form </h2>
<form action="<?= route_post('GemstonePatch.dologin','Diamond');?>" method="post">
    <?= getcsrf();?>
    <label for="fname">Email:</label><br>
    <input type="email" id="fname" name="email"><br>
    <label for="lname">Password:</label><br>
    <input type="password" id="lname" name="password">
    <button type="submit">Submit</button>
</form>
</html>

