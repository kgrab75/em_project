<aside class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">

    <h2 class="bg-primary panel-heading no-margin-bottom">Informations</h2>

    <ul class="list-unstyled col-sm-12 bg-secondary sideContent info">
        <li>
            <a href="<?= base_url(); ?>admin/dashboard/eco_acteur">
                <i class="fa fa-map-marker "></i> Eco-acteurs <span class="badge"><?php echo $experienceCount; ?></span>
            </a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/dashboard/messages">
                <i class="glyphicon glyphicon-inbox "></i> Messages </span><span class="badge"><?php echo $messageCount; ?></span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-trophy"></i> Meilleur Eco-acteur : nom@mail.com
            </a>
        </li>
    </ul>

</aside>