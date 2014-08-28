<script src="<?= base_url(); ?>assets/js/mapPreview.js"></script>

<section class="col-sm-8">

    <h1>Je participe</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non est igitur voluptas bonum. <a href='#' target='_blank'>Quae contraria sunt his, malane?</a> Quae contraria sunt his, malane? Duo Reges: constructio interrete. <i>Certe non potest.</i> </p>



    <form role="form" class="form-horizontal" id="participation-form" method="post" action="participation">
        <div class="form-group">

            <label for="email" class="col-sm-2">Email <span class="required">*</span> </label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="email" placeholder="Adresse email" value="<?php echo set_value('email'); ?>" name="email">
                <?php
                if(set_value('email')){

                    echo form_error("email", "<p class='text-danger bg-danger ", "'> L'adresse email saisie est invalide</p>");
                }
                ?>
            </div>


        </div>

        <div id="mailError" class=""></div>

        <div class="form-group">

            <label for="titre" class="col-sm-2">Titre <span class="required">*</span> </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de votre trajet (100 caractères maximum)" value="<?php echo set_value('titre'); ?>" maxlength="100">
            </div>

        </div>

        <div id="titleError" class=""></div>

        <div class="form-group">

            <label class="col-sm-2">
                Difficulté <span class="required">*</span>
            </label>
            <div class=" col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="difficulty" id="difficulty1" value="Facile" <?php if(isset($_POST['difficulty']) && $_POST['difficulty'] == "Facile" || set_value('difficulty') == ""){echo "checked";}?>>
                    Facile
                </label>

                <label class="radio-inline">
                    <input type="radio" name="difficulty" id="difficulty2" value="Moyen" <?php if(isset($_POST['difficulty']) && $_POST['difficulty'] == "Moyen"){echo "checked";}?>>
                    Moyen
                </label>

                <label class="radio-inline">
                    <input type="radio" name="difficulty" id="difficulty3" value="Difficile" <?php if(isset($_POST['difficulty']) && $_POST['difficulty'] == "Difficile"){echo "checked";}?>>
                    Difficile
                </label>

            </div>

        </div>

        <div class="form-group">

            <label class="col-sm-2">
                Transport <span class="required">*</span>
            </label>
            <div class=" col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="transportType" id="transportType1" value="WALKING" <?php if(isset($_POST['transportType']) && $_POST['transportType'] == "WALKING" || set_value('transport') == ""){echo "checked";}?>>
                    A pied
                </label>

                <label class="radio-inline">
                    <input type="radio" name="transportType" id="transportType2" value="TRANSIT" <?php if(isset($_POST['transportType']) && $_POST['transportType'] == "TRANSIT"){echo "checked";}?>>
                    En transport en commun
                </label>

                <label class="radio-inline">
                    <input type="radio" name="transportType" id="transportType3" value="DRIVING" <?php if(isset($_POST['transportType']) && $_POST['transportType'] == "DRIVING"){echo "checked";}?>>
                    En covoiturage
                </label>

                <label class="radio-inline">
                    <input type="radio" name="transportType" id="transportType4" value="BICYCLING" <?php if(isset($_POST['transportType']) && $_POST['transportType'] == "BICYCLING"){echo "checked";}?>>
                    En vélo
                </label>
            </div>

        </div>

        <!--
        <div class="form-group">

            <label class="col-sm-2">
                Données <span class="required">*</span>
            </label>
            <div class=" col-sm-10">
                <label class="radio-inline adresseType">
                    <input class="dataAdresse" type="radio" name="adresseType" id="adresseType1" value="gps" checked>
                    Coordonnées GPS
                </label>

                <label class="radio-inline adresseType">
                    <input class="dataAdresse" type="radio" name="adresseType" id="adresseType2" value="postal">
                    Adresse postale
                </label>

            </div>

        </div>


        <div class="" id="donnees">
        -->



        <div class="" id="mapError">

        </div>


        <div class="form-group">
            <label for="depart" class="col-sm-2">Départ <span class="required">*</span></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="depart" name="depart" placeholder="Coordonnées GPS / Adresse de départ" value="<?php echo set_value('depart'); ?>">
            </div>


        </div>
        <div id="departError"></div>


        <div class="form-group"">
            <label for="arrivee" class="col-sm-2">Arrivée <span class="required">*</span></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="arrivee" name="arrivee" placeholder="Coordonnées GPS / Adresse d'arrivée" value="<?php echo set_value('arrivee'); ?>">
            </div>

        </div>

        <div id="arriveeError"></div>

        <!--</div>-->



        <div class="clear"></div>


        <div class="form-group">

            <label class="col-sm-2" for="description">Détails <span class="required">*</span></label>

            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="description"><?php echo set_value('description'); ?></textarea>
            </div>

        </div>

        <div id="descriptionError" class=""></div>

        <div class="form-group">
            <div class="checkbox col-sm-offset-2 col-sm-10">
                <label>
                    <input type="checkbox"  name="concours" id="concours" value="yes" <?php if(isset($_POST['concours']) && $_POST['concours']  == "yes"){echo "checked";}?>> Je souhaite participer au <a href="<?= base_url(); ?>concours">concours</a> du meilleur éco-acteur
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox col-sm-offset-2 col-sm-10">
                <label>
                    <input type="checkbox" name="okForm" id="okForm" value="OK"> J'accepte les <a href="#"> conditions générales d'utilisation</a> <span class="required">*</span>
                </label>
                <?php echo form_error("okForm", "<p class='text-danger bg-danger ", "'> Vous devez accepter les conditions d'utilisation</p>");?>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-block btn-lg disabled" id="submitValue">Aperçu de votre experience</button>

        <div class="col-sm-12 infoSubmit"><p>Veuillez remplir tous les champs obligatoires afin de pouvoir valider votre éco-action</p></div>

        <div id="mapRoute" hidden>

            <h2 class="bg-primary panel-heading no-margin-bottom">Votre expérience</h2>

            <section class="content-area">


                <div class="col-sm-9">
                    <div id="mapPreview" style="height:30em; width: 100%"></div>
                </div>

                <div class="col-sm-3 text-center">
                    <div class="mapInfo ges">
                        <h3 class="h3Bloc panel-heading no-margin-top"><span class="maxi">CO<sub>2</sub></span> <span class="mini"><br/>économisé :</span></h3>
                        <h2 class=""><span id="totalGES"></span></h2>
                    </div>

                    <div class="mapInfo distance">
                        <h3 class="h3Bloc panel-heading">Distance : </h3>
                        <h2 class=""><span id="totalKm"></span></h2>
                    </div>

                    <div class="mapInfo duration">
                        <h3 class="h3Bloc panel-heading">Durée : </h3>
                        <h2 class=""><span id="duration"></span></h2>
                    </div>

                </div>

                <div class="col-sm-12">
                    <h2 id="titreInput"></h2>
                    <p id="descriptionInput"></p>

                </div>

                <div class="clear"></div>
            </section>

            <input type="hidden" name="ip" value="<?php if(set_value('ip')){echo set_value('ip');}else{echo $_SERVER['REMOTE_ADDR'];} ?> ">

            <input type="hidden" name="start" id="start" value="">
            <input type="hidden" name="end" id="end" value="">

            <button id="submitXp" type="submit" class="btn btn-primary btn-lg btn-block">Confirmer votre participation</button>



        </div>


    </form>


</section>


