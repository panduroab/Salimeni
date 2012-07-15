<!DOCTYPE HTML>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <title>Salgo - Agregar Lugar</title>
    </head>
    <body>
        <?php
        echo form_open('place/addPlace');
        ?>
        <label for="name">Nombre</label>
        <input type="text" name="name" value="" size="50"/>
        <label for="details">Detalles</label>
        <textarea name="details" rows="4" cols="20"></textarea>
        <label for="adresse">Direccion</label>
        <textarea name="adresse" rows="4" cols="20"></textarea>
        <label for="latitude">Latitud</label>
        <input type="text" name="latitude" value="" size="50"/>
        <label for="longitude">Longitud</label>
        <input type="text" name="longitude" value="" size="50"/>
        <label for="category">Categoria</label>
        <input type="checkbox" name="bar" value="Bar" />
        <label for="category">Bar</label>
        <input type="checkbox" name="restaurant" value="Restaurant" />
        <label for="category">Restaurant</label>
        <input type="checkbox" name="antro" value="Antro" />
        <label for="category">Antro</label>
        <input type="checkbox" name="culture" value="Cultura" />
        <label for="category">Cultura</label>
        <input type="checkbox" name="sport" value="Deporte" />
        <label for="category">Deporte</label>
        <input type="hidden" name="user" value="<? echo $user; ?>"/>
        <div><input type="submit" value="Submit" /></div>
    </form>
</body>
</html>