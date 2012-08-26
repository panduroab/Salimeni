
<ul>
    <?
    if (isset($users)) {
        foreach ($users as $value) {
            ?>
            <li><? echo $value['name']; ?></li>
            <?
        }
    } else if (isset($places)) {
        foreach ($places as $value) {
            ?>
            <li><a href="<? echo base_url('place/getPlace.html?place=' . $value['place']); ?>">
                    <? echo $value['name']; ?></a></li>
            <?
        }
    }
    ?>
</ul>