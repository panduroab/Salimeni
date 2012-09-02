<?php
echo form_open('user/add');
?>
<label for="name">Nombre</label>
<input type="text" name="name" value="" size="50"/>
<label for="lastName">Apellidos</label>
<input type="text" name="lastName" value="" size="50"/>
<label for="email">Correo Electronico</label>
<input type="text" name="email" value="" size="50"/>
<label for="password">Password</label>
<input type="password" name="password" value="" size="50"/>
<label for="passconf">Confirmar Password</label>
<input type="password" name="passconf" value="" size="50"/>
<select name="type">
    <option value="client" selected>Cliente</option>
    <option value="admin">Administrador</option>
</select>
<select name="status">
    <option value="active" selected>Activo</option>
    <option value="inactive">Inactivo</option>
</select>
<div><input type="submit" value="Submit" /></div>
</form>