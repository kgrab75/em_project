<!doctype html>
<html lang="fr" ng-app="crud">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin GoMobility | <?php echo $title ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/fonts/fonts.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style_admin.css"/>

    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/images/favicon.ico" />

    <script src="<?= base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/angular.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/app.js"></script>


</head>
<body ng-controller="crudController as crud">

<!-- MENU -->
<header class="menu navbar navbar-admin">

    <div class="container-fluid">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" >
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= base_url(); ?>admin" style="padding-right: 5px;"><img src="<?= base_url(); ?>/assets/images/headLogo.png" alt=""/>Administration Go Mobility</a>

            <? $this->load->view('admin/breadcrumbs'); ?>


        </div>



        <p class="deco navbar-right"><a href="deconnection" class="btn btn-danger">Déconnexion <span class="glyphicon glyphicon-log-out"></span></a></p>

    </div>


</header>

<div class="container-fluid">



    <!-- FIN MENU -->