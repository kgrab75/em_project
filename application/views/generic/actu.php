<section class="col-sm-12 ">
    <h2 class="bg-primary panel-heading no-margin-bottom">Actualités</h2>

    <ul class="list-unstyled col-sm-12 bg-secondary sideContent actus">
        <li>
            <a href="<?php echo base_url()."actu/".$lastActu[0]->id; ?>">
                <h4><?php echo ucfirst($lastActu[0]->titre); ?> </h4>
                <p><?php echo character_limiter(ucfirst($lastActu[0]->content), 150); ?></p>
                <span class="date col-xs-12 text-right small"><?php echo ucfirst($lastActu[0]->date); ?> </span>
            </a>
            <p class="clear"></p>

        </li>
        <li>
            <a href="<?php echo base_url()?>actus" role="button" class="btn btn-lg btn-info btn-block no-margin-bottom">
               Toutes les actualités
            </a>
            <p class="clear"></p>
        </li>
    </ul>
</section>