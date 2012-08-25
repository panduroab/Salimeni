
<?php
echo form_open('promotion/addPromotion');
?>
<label for="class">Clase</label>
<select name="class">
    <option value="event">Evento</option>
    <option value="promotion">Promocion</option>
</select>
<label for="name">Nombre</label>
<input type="text" name="name" value="" size="50"/>
<label for="details">Detalles</label>
<textarea name="details" rows="4" cols="20"></textarea>
<label for="startAt">Inicia el</label>
<input type="date" name="startAt" value="" />
<select name="startAtTime">
    <option value="12:00:00">12:00</option>
    <option value="12:30:00">12:30</option>
    <option value="13:00:00">13:00</option>
    <option value="13:30:00">13:30</option>
    <option value="14:00:00">14:00</option>
    <option value="14:30:00">14:30</option>
    <option value="15:00:00">15:00</option>
    <option value="15:30:00">15:30</option>
    <option value="16:00:00">16:00</option>
    <option value="16:30:00">16:30</option>
    <option value="17:00:00">17:00</option>
    <option value="17:30:00">17:30</option>
    <option value="18:00:00">18:00</option>
    <option value="18:30:00">18:30</option>
    <option value="19:00:00">19:00</option>
    <option value="19:30:00">19:30</option>
    <option value="20:00:00">20:00</option>
    <option value="20:30:00">20:30</option>
    <option value="21:00:00">21:00</option>
    <option value="21:30:00">21:30</option>
    <option value="22:00:00">22:00</option>
    <option value="22:30:00">22:30</option>
    <option value="23:00:00">23:00</option>
    <option value="23:30:00">23:30</option>
    <option value="00:00:00">00:30</option>
    <option value="00:30:00">00:30</option>
    <option value="01:00:00">01:00</option>
    <option value="01:30:00">01:30</option>
    <option value="02:00:00">02:00</option>
    <option value="02:30:00">02:30</option>
    <option value="03:00:00">03:00</option>
    <option value="03:30:00">03:30</option>
    <option value="04:00:00">04:00</option>
    <option value="04:30:00">04:30</option>
    <option value="05:00:00">05:00</option>
    <option value="05:30:00">05:30</option>
    <option value="06:00:00">06:00</option>
    <option value="06:30:00">06:30</option>
    <option value="07:00:00">07:00</option>
    <option value="07:30:00">07:30</option>
    <option value="08:00:00">08:00</option>
    <option value="08:30:00">08:30</option>
    <option value="09:00:00">09:00</option>
    <option value="09:30:00">09:30</option>
    <option value="10:00:00">10:00</option>
    <option value="10:30:00">10:30</option>
    <option value="11:00:00">11:00</option>
    <option value="11:30:00">11:30</option>
</select>
<label for="endsAt">Termina el</label>
<input type="date" name="endsAt" value="" />
<select name="endsAtTime">
    <option value="12:00:00">12:00</option>
    <option value="12:30:00">12:30</option>
    <option value="13:00:00">13:00</option>
    <option value="13:30:00">13:30</option>
    <option value="14:00:00">14:00</option>
    <option value="14:30:00">14:30</option>
    <option value="15:00:00">15:00</option>
    <option value="15:30:00">15:30</option>
    <option value="16:00:00">16:00</option>
    <option value="16:30:00">16:30</option>
    <option value="17:00:00">17:00</option>
    <option value="17:30:00">17:30</option>
    <option value="18:00:00">18:00</option>
    <option value="18:30:00">18:30</option>
    <option value="19:00:00">19:00</option>
    <option value="19:30:00">19:30</option>
    <option value="20:00:00">20:00</option>
    <option value="20:30:00">20:30</option>
    <option value="21:00:00">21:00</option>
    <option value="21:30:00">21:30</option>
    <option value="22:00:00">22:00</option>
    <option value="22:30:00">22:30</option>
    <option value="23:00:00">23:00</option>
    <option value="23:30:00">23:30</option>
    <option value="00:00:00">00:30</option>
    <option value="00:30:00">00:30</option>
    <option value="01:00:00">01:00</option>
    <option value="01:30:00">01:30</option>
    <option value="02:00:00">02:00</option>
    <option value="02:30:00">02:30</option>
    <option value="03:00:00">03:00</option>
    <option value="03:30:00">03:30</option>
    <option value="04:00:00">04:00</option>
    <option value="04:30:00">04:30</option>
    <option value="05:00:00">05:00</option>
    <option value="05:30:00">05:30</option>
    <option value="06:00:00">06:00</option>
    <option value="06:30:00">06:30</option>
    <option value="07:00:00">07:00</option>
    <option value="07:30:00">07:30</option>
    <option value="08:00:00">08:00</option>
    <option value="08:30:00">08:30</option>
    <option value="09:00:00">09:00</option>
    <option value="09:30:00">09:30</option>
    <option value="10:00:00">10:00</option>
    <option value="10:30:00">10:30</option>
    <option value="11:00:00">11:00</option>
    <option value="11:30:00">11:30</option>
</select>
<label for="category">Categoria</label>
<select name="category">
    <? if (!is_null($categorias)) { ?>
        <? foreach ($categorias as $value) { ?>
            <option value="<? echo $value['category']; ?>"><? echo $value['name'] ?></option>
        <? } ?>
    <? } ?>
</select>

<label for="type">Tipo</label>
<select name="type">
    <option value="only">Ocacional</option>
    <option value="repeat">Repetitivo</option>
</select>

<label for="category">Dias de la semana</label>
<input type="checkbox" name="lunes" value="lunes" />
<label for="category">Lunes</label>
<input type="checkbox" name="martes" value="martes" />
<label for="category">Martes</label>
<input type="checkbox" name="miercoles" value="miercoles" />
<label for="category">Miercoles</label>
<input type="checkbox" name="jueves" value="jueves" />
<label for="category">Jueves</label>
<input type="checkbox" name="viernes" value="viernes" />
<label for="category">Viernes</label>
<input type="checkbox" name="sabado" value="sabado" />
<label for="category">Sabado</label>
<input type="checkbox" name="domingo" value="domingo" />
<label for="category">Domingo</label>
<input type="hidden" name="place" value="<? echo $place; ?>" />
<div><input type="submit" value="Submit" /></div>
</form>