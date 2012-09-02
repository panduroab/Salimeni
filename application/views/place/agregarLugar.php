<?php
echo form_open('place/add');
?>
<label for="name">Nombre</label>
<input type="text" name="name" value="" size="50"/>
<label for="details">Detalles</label>
<textarea name="details" rows="4" cols="20"></textarea>
<label for="adresse">Pais</label>
<input type="text" name="country" value="" size="50"/>
<label for="adresse">Estado</label>
<input type="text" name="state" value="" size="50"/>
<label for="adresse">Ciudad</label>
<input type="text" name="city" value="" size="50"/>
<label for="adresse">Colonia</label>
<input type="text" name="colony" value="" size="50"/>
<label for="adresse">Codigo postal</label>
<input type="text" name="zipCode" value="" size="50"/>
<label for="adresse">Calle</label>
<input type="text" name="street" value="" size="50"/>
<label for="adresse">Numero</label>
<input type="text" name="number" value="" size="50"/>
<label for="latitude">Latitud</label>
<input type="text" name="latitude" value="" size="50"/>
<label for="longitude">Longitud</label>
<input type="text" name="longitude" value="" size="50"/>
<? if (isset($categorias)) { ?>
    <select name="category">
        <? foreach ($categorias as $row) { ?>
            <option value="<? echo $row['category'] ?>"><? echo $row['name'] ?></option>
        <? } ?>
    </select>
<? } ?>
<input type="hidden" name="user" value="<? echo $userAdd; ?>"/>
<div><input type="submit" value="Submit" /></div>
</form>