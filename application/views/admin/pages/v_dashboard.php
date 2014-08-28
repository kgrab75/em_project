

<aside class="col-sm-9 col-sm-offset-3">

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
            <a href="<?= base_url(); ?>admin/dashboard/ecoactors">
                <i class="fa fa-trophy"></i> Meilleur Eco-acteur : <span id="bestEco">  </span>
            </a>
        </li>
    </ul>

</aside>

<script>
    <?php echo('var jsonData = ' . $jsonData . ';'); ?>

    document.getElementById('bestEco').innerHTML = jsonData[0].email;

</script>