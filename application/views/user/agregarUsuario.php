<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Salgo - Agregar Usuario</title>
</head>
<body>
	<?php 
	echo validation_errors();
	echo form_open('user/addUser');
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
	<input type="hidden" name="type" value="client"/>
	<div><input type="submit" value="Submit" /></div>
</form>
</body>
</html>