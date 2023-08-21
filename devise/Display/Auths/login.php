<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Xel Framework Documentation">
    <meta name="author" content="Xel Team">
    <meta name="keywords" content="Xel Framework Documentation">

    <!-- Title Page-->
    <title>Login | Xel Docs</title>

    <link href="<?= asset('/css/vendor/mdi-font/css/material-design-iconic-font.min.css');?>" rel="stylesheet" media="all">
    <link href="<?= asset('/css/vendor/font-awesome-4.7/css/font-awesome.min.css');?>" rel="stylesheet" media="all">
    <link
            href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Main CSS-->
    <link href="<?= asset('/css/auth.css');?>" rel="stylesheet" media="all">
</head>

<body>
<div class="page-wrapper bg-gra-01 p-t-160 p-b-100 font-poppins">
    <div class="wrapper wrapper--w780">
        <div class="card card-3">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Login</h2>

                <form action="<?= route_post('GemstonePatch.dologin','Diamond');?>" method="POST">
                    <?= getcsrf();?>

                    <div class="input-group">
                        <input class="input--style-3" type="email" id="email" placeholder="Insert your email" name="email">
                    </div>
                    <div class="input-group">
                        <input class="input--style-3" type="password" placeholder="Password" name="password">
                    </div>
                    <div class="p-t-10">
                        <button class="btn btn--pill btn--green" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

</html>