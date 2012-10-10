<div class="navbar navbar-fixed-top">
 <div class="navbar-inner">
  <div class="container">
   <div class="row-fluid">
    <div class="span12"> <a href="<? echo base_url('admin') ?>" class="brand"><img src="<? echo base_url('application/views/assets/img/salgo-blanco.png'); ?>"/></a>
     <div class="btn-group pull-right"> <a class="btn" href="#"><i class="icon-user"></i> Nombre usuario</a> <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
      <ul class="dropdown-menu">
       <?php if($type == "admin"){?><li><a href="<? echo base_url('user/add'); ?>">Agregar usuario</a></li><?php }?>
       <li><a href="<? echo base_url('user/add'); ?>">Agregar lugar</a></li>
       <li class="divider"></li>
       <li><a href="<? echo base_url('admin/logout.html') ?>">Salir</a></li>
      </ul>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
<div class="container thecontent">
