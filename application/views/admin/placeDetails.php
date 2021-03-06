<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
    var latitude;
    var longitude;
    var place;
    var base_url;
    var l;
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
        place = $('#place').val();
        base_url = $('#url').val();
        $('#BDeletePlace').click(function(){
            $.ajax({
                type: 'POST',
                url: base_url+'place/delete',
                data: {place: place},
                success: $('#deletePlace').modal('hide')
            }).done(function(){
                window.location.replace(base_url+'admin/')
            })
        });
    });
</script>
<?
if (isset($place))
    foreach ($place as $row) {
        ?>
        <div class="row-fluid">
            <div class="span12 ">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#info">Info</a></li>
                    <li><a href="#mapa">Direcci&oacute;n</a></li>
                    <li><a href="#promos">Promociones</a></li>
                </ul>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12 option-index details-place rounded">
                <div class="tab-content">
                    <!-- iniciaaa info-->
                    <div class="tab-pane active" id="info">
                        <input type="hidden" name="url" id="url" value="<?echo base_url()?>"/>
                        <input type="hidden" name="place" id="place" value="<?echo $row['place']?>"/>
                        <input type="hidden" name="longitude" id="lon" value="<? echo $row['longitude'] ?>" />
                        <input type="hidden" name="latitude" id="lat" value="<? echo $row['latitude'] ?>" />
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <a href="<? echo base_url('image/add/place/' . $row['place']); ?>">Administrar Imagenes</a>
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
                                                <?
                                                foreach ($images as $imgrow) {
                                                    if ($imgrow['image'] != NULL) {
                                                        ?>
                                                        <img class="span6" src="<? echo base_url($imgrow['image']) ?>"/>
                                                    <? } ?>
                                                <? } ?>
                                            <? } ?>
                                    </div>
                                    <div class="span6">
                                        <h2><? echo $row['name']; ?></h2>
                                        <p><? echo $row['details']; ?></p>
                                        <a href="<? echo base_url('place/update/' . $row['place']); ?>">Editar lugar</a>
                                        <button type="button" data-toggle="modal" data-target="#deletePlace">Eliminar lugar</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!--- terminaa infoooo -->
                    <!-- inicia mapa--->
                    <div class="tab-pane" id="mapa">
                        <div id="map_canvas" style=" width:100%;height:200px"></div>
                        <address><?php
                                echo $row['street'];
                                echo $row['number'];
                                        ?><br />
                            <?php
                            echo $row['colony'] . ', ';
                            echo $row['zipCode'];
                            ?><br />
                            <?php echo $row['city']; ?>, <?php echo $row['state']; ?></address>
                    </div>
                    <div class="tab-pane" id="promos">
                        <ul class="list-promos">
                            <?
                            if (isset($promotions))
                                foreach ($promotions as $value) {
                                    ?>
                                    <li>
                                        <div class="pull-right hours-details">
                                            <span class="badge badge-success">Inicia: <? echo substr($value['startAt'], 10, -3); ?></span>
                                            <span class="badge badge-important">Termina: <? echo substr($value['endsAt'], 10, -3); ?></span>
                                        </div>
                                        <h3>
                                            <a href="<? echo base_url('promotion/view/' . $value['promotion'] . '/' . $value['url']); ?>"><? echo $value['name'] ?></a>
                                        </h3>
                                        <p><?php echo $value['details']; ?></p>
                                        <a href="<? echo base_url('promotion/update/' . $value['promotion'] . '/' . $value['url']); ?>">Editar</a>
                                        <a href="<? echo base_url('image/add/promotion/' . $value['promotion']); ?>">Agregar imagen a la promoci&oacute;n</a>
                                    </li>
                                <? } ?>
                            <a href="<? echo base_url('promotion/add/' . $row['place'] . '/' . $row['url']); ?>">Agregar nueva Promocion</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?
    }
?>
<div class="modal" id="deletePlace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Advertencia</h3>
    </div>
    <div class="modal-body">¿Esta seguro que desea eliminar este Lugar? Se eliminaran todos los datos relacionados a este Lugar, tales como Promociones e Imagenes.</div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        <button id="BDeletePlace" class="btn btn-danger">Eliminar</button>
    </div>
</div>
<script type="text/javascript">
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
    $("#deletePlace").modal()
    $('#deletePlace').modal('hide')
</script>
