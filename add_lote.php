<?php
  $page_title = 'Agregar lote';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
?>
<?php
 if(isset($_POST['add_lote'])){
   $req_fields = array('nombre','cantidad','raza');
   validate_fields($req_fields);
   if(empty($errors)){
     $l_name  = remove_junk($db->escape($_POST['nombre']));
     $l_cant   = remove_junk($db->escape($_POST['cantidad']));
     $l_raza   = remove_junk($db->escape($_POST['raza']));
     
     $query  = "INSERT INTO lotes (";
     $query .=" nombre,cantidad,raza";
     $query .=") VALUES (";
     $query .=" '{$l_name}', '{$l_cant}', '{$l_raza}' ";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE nombre='{$l_name}'";
     if($db->query($query)){
       $session->msg('s',"Lote creado exitosamente. ");
       redirect('lotes.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_lote.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_lote.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Crear lote</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_lote.php" class="clearfix">
              <div class="form-group">
                <div class="row">
                <div class="col-md-6"><div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="nombre" placeholder="Nombre del lote"></div>
               </div></div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-list-alt"></i>
                  </span>
                  <input type="text" class="form-control" name="cantidad" placeholder="Cantidad">
               </div>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-tags"></i>
                  </span>
                  <input type="text" class="form-control" name="raza" placeholder="Raza(s)">
               </div>
                  </div>
                </div>
              </div>

              
              <button type="submit" name="add_lote" class="btn btn-danger">Guardar</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
