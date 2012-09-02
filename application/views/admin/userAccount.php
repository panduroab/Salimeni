<div>
    <h3>Datos del usuario:</h3>
    <? if (isset($account))  ?>
    <? foreach ($account as $row) { ?>
        Nombre: <? echo $row['name'] . ' ' . $row['lastName'] ?></br>
        Correo electronico: <? echo $row['email'] ?></br>
        Tipo de cuenta: <? echo $row['type'] ?></br>
    <? } ?>
</div></br>
<div>
    <h3>Lugares del usuario</h3>
    <ul>
        <? if (isset($places))  ?>
        <? foreach ($places as $row) { ?>
            <li>
                <a href="<? echo base_url('place/view/' . $row['place'] . '/' . $row['url']); ?>">
                    <? echo $row['name'] ?></a>
            </li>
        <? } ?>
    </ul>
    <a href="<? echo base_url('place/add/' . $account[0]['user']); ?>">Agregar lugar</a>
</div>