<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoMobility | <?php echo $title ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/fonts/fonts.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css"/>

    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/images/favicon.ico" />

    <script src="<?= base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script src="<?= base_url(); ?>assets/js/mapHome.js"></script>


</head>
<body>

    <div class="container">

        <!-- MENU -->
        <div class="col-sm-12 menu">

            <nav class="navbar navbar-default menu" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>/assets/images/headLogo.png" alt=""/>Go Mobility</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?= base_url(); ?>index.php/welcome/view/projet">Le projet</a></li>
                            <li><a href="<?= base_url(); ?>index.php/welcome/view/experiences">Vos expériences</a></li>
                            <li><a href="<?= base_url(); ?>index.php/welcome/view/participation">Je participe</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

        </div>

        <!-- FIN MENU -->








