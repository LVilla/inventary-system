<?php
  $page_title = 'Agregar cliente';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
 if(isset($_POST['add_client'])){
   $req_fields = array('identificacion','nombres','apellidos','ciudad','direccion','telefono','email');
   validate_fields($req_fields);
   if(empty($errors)){
     $c_nombres  = remove_junk($db->escape($_POST['nombres']));
     $c_apellidos   = remove_junk($db->escape($_POST['apellidos']));
     $c_identificacion   = remove_junk($db->escape($_POST['identificacion']));
     $c_ciudad   = remove_junk($db->escape($_POST['ciudad']));
     $c_direccion   = remove_junk($db->escape($_POST['direccion']));
     $c_telefono   = remove_junk($db->escape($_POST['telefono']));
     $c_email   = remove_junk($db->escape($_POST['email']));

     $date    = make_date();
     $query  = "INSERT INTO clients (";
     $query .=" identificacion,nombres,apellidos,ciudad,direccion,telefono,email";
     $query .=") VALUES (";
     $query .=" '{$c_identificacion}','{$c_nombres}', '{$c_apellidos}','{$c_ciudad}' ,'{$c_direccion}', '{$c_telefono}','{$c_email}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE identificacion='{$c_identificacion}'";

     if($db->query($query)){
       $session->msg('s',"Cliente agregado exitosamente. ");
       redirect('clients.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_client.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_client.php',false);
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
            <span>Registrar cliente</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_client.php" class="clearfix">
              <div class="form-group">

                <div class="input-group col-md-5" >
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-credit-card"></i>
                  </span>
                  <input type="text" class="form-control" name="identificacion" placeholder="RUC/Cédula">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="nombres" placeholder="Nombres">
               </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
               </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-map-marker"></i>
                  </span>
                  <input type="text" class="form-control" name="ciudad" placeholder="Ciudad">
               </div>
                  </div>
                  <div class="col-md-8">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="direccion" placeholder="Dirección">
               </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  </span>
                  <input type="text" class="form-control" name="telefono" placeholder="Telefono/Celular">
               </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-envelope"></i>
                  </span>
                  <input type="email" class="form-control" name="email" placeholder="Correo Electrónico">
               </div>
                  </div>
                </div>
              </div>
             
             
              <div class="form-group">
              <div class="row">
                
                <div class="col-md-2"><button type="submit" name="add_client" class="btn btn-info">Guardar</button></div>
                <div class="col-md-2"><a href="clients.php" class="btn btn-danger">Cancelar</a></div>
                
         </div>
         </div>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>