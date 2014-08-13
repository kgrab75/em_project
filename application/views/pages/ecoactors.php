<section class="col-sm-8">

    <?php
    $url = base_url();
    ?>

    <h1>Les meilleurs "éco-acteurs"</h1>

    <p>Nihil acciderat ei, quod nollet, nisi quod anulum, quo delectabatur, in mari abiecerat. Laboro autem non sine causa; Tamen a proposito, inquam, aberramus. Qui non moveatur et offensione turpitudinis et comprobatione honestatis? Quid autem habent admirationis, cum prope accesseris? Hoc non est positum in nostra actione. Hic nihil fuit, quod quaereremus.</p>

    <h2><i class="fa fa-trophy"></i> Le meilleur éco-acteur</h2>

    <div class="listeXp">


        <?php

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
                    $result = $bigUnit.'.0'.$bigUnitString;;
                }


            } else {
                $result = $smallUnit .' '. $smallUnitString;
            }

            return $result;
        }



        if($ecoactors == null){

            echo "<div class='col-sm-12 alert alert-warning'><p>Il n'y a pas de résultat pour ce mode de transport</p></div>";

        } else {



            //FORMULE CONVERSION DUREE (format 1h10m)
            $dureeTotal = $ecoactors[0]->duree;
            $dureeM = $dureeTotal%60;
            $dureeH = $dureeTotal/60;
            $duree = intval($dureeH);
            if($duree !== 0) {
                $duree = $duree .  'h' . $dureeM;
            } else {
                $duree =  $dureeM . 'm';
            }

            $distance = convertUnit($ecoactors[0]->distance, 'm', 'km');
            $ges = convertUnit($ecoactors[0]->ges, 'g', 'kg');

            $transport = $ecoactors[0]->transport;

            if($transport == "WALKING") {
                $transport = "Marche à pied";
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
                $transport = "Vélo";
                $transportClass = "velo";
            }
            echo '<div class="'. $transportClass .' '.  strtolower ($ecoactors[0]->difficulty) .  '">';
            echo '<a class="head" href="' . $url .'experience/' . $ecoactors[0]->id .'"><h3 class="h3Bloc panel-heading">' . character_limiter(ucfirst($ecoactors[0]->titre), 45) . '<span class="badgeRight"> - '. $ges .'</span></h3></a>';
            echo '<div class="content-area col-sm-12">';

            echo '<p>' . character_limiter( ucfirst($ecoactors[0]->description), 255) . '<a class="showMore" href="' . $url .'experience/' . $ecoactors[0]->id .'">Lire la suite</a></p>';

            echo '<div class="clear"></div>';

            echo '<div class="col-sm-12 bg-secondary infosParcours">';
            echo '<div class="col-sm-3 text-center"><p>'. $transport . '</p></div>';
            echo '<div class="col-sm-3 text-center"><p><i class="fa fa-clock-o"></i> '. $duree . '</p></div>';
            echo '<div class="col-sm-3 text-center"><p><i class="fa fa-location-arrow"></i> '. $distance . '</p></div>';
            echo '<div class="col-sm-3 text-center"><p><i class="fa fa-signal"></i> '. $ecoactors[0]->difficulty . '</p></div>';

            echo '</div>';


            echo '</div>';
            echo '</div>';
            echo '<div class="clear"></div>';

        }

        ?>




    </div>

    <div class="accroche">
        <p class="text-center">Vous aussi tentez de remporter un vélo éléctrique<br/>en participant à notre <a href="<?php echo $url.'concours';?>">concours</a>!</p>
    </div>



    <a role="button" class="btn btn-primary btn-block btn-lg" href="<?php echo $url.'participation';?>">Participer en postant votre éco-action</a>






    <h2>Le Top 15 des éco-acteurs</h2>



    <table class="table table-striped top15">
        <thead>
            <tr>
                <th class="bg-primary text-center">#</th>
                <th class="bg-primary">Titre</th>
                <th class="bg-primary text-center">GES</th>
                <th class="bg-primary text-center">Transport</th>
                <th class="bg-primary text-center">Durée</th>
                <th class="bg-primary text-center">Distance</th>
                <th class="bg-primary text-center"></th>
            </tr>
        </thead>
        <tbody>

        <?php

        for($i=1; $i <15; $i++){

            //FORMULE CONVERSION DUREE (format 1h10m)
            $dureeTotal = $ecoactors[$i]->duree;
            $dureeM = $dureeTotal%60;
            $dureeH = $dureeTotal/60;
            $duree = intval($dureeH);
            if($duree !== 0) {
                $duree = $duree .  'h' . $dureeM;
            } else {
                $duree =  $dureeM . 'm';
            }

            $distance = convertUnit($ecoactors[$i]->distance, 'm', 'km');
            $ges = convertUnit($ecoactors[$i]->ges, 'g', 'kg');

            $transport = $ecoactors[$i]->transport;

            if($transport == "WALKING") {
                $transport = "Marche à pied";
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

            $i1 = $i + 1;
            echo '<tr>';
            echo '<td class="text-center">'.$i1.'</td>';
            echo '<td class=""><a href="'.$url.'/experience/'.$ecoactors[$i]->id.'">'.ucfirst($ecoactors[$i]->titre).'</a></td>';
            echo '<td class="text-center">'.$ges.'</td>';
            echo '<td class=" text-center">'.$transport.'</td>';
            echo '<td class="text-center">'.$duree.'</td>';
            echo '<td class="text-center">'.$ecoactors[$i]->distance.'</td>';
            echo '<td class="text-center"><a href="'.$url.'/experience/'.$ecoactors[$i]->id.'" class="btn btn-primary" role="button"><i class="fa fa-search"></i></a></td>';
            echo '</tr>';

        }

        ?>



        </tbody>
    </table>







</section>