     <div class="col-sm-8 content">

        <div class="col-sm-12">
            <h2 class="bg-primary panel-heading no-margin-bottom">Dernière expérience</h2>
            <h3><a href="<?= base_url(); ?>experiecnce/<?php echo $lastActor->id;?>"><?php echo $lastActor->titre;?></a></h3>

            <p><?php echo character_limiter( $lastActor->description, 255) ?> <a href="<?= base_url(); ?>experiecnce/<?php echo $lastActor->id;?>">Lire la suite</a></p>
        </div>

        <div id="homeMap" class="col-sm-12">

            <h2 class="bg-primary panel-heading no-margin-bottom">Les derniers Eco-acteurs</h2>

            <div id="map-canvas" style="height:30em;width:100%;"></div>
            <div id="directions-panel"></div>
            <div id="directions-panel2"></div>
        </div>



    </div>
