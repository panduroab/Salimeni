
<div class="row-fluid">
    <ul class="no-margin">
        <?
        $i = 1;
        foreach ($promotion as $row) {
            if ($i == 1)
                echo '<div class="row-fluid">';
            ?>
            <li class="span4 option-index rounded list-places">
                <a href="<?
        /* echo base_url('main/promotionDetails.html?promotion=' . $row['promotion']) */
        echo base_url('main/promocion/' . $row['promotion'] . '/' . $row['url'])
        ?>">
                    <div class="pull-right hours-details">
                        <span class="badge badge-success">Inicia: <? echo substr($row['startAt'], 10, -3); ?></span>
                        <span class="badge badge-important">Termina: <? echo substr($row['endsAt'], 10, -3); ?></span>
                    </div>
                    <span class="theplace"><? echo $row['place']; ?></span>
                    <h3><? echo $row['name']; ?></h3>
                    <p><? echo $row['details']; ?></p>
                </a> 
            </li>
            <?
            if ($i == 3) {
                echo '</div>';
                $i = 0;
            }
            $i++;
        }
        ?>
    </ul>
</div>  