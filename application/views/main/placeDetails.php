<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
                        <input type="hidden" name="longitude" id="lon" value="<? echo $row['longitude'] ?>" />
                        <input type="hidden" name="latitude" id="lat" value="<? echo $row['latitude'] ?>" />
                        <div class="row-fluid">
                            <div class="span12">
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
                                    <div class="span6">
                                        <h2><? echo $row['name']; ?></h2>
                                        <p><? echo $row['details']; ?></p>
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
                                foreach ($promotions as $row) {
                                    ?>
                                    <li>
                                        <div class="pull-right hours-details">
                                            <span class="badge badge-success">Inicia: <? echo substr($row['startAt'], 10, -3); ?></span>
                                            <span class="badge badge-important">Termina: <? echo substr($row['endsAt'], 10, -3); ?></span>
                                        </div>
                                        <h3><a href="<?
                    /* echo base_url('main/promotionDetails.html?promotion=' . $row['promotion']); */
                    echo base_url('main/promocion/' . $row['promotion'] . '/' . $row['url']);
                                    ?>"><? echo $row['name'] ?></a></h3><p><?php echo $row['details']; ?></p></li>
                                    <? } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?
    }
?>
<script type="text/javascript">
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
</script>
