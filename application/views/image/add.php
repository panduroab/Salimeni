<form action="<? echo base_url('image/add'); ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="width" value="384" />
    <label>Imagen</label>
    <input type="file" name="photoimg" id="photoimg" />
    <input type="hidden" name="tableItem" value="<? echo $tableItem; ?>" />
    <input type="hidden" name="item" value="<? echo $item; ?>" /></br></br>
    <input type="submit" value="Guardar" />
</form>