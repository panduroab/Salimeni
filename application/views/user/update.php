<?php
echo form_open('user/update');
?>
<? if (isset($userAccount)) { ?>
    <? foreach ($userAccount as $row) { ?>
        <input type="hidden" name="user" value="<? echo $row['user'] ?>" />
        <label for="name">Nombre</label>
        <input type="text" name="name" value="<? echo $row['name'] ?>" size="50"/>
        <label for="lastName">Apellidos</label>
        <input type="text" name="lastName" value="<? echo $row['lastName'] ?>" size="50"/>
        <label for="email">Correo Electronico</label>
        <input type="text" name="email" value="<? echo $row['email'] ?>" size="50"/>
        <select name="type">
            <? if ($row['type'] == 'client') { ?>
                <option value="client" selected>Cliente</option>
                <option value="admin">Administrador</option>
            <? } else { ?>
                <option value="client">Cliente</option>
                <option value="admin" selected>Administrador</option>
            <? } ?>
        </select>
        <select name="status">
            <? if ($row['status'] == 'active') { ?>
                <option value="active" selected>Activo</option>
                <option value="inactive">Inactivo</option>
            <? } else { ?>                
                <option value="active">Activo</option>
                <option value="inactive" selected>Inactivo</option>
            <? } ?>
        </select>
        <div><input type="submit" value="Guardar cambios" /></div>
        </form>
    <? }
    ?>
    <?
}?>