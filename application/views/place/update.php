<?php
echo form_open('place/update');
?>
<? if (isset($place))  ?>
<? foreach ($place as $value) { ?>
    <input type="hidden" name="place" value="<? echo $value['place']; ?>"/>
    <label for="name">Nombre</label>
    <input type="text" name="name" value="<? echo $value['name'] ?>" size="50"/>
    <label for="details">Detalles</label>
    <textarea name="details" rows="4" cols="20"><? echo $value['details'] ?></textarea>
    <label for="adresse">Pais</label>
    <input type="text" name="country" value="<? echo $value['country'] ?>" size="50"/>
    <label for="adresse">Estado</label>
    <input type="text" name="state" value="<? echo $value['state'] ?>" size="50"/>
    <label for="adresse">Ciudad</label>
    <input type="text" name="city" value="<? echo $value['city'] ?>" size="50"/>
    <label for="adresse">Colonia</label>
    <input type="text" name="colony" value="<? echo $value['colony'] ?>" size="50"/>
    <label for="adresse">Codigo postal</label>
    <input type="text" name="zipCode" value="<? echo $value['zipCode'] ?>" size="50"/>
    <label for="adresse">Calle</label>
    <input type="text" name="street" value="<? echo $value['street'] ?>" size="50"/>
    <label for="adresse">Numero</label>
    <input type="text" name="number" value="<? echo $value['number'] ?>" size="50"/>
    <label for="latitude">Latitud</label>
    <input type="text" name="latitude" value="<? echo $value['latitude'] ?>" size="50"/>
    <label for="longitude">Longitud</label>
    <input type="text" name="longitude" value="<? echo $value['longitude'] ?>" size="50"/>
    <? if (isset($categorias)) { ?>
        <select name="category">
            <? foreach ($categorias as $row) { ?>
                <? if ($row['category'] == $value['category']) { ?>
                    <option value="<? echo $row['category'] ?>" selected><? echo $row['name'] ?></option>
                <? } else { ?>
                    <option value="<? echo $row['category'] ?>"><? echo $row['name'] ?></option>
                <? } ?>
            <? } ?>
        </select>
    <? } ?>
<? } ?>
<div><input type="submit" value="Submit" /></div>
</form>