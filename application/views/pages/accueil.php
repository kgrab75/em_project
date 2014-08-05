     <div class="col-sm-8 content">

        <div>
            <h2>Dernière expérience</h2>
            <h3><a href="#"><?php echo $lastActor->titre;?></a></h3>

            <p><?php echo character_limiter( $lastActor->description, 255) ?> <a href="#">Lire la suite</a></p>
        </div>

        <div id="homeMap">

            <h2>Les derniers Eco-acteurs</h2>

            <div id="map-canvas" style="height:30em;width:100%;"></div>
            <div id="directions-panel"></div>
            <div id="directions-panel2"></div>
        </div>



    </div>
