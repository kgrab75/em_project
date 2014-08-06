<section class="col-sm-8">
        <h1>Vos expériences</h1>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod cum dixissent, ille contra. Falli igitur possumus. Duo Reges: constructio interrete. Quae sequuntur igitur? Quid enim?</p>
        <?php
        $url = base_url();

        foreach ($experiences as $row) {
        echo '<a href="' . $url .'experience/' . $row->id .'"><h3 class="h3Bloc panel-heading">' . $row->titre . '</h3></a>';
        echo '<div class="content-area col-sm-12">';

        echo '<p>' . character_limiter( $row->description, 255) . '<a href="' . $url .'experience/' . $row->id .'">Lire la suite</a></p>';

        echo '<div class="clear"></div>';

        echo '<div class="col-sm-12 bg-primary">';
            echo '<div class="col-sm-4 text-center"><i class="fa fa-camera-retro"></i> Durée : '. $row->duree . '</div>';
            echo '<div class="col-sm-4 text-center"><i class="fa fa-location-arrow"></i> Distance : '. $row->distance . '</div>';
            echo '<div class="col-sm-4 text-center"><i class="fa fa-recycle"></i> C0<sub>2</sub> : '. $row->ges . '</div>';
        echo '</div>';


        echo '</div>';
        echo '<div class="clear"></div>';

        }


        ?>


</section>