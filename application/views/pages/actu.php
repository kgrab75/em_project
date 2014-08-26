<section class="col-sm-8">


    <h1>
        <?php echo ucfirst($actu[0]->titre); ?>
    </h1>

    <p class="no-margin-top"> <?php echo date('j/m/Y à H:i', strtotime($actu[0]->date)); ?></p>
    <div class="fb-like" data-href="<?php echo base_url(); ?>actu/<?php echo $actu[0]->id; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
    <div style="margin-top: 2em">
        <?php echo ucfirst($actu[0]->content); ?>

    </div>
</section>