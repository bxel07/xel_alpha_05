<html>
<h2> Register form </h2>
<form action="<?= route_post('GemstonePatch.doregister','Diamond');?>" method="post">
    <?= getcsrf();?>
    <label for="fname">username:</label><br>
    <input type="text" id="fname" name="username"><br>
    <label for="fname">Email:</label><br>
    <input type="email" id="fname" name="email"><br>
    <label for="lname">Password:</label><br>
    <input type="password" id="lname" name="password">
    <button type="submit">Submit</button>
</form>
</html>

