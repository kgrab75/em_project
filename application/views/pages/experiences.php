


<section class="col-sm-8 listeXp">
        <h1>Vos expériences</h1>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod cum dixissent, ille contra. Falli igitur possumus. Duo Reges: constructio interrete. Quae sequuntur igitur? Quid enim?</p>


    <div class="col-sm-12 bg-primary">
        <div class="col-sm-4">
            <select class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4"></div>

    </div>

    <div class="" >
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>

    <div class="clear"></div>

    <?php
        $url = base_url();

        //FORMULE CONVERSION DISTANCE/POIDS (km arrondi) ou
        function convertUnit ($smallUnit, $smallUnitString, $bigUnitString){
            if($smallUnit > 1000) {

                $bigUnit = $smallUnit / 1000;
                $bigUnit = intval($bigUnit);
                $smallDetails = $smallUnit % 1000;

                if($smallUnit % 1000 !== 0){

                    if($smallDetails < 100) {
                        $result = $bigUnit.'.0'.$smallDetails.' '.$bigUnitString;

                    } else {
                        if($smallDetails % 100 !== 0) {
                            $result = $bigUnit.'.'.$smallDetails.' '.$bigUnitString;
                        } else {
                            $smallDetails = $smallDetails / 100;
                            $result = $result = $bigUnit.'.'.$smallDetails.' '.$bigUnitString;
                        }

                    }

                } else {
                    $result = $bigUnit.'.0km';
                }


            } else {
                $result = $smallUnit .' '. $smallUnitString;
            }

            return $result;
        }

        foreach ($experiences as $row) {

            //FORMULE CONVERSION DUREE (format 1h10m)
            $dureeTotal = $row->duree;
            $dureeM = $dureeTotal%60;
            $dureeH = $dureeTotal/60;
            $duree = intval($dureeH);
            if($duree !== 0) {
                $duree = $duree .  'h' . $dureeM;
            } else {
                $duree =  $dureeM . 'm';
            }

            $distance = convertUnit($row->distance, 'm', 'km');
            $ges = convertUnit($row->ges, 'g', 'kg');

            $transport = $row->transport;

            if($transport == "WALKING") {
                $transport = "Covoiturage";
            }
            if($transport == "TRANSIT") {
                $transport = "Transports";
            }
            if($transport == "DRIVING") {
                $transport = "Covoiturage";
            }
            if($transport == "BICYCLING") {
                $transport = "A vélo";
            }


            echo '<a href="' . $url .'experience/' . $row->id .'"><h3 class="h3Bloc panel-heading">' . $row->titre . '<span class="badgeRight"> - '. $ges .'</span></h3></a>';
            echo '<div class="content-area col-sm-12">';

            echo '<p>' . character_limiter( $row->description, 255) . '<a class="showMore" href="' . $url .'experience/' . $row->id .'">Lire la suite</a></p>';

            echo '<div class="clear"></div>';

            echo '<div class="col-sm-12 bg-secondary infosParcours">';
            echo '<div class="col-sm-3 text-center"><p>'. $transport . '</p></div>';
            echo '<div class="col-sm-3 text-center"><p><i class="fa fa-clock-o"></i> '. $duree . '</p></div>';
            echo '<div class="col-sm-3 text-center"><p><i class="fa fa-location-arrow"></i> '. $distance . '</p></div>';
            echo '<div class="col-sm-3 text-center"><p><i class="fa fa-signal"></i> '. $row->difficulty . '</p></div>';

        echo '</div>';


        echo '</div>';
        echo '<div class="clear"></div>';

        }


        ?>



    <div class="" >
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>

</section>