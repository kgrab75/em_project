<script src="<?= base_url(); ?>assets/js/bestEcoactors.js"></script>

<section class="col-sm-8">

    <?php
    $url = base_url();
    ?>

    <h1>Les meilleurs "éco-acteurs"</h1>

    <p>Nihil acciderat ei, quod nollet, nisi quod anulum, quo delectabatur, in mari abiecerat. Laboro autem non sine causa; Tamen a proposito, inquam, aberramus. Qui non moveatur et offensione turpitudinis et comprobatione honestatis? Quid autem habent admirationis, cum prope accesseris? Hoc non est positum in nostra actione. Hic nihil fuit, quod quaereremus.</p>

    <h2 class="bg-primary panel-heading no-margin-bottom"><i class="fa fa-trophy"></i> Le meilleur éco-acteur</h2>
    <div class="content-area">


    <div class="listeXp col-sm-12" id="bestEcoactor">


        <?php


        if($ecoactors == null){

            echo "<div class='col-sm-12 alert alert-warning'><p>Actuellement il n'y a pas de meilleur éco-acteur</p></div>";

        }
        ?>




    </div>
    <div class="clear"></div>
    </div>



    <div class="accroche">
        <p class="text-center">Vous aussi tentez de remporter un vélo éléctrique<br/>en participant à notre <a href="<?php echo $url.'concours';?>">concours</a>!</p>
    </div>



    <a role="button" class="btn btn-primary btn-block btn-lg" href="<?php echo $url.'participation';?>">Participer en postant votre éco-action</a>


    <h2>Le Top 10 des éco-acteurs</h2>



    <table class="table table-striped top15">
        <thead>
            <tr>
                <th class="bg-primary text-center">#</th>
                <th class="bg-primary">Titre</th>
                <th class="bg-primary text-center">GES</th>
                <th class="bg-primary text-center">Transport</th>
                <th class="bg-primary text-center"></th>
            </tr>
        </thead>
        <tbody id="best10">





        </tbody>
    </table>







</section>