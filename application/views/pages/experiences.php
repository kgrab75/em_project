
<script type="text/javascript">
    var xpJson = '<?php echo($jsonData); ?>';
    var url = '<?php echo(base_url()); ?>';
</script>

<script src="<?= base_url(); ?>assets/js/listeXp.js"></script>

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


    if($this->data["results"] == null){

        echo "<div class='col-sm-12 alert alert-warning'><p>Il n'y a pas de résultat pour ce mode de transport</p></div>";

    }
    else {
        echo "<div id='xpContent'></div>";
    }

        ?>

    <div class="pages">
        <?php echo $this->data["links"]; ?>
    </div>

    <div id="mapDetails">

    </div>


</section>