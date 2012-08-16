<article class="menuAlphabet">
    <form id="searchBox">
        <!--<input type="text" class="search" id="searchbox" /><br />-->
        <!--<input type="search" class="inputSearch" id="inputSearch" name="inputSearch" placeholder="Nombre a buscar..." />-->
        <input type="text" class="search" id="searchbox" name="inputSearch" placeholder="Nombre a buscar..." />
        <button type="submit" id="btnSearch" name="btnSearch"><i>Buscar</i></button>
    </form>
    <div id="display"></div>
</article>
<div class="row-fluid">
    <ul class="no-margin">
        <?
        $i = 1;
        if (isset($places)) {
            foreach ($places as $row) {
                if ($i == 1)
                    echo '<div class="row-fluid">';
                ?>
                <li class="span4 option-index rounded list-places">
                    <div class="row-fluid">
                        <div class="span7">
                            <a href="<? echo base_url('main/lugar/' . $row['place'] . '/' . $row['url']); ?>">
                                <h3><? echo $row['name']; ?></h3>
                                <p><? echo $row['details']; ?></p>
                                <address><?php echo $row['street']; ?> <?php echo $row['number']; ?> <br /> <?php echo $row['colony']; ?>, <?php echo $row['zipCode']; ?><br /><?php echo $row['city']; ?>, <?php echo $row['state']; ?></address>                    
                            </a> 
                        </div>
                    </div>
                </li>
                <?
                if ($i == 3) {
                    echo '</div>';
                    $i = 0;
                }
                $i++;
            }
        }
        ?>
    </ul>
</div>
<script type="text/javascript">
    var base_url = window.location.hostname;
    $document.ready(function(){
        $('.indexAlphabet').hide();
        $('#btnDoIndex').bind('click', doIndex);
        //Se busca con el evento keyup de input text name="search"
        $('.search').keyup(function(){
            //Se toman los valores del input
            var searchbox = $('this').val();
            var dataString = 'searchword='+searchbox;//falta agregar la categoria
            //Si el input esta vacio se limpia el div display
            if(searchbox == ''){
                $('#display').hide();
            }else{
                //Si el input tiene algo se ejecuta la busqueda por ajax
                $.ajax({
                    type: "POST", //Manda los datos la funcion por POST
                    url: "http://salgo.iasis.com.mx/main/search/place", //Funcion que recibe
                    data: dataString, //Datos enviados
                    dataType: 'jsonp',
                    //jsonp: 'jsoncallback',
                    cache: false,
                    //success: function(html){
                    //  $("#display").html(html).show();
                    //} //Funcion que se ejecuta cuando los datos son recibidos
                    success: function(data, status){
                        $.each(data, function(i,item){
                            var html = '<h1>'+item.name+'</h1>'
                                + '<p>'+item.latitude+'<br>'
                                + item.longitude+'</p>';
                            //output.append(landmark);
                            $("#display").html(html).show();
                        });
                    }

                });
            }
            return false;
        });
    });
</script>