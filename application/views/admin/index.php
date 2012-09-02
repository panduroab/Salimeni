
<ul>
    <?
    if (isset($users)) {
        foreach ($users as $value) {
            ?>
            <li><a href="<? echo base_url('user/account/' . $value['user']); ?>">
                    <?
                    echo $value['name'];
                    if ($value['user'] == $user)
                        echo' (Yo)';
                    ?></a></li>
        <? }
        ?>
        <a href="<? echo base_url('user/add'); ?>">Agregar Usuario</a><?
} else if (isset($places)) {
    foreach ($places as $value) {
        ?>
            <li><a href="<? echo base_url('place/view/' . $value['place']); ?>">
            <? echo $value['name']; ?></a></li>
        <? } ?>
        <a href="<? echo base_url('place/add'); ?>">Agregar un nuevo Lugar</a>
<? } ?>
</ul>