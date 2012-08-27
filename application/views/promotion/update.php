<?php
echo form_open('promotion/update');
?>
<? isset($promotion) ?>
<? foreach ($promotion as $value) { ?>
    <label for="class">Clase</label>
    <select name="class">
        <? if ($value['class'] == 'event') { ?>
            <option value="event" selected>Evento</option>
            <option value="promotion">Promocion</option>
        <? } else { ?>
            <option value="event">Evento</option>
            <option value="promotion" selected>Promocion</option>
        <? } ?>
    </select>
    <input type="hidden" name="promotion" value="<? echo $value['promotion']; ?>" />
    <label for="name">Nombre</label>
    <input type="text" name="name" value="<? echo $value['name'] ?>" size="50"/>
    <label for="details">Detalles</label>
    <textarea name="details" rows="4" cols="20"><? echo $value['details'] ?></textarea>
    <label for="startAt">Inicia el</label>
    <input type="date" name="startAt" value="<? echo substr($value['startAt'], 0, 10); ?>" />
    <select name="startAtTime">
        <option value="<? echo substr($value['startAt'], 11); ?>"><? echo substr($value['startAt'], 11, -3); ?></option>
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
    <input type="date" name="endsAt" value="<? echo substr($value['endsAt'], 0, 10); ?>" />
    <select name="endsAtTime">
        <option value="<? echo substr($value['endsAt'], 11); ?>"><? echo substr($value['endsAt'], 11, -3); ?></option>
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
            <? foreach ($categorias as $row) { ?>
                <? if ($row['category'] == $value['category']) { ?>
                    <option value="<? echo $row['category']; ?>" selected><? echo $row['name'] ?></option>
                <? } else { ?>
                    <option value="<? echo $row['category']; ?>"><? echo $row['name'] ?></option>
                <? } ?>
            <? } ?>
        <? } ?>
    </select>
    <label for="type">Tipo</label>
    <select name="type">
        <? if ($value['type'] == 'only') { ?>
            <option value="only" selected>Ocacional</option>
            <option value="repeat">Repetitivo</option>
        <? } else { ?>
            <option value="only">Ocacional</option>
            <option value="repeat" selected>Repetitivo</option>
        <? } ?>
    </select>
    <label for="category">Dias de la semana</label>
    <input type="checkbox" name="lunes" value="0" 
           <? echo strpos($value['day'], '0') !== false ? 'checked' : ''; ?>/>
    <label for="category">Lunes</label>
    <input type="checkbox" name="martes" value="1" 
           <? echo strpos($value['day'], '1') !== false ? 'checked' : ''; ?>/>
    <label for="category">Martes</label>
    <input type="checkbox" name="miercoles" value="2" 
           <? echo strpos($value['day'], '2') !== false ? 'checked' : ''; ?>/>
    <label for="category">Miercoles</label>
    <input type="checkbox" name="jueves" value="3" 
           <? echo strpos($value['day'], '3') !== false ? 'checked' : ''; ?>/>
    <label for="category">Jueves</label>
    <input type="checkbox" name="viernes" value="4" 
           <? echo strpos($value['day'], '4') !== false ? 'checked' : ''; ?>/>
    <label for="category">Viernes</label>
    <input type="checkbox" name="sabado" value="5" 
           <? echo strpos($value['day'], '5') !== false ? 'checked' : ''; ?>/>
    <label for="category">Sabado</label>
    <input type="checkbox" name="domingo" value="6" 
           <? echo strpos($value['day'], '6') !== false ? 'checked' : ''; ?>/>
    <label for="category">Domingo</label>
    <input type="hidden" name="place" value="<? echo $value['place']; ?>" />
<? } ?>
<div><input type="submit" value="Submit" /></div>
</form>