<script type="text/javascript">
    $('document').ready(function(e){
        var idImage;
        var base_url;
        base_url = $('#url').val();
        $('button.delImage').live('click',function(e){
            idImage = $(this).val();
        });
        $('#BDeleteImage').live('click',function(){
            $.ajax({
                type: 'POST',
                url: base_url+'image/delete',
                data: {image: idImage},
                success: $('#deleteImage').modal('hide')
            }).done(function(){
                location.reload();
            })
        });
    });
</script>
<form action="<? echo base_url('image/add'); ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="width" value="384" />
    <label>Imagen</label>
    <input type="file" name="photoimg" id="photoimg" />
    <input type="hidden" name="tableItem" value="<? echo $tableItem; ?>" />
    <input type="hidden" name="item" value="<? echo $item; ?>" /></br></br>
    <input type="submit" value="Guardar" />
</form>
<div class="container-fluid">
    <ul class="row-fluid">
        <input type="hidden" value="<? echo base_url() ?>" id="url" name="url"/>
        <? $id = 0; ?>
        <? if ($images != NULL) { ?>
            <? foreach ($images as $row) { ?>
                <? $id++; ?>
                <li class="span3">
                    <div class="container-fluid option-index">
                        <img src="<? echo base_url($row['image']); ?>">
                        <button class="delImage" id="delImage" value="<? echo $row['id']; ?>" data-toggle="modal" 
                                data-target="#deleteImage" >Eliminar</button>
                    </div>
                </li>
            <? } ?>
        <? } else { ?>
            <h2>Aun no ha agregado imagenes.</h2>
        <? } ?>
    </ul>
</div>
<div class="modal" id="deleteImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Advertencia</h3>
    </div>
    <div class="modal-body">¿Esta seguro que desea eliminar esta Imagen?</div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <button id="BDeleteImage" class="btn btn-danger">Eliminar</button>
    </div>
</div>
<script type="text/javascript">
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
    $("#deleteImage").modal()
    $('#deleteImage').modal('hide')
</script>