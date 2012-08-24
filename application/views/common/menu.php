<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <a href="<?echo base_url()?>" class="brand"><img src="<? echo base_url('application/views/assets/img/salgo-blanco.png'); ?>"/></a>
                    <ul class="nav">
                        <li><a href="#" class="dropdown-toggle" >Categorías <i class="icon-chevron-down icon-white"></i></a>
                            <ul class="dropdown-menu">
                                <? foreach ($category as $row) { ?>
                                <li><a href="<?echo base_url('main/places.html?category='.$row['category'])?>">
                                        <? echo $row['name'] ?>
                                        </a></li>
                                <? } ?>
                                <li class="divider"></li>
                                <li><a href="<?echo base_url('main/places.html')?>">Ver todos</a></li>
                            </ul>                    
                        </li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </div>
            </div>		
        </div>
    </div>
</div>
<div class="container thecontent">
