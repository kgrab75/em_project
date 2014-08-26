<aside class="col-sm-3 col-md-2 sidebar">

    <ul class="nav nav-sidebar">
        <li <?php if($page == 'dashboard') echo('class="active"'); ?> ><a href="<?= base_url(); ?>admin/dashboard"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
        <li><a href="<?= base_url(); ?>admin/dashboard/eco_acteur"><i class="fa fa-map-marker "></i> Eco-acteurs</a></li>
        <li><a href="<?= base_url(); ?>admin/dashboard/comments"><i class="fa fa-comments"></i> Commentaires</a></li>
        <li><a href="<?= base_url(); ?>"><i class="fa fa-globe"></i> Site public</a></li>
    </ul>

    <ul class="nav nav-sidebar">
        <li><a href=""><i class="fa fa-trophy"></i> Meilleur Eco-acteur</a></li>
    </ul>

</aside>