<!DOCTYPE HTML>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <title>SALGO.MX - Now</title>
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
    </head>
    <body>
        <ul>
            <?
            if (isset($promotion))
                foreach ($promotion as $row) {
                    ?>
                    <li>
                        <div>
                            <input type="hidden" name="longitude" id="lon" value="<? echo $row['longitude'] ?>" />
                            <input type="hidden" name="latitude" id="lat" value="<? echo $row['latitude'] ?>" />
                            <span><? echo 'Promocion: ' . $row['promotion']; ?></span>
                            <span><? echo 'Nombre: ' . $row['name']; ?></span>
                            <span><? echo 'Lugar: ' . $row['place']; ?></span>
                        </div>
                    </li>
                    <?
                }
            ?>
        </ul>
        <div id="map_canvas" style="width:300px; height:300px"></div>
    </body>
</html>