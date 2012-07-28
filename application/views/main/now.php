<!DOCTYPE HTML>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <title>SALGO.MX - Now</title>
        <script type="text/javascript" src="<?echo base_url('application/views/assets/js/jquery-1.7.2.min.js')?>"></script>
        <script type="text/javascript">
        var base_url;
        var places;
        $(document).ready(function(){
            base_url = $(location).attr('href');
            function dataRequest(){
                places = $('#places').text('Cargando informacion...');
                $.ajax({
                    url: base_url,
                    dataType: 'jsonp',
                    jsonp: 'jsoncallback',
                    success: function(data, status){
                        places.empty();
                        $.each(data, function(i, item){
                            var mostrar = '<span> Promocion: '+ item.promotion +'</span>'+
                            '<span>Nombre: '+ item.name +'</span>'+
                            '<span>Lugar: ' + item.place+'</span>'
                            places.append(mostrar);
                        });
                    },
                    error: function(){
                        places.text('There was an error loading the data.');
                    }
                });
            }
            dataRequest();
        });
        </script>
    </head>
    <body>
        <ul>
            <?
            foreach ($promotion as $row) {
                ?>
                <li>
                    <div>
                        <span><? echo 'Promocion: ' . $row['promotion']; ?></span>
                        <span><? echo 'Nombre: ' . $row['name']; ?></span>
                        <span><? echo 'Lugar: ' . $row['place']; ?></span>
                    </div>
                </li>
                <?
            }
            ?>
        </ul>
    </body>
</html>