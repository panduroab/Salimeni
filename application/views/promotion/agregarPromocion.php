
	<?php
	echo form_open('promotion/addPromotion');
	?>
	<label for="name">Nombre</label>
	<input type="text" name="name" value="" size="50"/>
        <label for="details">Detalles</label>
        <textarea name="details" rows="4" cols="20"></textarea>
        <label for="startAt">Inicia el</label>
        <input type="text" name="startAt" value="" />
        <label for="endsAt">Termina el</label>
        <input type="text" name="endsAt" value="" />        
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
        <label for="type">Tipo</label>
        <select name="type">
            <option value="ocacional">Ocacional</option>
            <option value="repetitivo">Repetitivo</option>
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
        
        <label for="class">Clase</label>
        <select name="class">
            <option value="event">Evento</option>
            <option value="promotion">Promocion</option>
        </select>
	<div><input type="submit" value="Submit" /></div>
</form>