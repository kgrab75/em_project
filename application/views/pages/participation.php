<script src="<?= base_url(); ?>assets/js/mapPreview.js"></script>

<section class="col-sm-8">

    <h1>Je participe</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non est igitur voluptas bonum. <a href='#' target='_blank'>Quae contraria sunt his, malane?</a> Quae contraria sunt his, malane? Duo Reges: constructio interrete. <i>Certe non potest.</i> </p>



    <form role="form" class="form-horizontal" id="participation-form">
        <div class="form-group">

            <label for="email" class="col-sm-2">Email <span class="required">*</span> </label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="email" placeholder="Adresse email" value="" name="email">
            </div>

        </div>
        <div class="form-group">

            <label for="title" class="col-sm-2">Titre <span class="required">*</span> </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" placeholder="Titre de votre trajet" value="">
            </div>

        </div>
        <div class="form-group">

            <label class="col-sm-2">
                Transport <span class="required">*</span>
            </label>
            <div class=" col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="transportType" id="transportType1" value="WALKING" checked>
                    A pied
                </label>

                <label class="radio-inline">
                    <input type="radio" name="transportType" id="transportType2" value="TRANSIT">
                    En transport en commun
                </label>

                <label class="radio-inline">
                    <input type="radio" name="transportType" id="transportType3" value="DRIVING" >
                    En covoiturage
                </label>

                <label class="radio-inline">
                    <input type="radio" name="transportType" id="transportType4" value="BICYCLING" >
                    En vélo
                </label>
            </div>

        </div>
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
            <div class="form-group" id="gps">
                <label for="depart" class="col-sm-2">Départ <span class="required">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="depart" name="depart" placeholder="Coordonnées départ">
                </div>

                <label for="arrivee" class="col-sm-2">Arrivée <span class="required">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="arrivee" name="arrivee" placeholder="Coordonnées arrivée">
                </div>
            </div>

        </div>


        <div class="form-group">

            <label class="col-sm-2" for="description">Description <span class="required">*</span></label>

            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="description"></textarea>
            </div>

        </div>

        <div class="form-group">
            <div class="checkbox col-sm-offset-2 col-sm-10">
                <label>
                    <input type="checkbox"> Je souhaite participer au <a href="#">concours</a>
                </label>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-block btn-lg disabled" id="submitValue">Valider votre participation</button>

        <div id="mapRoute" hidden>

            <h2 class="bg-primary panel-heading no-margin-bottom">Votre feuille de route</h2>

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


                <div class="clear"></div>
            </section>


            <button type="submit" class="btn btn-primary btn-lg btn-block">Confirmer votre participation</button>



        </div>


    </form>


</section>


