<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoMobility | <?php echo $title ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/fonts/fonts.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style_admin.css"/>

    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/images/favicon.ico" />

    <script src="<?= base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>


</head>

<body>

    <header class="menu navbar">

        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url(); ?>admin"><img src="<?= base_url(); ?>/assets/images/headLogo.png" alt=""/>Administration Go Mobility</a>
            </div>

        </div>


    </header>


    <div class="container">
        <div style="height: 60px;">
            <div class="bg-danger text-danger col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <?php echo validation_errors(); ?>
                <?php echo @$error_check_id; ?>
            </div>
        </div>

        <form role="form" method="post" action="connection" class="form-signin col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <h2 class="form-signin-heading">Administration</h2>
            <input type="text" name="username" autofocus="" placeholder="Login" class="form-control" value="<?php echo set_value('username'); ?>">
            <input type="password" name="password" placeholder="Mot de passe" class="form-control">

            <button type="submit" class="btn btn-lg btn-primary btn-block">Connexion</button>
        </form>

    </div>
<!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


</body>
</html>