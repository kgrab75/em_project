<section class="col-sm-8">

    <h1 class="experience"><?php echo ucfirst($dataXp->titre); ?></h1>

    <div class="fb-like" data-href="<?php echo base_url(); ?>experience/<?php echo $dataXp->id; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>


    <?php
    if(isset($_GET["p"]) && $_GET["p"] == "success"){
        echo "<div class='alert alert-success'>Votre commentaire a bien été posté</div>";
    }
    ?>

    <p><?php echo ucfirst($dataXp->description)  ?></p>

    <?php
    //CHARGEMENT DU SCRIPT "SCROLLTO"
    //Si le formulaire a déjà était posté et qu'il y a des erreurs au rechargement de la page, on scroll jusqu'au formulaire
    if(set_value('ip')){
        echo '<script type="text/javascript" src="'.base_url().'/assets/js/scrollto.js"></script>';
    }
    ?>


    <h2 class="bg-primary panel-heading no-margin-bottom">Feuille de route</h2>

    <section class="content-area">
        <div class="col-sm-9">
            <script src="<?= base_url(); ?>assets/js/mapDetails.js"></script>
            <div id="mapDetails" style="height:30em; width: 100%"></div>
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



            <div class="col-sm-12">
                <div id="directionsPanel">

                </div>
            </div>


        </div>


        <div class="clear"></div>
    </section>




    <div class="panel-group" id="accordion">
            <div class="">
                <div class="">
                    <p class="">
                        <button class="btn-block btn btn-lg btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="fa fa-plus-circle"></i> Poster un commentaire
                        </button>
                    </p>
                </div>
                <div id="collapseOne" class="panel-collapse collapse <?php if(set_value('ip')){echo "in";} ?>">
                    <div class="panel-body">
                        <form id="commentForm"role="form" class="form-horizontal" method="post" action="<?php echo $dataXp->id?>">

                            <div class="form-group">

                                <label for="nom" class="col-sm-2">Nom</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom" value="<?php echo set_value('nom'); ?>">
                                    <?php echo form_error("nom"); ?>
                                </div>

                                <label for="prenom" class="col-sm-2 <?php echo form_error("prenom", " ", " "); ?>">Prénom <span class="required">*</span></label>
                                <div class="col-sm-4 <?php echo form_error("prenom", " ", " "); ?>">
                                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" value="<?php echo set_value('prenom'); ?>">
                                </div>


                            </div>

                            <div class="form-group <?php echo form_error("email", " ", " "); ?>">

                                <label for="email" class="col-sm-2">Email <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Votre adresse email" value="<?php echo set_value('email'); ?>">
                                    <?php
                                    if(set_value('email')){

                                        echo form_error("email", "<p class='text-danger bg-danger ", "'> L'adresse email saisie est invalide</p>");
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-sm-2 <?php echo form_error("message", " ", " "); ?>" for="message">Message <span class="required">*</span></label>

                                <div class="col-sm-10  <?php echo form_error("message", " ", " "); ?>">
                                    <textarea class="form-control" rows="5" name="message" id="message"><?php echo set_value('message'); ?></textarea>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="checkbox col-sm-offset-2 col-sm-10">
                                    <label>
                                        <input type="checkbox" name="okForm" id="okForm" value="OK"> J'accepte les conditions d'utilisation <span class="required">*</span></a>
                                    </label>
                                    <?php echo form_error("okForm", "<p class='text-danger bg-danger ", "'> Vous devez accepter les conditions d'utilisation</p>");?>
                                </div>
                            </div>
                            <p><span class="required">*</span> Champs obligatoires</p>

                            <input type="hidden" name="ip" value="<?php if(set_value('ip')){echo set_value('ip');}else{echo $_SERVER['REMOTE_ADDR'];} ?> ">

                            <button type="submit" class="btn btn-primary btn-block btn-lg">Envoyer</button>
                        </form>


                    </div>
                </div>
            </div>


    </div>

    <div class="clear"></div>

    <section class="commentaires">

        <h2 class="bg-primary panel-heading no-margin-bottom">Avis et Commentaires</h2>



        <div class="col-sm-12 content-area">


            <div class="comments">



                <?php

                if($comments == null){

                    echo "<div class='col-sm-12 alert alert-info'><p>Il n'y a pas de commentaire pour cette experience, soyez le premier à donner votre avis!</p></div>";

                } else {

                    foreach($comments as $row) {

                        echo "<div class='comment'>";

                        echo "<h4 class='comment'>".ucfirst($row->prenom)." ";
                        if($row->nom == ""){
                            echo "<span class='date'> Posté le : ".date('j/m/Y à H:i', strtotime($row->date))."</span></h4>";
                        }else {
                            echo ucfirst(substr($row->nom, 0, 1)).". <span class='date'>".$row->date."</span></h4>";
                        }




                        echo "<div class='comment-content'>";
                            echo "<p class='comment'>".ucfirst($row->message)."</p>";
                            //echo "<p class='comment text-right'>".$row->date."</p>";
                        echo "</div>";
                        echo "<div class='clear'></div>";

                        echo "</div>";

                    }
                }

                ?>
            </div>



        </div>

    </section>




</section>