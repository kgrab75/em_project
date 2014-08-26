<section class="col-sm-8">

    <div class="col-sm-12">
        <h1>Actualités</h1>

        <div class="pages">
            <?php echo $this->data["links"]; ?>
        </div>

    <?php

        $data = $this->data["results"];
        $url = base_url();
        $sizeData = sizeof($data);


        $i = 0;
        while ($i < sizeof($data)) {

            echo "<div class='content-actu'>";

                echo "<a class='head' href='" . $url . "actu/" . $data[$i]->id ."'>";
                    echo "<h3 class='h3Actu panel-heading '>" . ucfirst($data[$i]->titre) . "</h3>";
                echo "</a>";
                echo "<div class='col-sm-12'>";
                    echo "<p>" . ucfirst($data[$i]->content) . "</p>";
                    echo "<div class='infoParcours text-right'><p>" . $data[$i]->date . "</p></div>";

                    echo "</div>";
                echo "<div class='clear'></div>";

            echo "</div>";

            $i++;
        }

    ?>
        <div class="pages">
            <?php echo $this->data["links"]; ?>
        </div>

    </div>
</section>