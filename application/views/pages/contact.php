<section class="col-sm-8">

    <h1>Contact</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non est igitur voluptas bonum. Quae contraria sunt his, malane? Duo Reges: constructio interrete. </p>

    <form role="form" class="form-horizontal" method="post" action="contact">

        <div class="form-group">

            <label for="nom" class="col-sm-2">Nom</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" value="<?php echo set_value('nom'); ?>">
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
        <div class="form-group <?php echo form_error("objet", " ", " ");?>">

            <label for="objet" class="col-sm-2">Objet  <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name ="objet" id="objet" placeholder="L'objet de votre message" value="<?php echo set_value('objet'); ?>">
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



        <button type="submit" class="btn btn-primary btn-block btn-lg">Envoyer</button>
    </form>



</section>