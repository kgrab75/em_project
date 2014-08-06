<section class="col-sm-8">

    <h1>Je participe</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non est igitur voluptas bonum. <a href='#' target='_blank'>Quae contraria sunt his, malane?</a> Quae contraria sunt his, malane? Duo Reges: constructio interrete. <i>Certe non potest.</i> </p>



    <form role="form" class="form-horizontal">
        <div class="form-group">

            <label for="email" class="col-sm-2">Email </label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Adresse email" value="">
            </div>

        </div>
        <div class="form-group">

            <label for="title" class="col-sm-2">Titre </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" placeholder="Titre de votre trajet" value="">
            </div>

        </div>
        <div class="form-group">

            <div class="col-sm-2">
                Transport
            </div>
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

            <label for="password" class="col-sm-2">Départ</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="password" placeholder="Coordonnées départ">
            </div>

            <label for="password" class="col-sm-2">Arrivée</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="password" placeholder="Coordonnées arrivée">
            </div>

            <div class="col-sm-10 col-sm-offset-2">
                (Vous pouvez entrez des coordonnées GPS ou une adresse complète)
            </div>

        </div>



        <div class="form-group">

            <label class="col-sm-2" for="description">Description </label>

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

        <button type="submit" class="btn btn-primary btn-block btn-lg ">Valider votre participation</button>
    </form>



        <div class="col-sm-9">
            <div id="mapPreview" style="height:30em; width: 100%"></div>
        </div>

        <div class="col-sm-3 text-center">

            <div class="mapInfo">
                <h3 class="bg-primary">CO2 <span class="mini"><br/>économisé :</span></h3>
                <h2 class="bg-secondary"><span id="totalGES"></span></h2>
            </div>

            <div class="mapInfo">
                <h3 class="bg-primary">Distance : </h3>
                <h2 class="bg-secondary"><span id="totalKm"></span></h2>
            </div>

            <div class="mapInfo">
                <h3 class="bg-primary">Durée : </h3>
                <h2 class="bg-secondary"><span id="duration"></span></h2>
            </div>

        </div>



    <div class="clear"></div>

        <button type="button" class="btn btn-primary btn-lg btn-block">Confirmer votre participation</button>


</section>


<script src="<?= base_url(); ?>assets/js/mapPreview.js"></script>