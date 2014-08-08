


<section class="col-sm-8 listeXp">
        <h1>Vos expériences</h1>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod cum dixissent, ille contra. Falli igitur possumus. Duo Reges: constructio interrete. Quae sequuntur igitur? Quid enim?</p>


    <?
        function checkSelect($url, $val){

            if(isset($url) && $url == $val){
                echo 'selected';
            }
        }
    $url = $this->uri->segment(2);
    ?>






        <select id="transportSelect" class="form-control filterSelect input-lg">
            <option value=""<? checkSelect($url,"all"); ?>>Tous les modes de transports</option>
            <option value="WALKING" <? checkSelect($url,"walking"); ?>>Marche à pied</option>
            <option value="BICYCLING" <? checkSelect($url,"bicycling"); ?>>Vélo</option>
            <option value="TRANSIT" <? checkSelect($url,"transit"); ?>>Transports en commun</option>
            <option value="DRIVING" <? checkSelect($url,"driving"); ?>>Covoiturage</option>
        </select>



    <div class="clear"></div>

    <div class="pages">
        <?php echo $this->data["links"]; ?>
    </div>

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


    if($this->data["results"] == null){

        echo "<div class='col-sm-12 alert alert-warning'><p>Il n'y a pas de résultat pour ce mode de transport</p></div>";

    } else {
        foreach($this->data["results"] as $row) {


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
                $transport = "A pieds";
                $transportClass = "apied";
            }
            if($transport == "TRANSIT") {
                $transport = "Transports";
                $transportClass = "transports";
            }
            if($transport == "DRIVING") {
                $transport = "Covoiturage";
                $transportClass = "covoiturage";
            }
            if($transport == "BICYCLING") {
                $transport = "A vélo";
                $transportClass = "velo";
            }
            echo '<div class="'. $transportClass .' '.  strtolower ($row->difficulty) .  '">';
            echo '<a href="' . $url .'experience/' . $row->id .'"><h3 class="h3Bloc panel-heading">' . character_limiter(ucfirst($row->titre), 50) . '<span class="badgeRight"> - '. $ges .'</span></h3></a>';
            echo '<div class="content-area col-sm-12">';

            echo '<p>' . character_limiter( ucfirst($row->description), 255) . '<a class="showMore" href="' . $url .'experience/' . $row->id .'">Lire la suite</a></p>';

            echo '<div class="clear"></div>';

            echo '<div class="col-sm-12 bg-secondary infosParcours">';
            echo '<div class="col-sm-3 text-center"><p>'. $transport . '</p></div>';
            echo '<div class="col-sm-3 text-center"><p><i class="fa fa-clock-o"></i> '. $duree . '</p></div>';
            echo '<div class="col-sm-3 text-center"><p><i class="fa fa-location-arrow"></i> '. $distance . '</p></div>';
            echo '<div class="col-sm-3 text-center"><p><i class="fa fa-signal"></i> '. $row->difficulty . '</p></div>';

            echo '</div>';


            echo '</div>';
            echo '</div>';
            echo '<div class="clear"></div>';

        }

    }


        ?>

    <div class="pages">
        <?php echo $this->data["links"]; ?>
    </div>


</section>