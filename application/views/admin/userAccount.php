<script type="text/javascript">
    $(document).ready(function(){
        user = $('#user').val();
        base_url = $('#url').val();
        $('#BDeleteAccount').click(function(){
            $.ajax({
                type: 'POST',
                url: base_url+'user/delete',
                data: {user: user},
                success: $('#deleteAccount').modal('hide')
            }).done(function(){
                window.location.replace(base_url+'admin/')
            })
        });
    });
</script>
<div>
    <h3>Datos del usuario:</h3>
    <? if (isset($account))  ?>
    <? foreach ($account as $row) { ?>
        Nombre: <? echo $row['name'] . ' ' . $row['lastName'] ?></br>
        Correo electronico: <? echo $row['email'] ?></br>
        Tipo de cuenta: <? echo $row['type'] ?></br>
    <? } ?>
    <? if ($type == 'admin') { ?>
        <button type="button" data-toggle="modal" data-target="#deleteAccount">Eliminar cuenta</button>
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
    <input type="hidden" name="url" id="url" value="<? echo base_url() ?>"/>
    <input type="hidden" id="user" name ="user" value="<? echo $account[0]['user'] ?>"/>
    <a href="<? echo base_url('place/add/' . $account[0]['user']); ?>">Agregar lugar</a>
</div>
<div class="modal" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">¡Cuidado!</h3>
    </div>
    <div class="modal-body">¿Esta seguro que desea eliminar?</div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        <button id="BDeleteAccount" class="btn btn-danger">Eliminar</button>
    </div>
</div>
<script type="text/javascript">
    $("#deleteAccount").modal()
    $('#deleteAccount').modal('hide')
</script>