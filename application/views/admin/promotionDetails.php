<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
    var latitude;
    var longitude;
    $(document).ready(function(){
        //Se obtienen los datos del lugar
        latitude = $('#lat').val();
        longitude = $('#lon').val();
        if(latitude != null && longitude != null){
            //Se crea el objeto myOptions con las opciones de mapa
            var latlng = new google.maps.LatLng(latitude, longitude);
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
            var marker = new google.maps.Marker({
                position: latlng, 
                map: map, 
                title:"Lugar"
            });
        }
        promotion = $('#promotion').val();
        base_url = $('#url').val();
        $('#BDeletePromotion').click(function(){
            $.ajax({
                type: 'POST',
                url: base_url+'promotion/delete',
                data: {promotion: promotion},
                success: $('#deletePromotion').modal('hide')
            }).done(function(){
                window.location.replace(base_url+'admin/')
            })
        });
    });
</script>
<?
if (isset($promotion))
    $w = 1;
foreach ($promotion as $row) {
    ?>
    <div class="row-fluid">
        <div class="span12 option-index details-place rounded">
            <input type="hidden" name="url" id="url" value="<? echo base_url() ?>"/>
            <input type="hidden" name="promotion" id="promotion" value="<? echo $row['promotion'] ?>"/>
            <input type="hidden" name="longitude" id="lon" value="<? echo $row['longitude'] ?>" />
            <input type="hidden" name="latitude" id="lat" value="<? echo $row['latitude'] ?>" />
            <div class="row-fluid">
                <div class="span7">
                    <div class="row-fluid">
                        <?
                        if (isset($images))
                            if (count($images) > 1) {
                                ?>
                                <div id="myCarousel" class="carousel slide span6">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <?
                                        $j = 0;
                                        foreach ($images as $imgrow) {
                                            ?>
                                            <div class="item <? if ($j == 0) echo "active"; ?>"><img src="<? echo base_url($imgrow['image']) ?>"/></div>
                                            <?
                                            $j++;
                                        }
                                        ?>
                                    </div>
                                    <!-- Carousel nav -->
                                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                                </div>                        
                                <script type="text/javascript">$('.carousel').carousel();</script>
                            <? }else { ?>
                                <? foreach ($images as $imgrow) {
                                    ?>
                                    <img class="span6" src="<? echo base_url($imgrow['image']) ?>"/>
                                <? } ?>
                            <? } ?>
                        <div class="pull-right hours-details">
                            <span class="badge badge-success">Inicia: <? echo substr($row['startAt'], 10, -3); ?></span>
                            <span class="badge badge-important">Termina: <? echo substr($row['endsAt'], 10, -3); ?></span>
                        </div>
                        <div class="span6">
                            <h2><? echo $row['name']; ?></h2>
                            <span class="theplace"><? echo $row['place']; ?><a href="<? echo base_url('main/lugar/' . $row['placeId'] . '/' . $row['url']); ?>"><i class="icon-exclamation-sign"></i></a></span>
                            <p><? echo $row['details']; ?></p>
                            <p>
                                <a href="<? echo base_url('promotion/update/' . $row['promotion']); ?>">Editar</a>
                                <a href="<? echo base_url('image/add/promotion/' . $row['promotion']) ?>">Agregar imagen</a>
                                <button type="button" data-toggle="modal" data-target="#deletePromotion">Eliminar promocion</button>
                            </p>
                        </div>
                    </div>
                </div>
                <div id="map_canvas" class="span5" style="height:200px"></div>
            </div>
        </div>
    </div>
    <?
    $w++;
}
?>
<div class="modal" id="deletePromotion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">¡Cuidado!</h3>
    </div>
    <div class="modal-body">¿Esta seguro que desea eliminar esta promoci&oacute;n?</div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        <button id="BDeletePromotion" class="btn btn-danger">Eliminar</button>
    </div>
</div>
<script type="text/javascript">
    $("#deletePromotion").modal()
    $('#deletePromotion').modal('hide')
</script>