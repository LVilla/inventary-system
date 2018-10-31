<?php
  $page_title = 'Agregar consumo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_lotes = find_all('lotes');
  $all_products = find_all('products');
?>
<?php
 if(isset($_POST['add_consumo'])){
   $req_fields = array('nombre_lote','cantidad','producto','fecha');
   validate_fields($req_fields);
   if(empty($errors)){
     $c_lote  = remove_junk($db->escape($_POST['nombre_lote']));
     $c_cantidad   = remove_junk($db->escape($_POST['cantidad']));
     $c_producto   = remove_junk($db->escape($_POST['producto']));
     $c_fecha   = remove_junk($db->escape($_POST['fecha']));
     
     $query  = "INSERT INTO consumos (";
     $query .=" id_lote,cantidad,product_id,fecha";
     $query .=") VALUES (";
     $query .=" '{$c_lote}', '{$c_cantidad}', '{$c_producto}', '{$c_fecha}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Consumo agregado exitosamente. ");
       redirect('consumos.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_consumo.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_consumo.php',false);
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
            <span>Registrar consumo</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_consumo.php" class="clearfix">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-5">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="cantidad" placeholder="Cantidad (en quintales)">
               </div>
                  </div>
                  <div class="col-md-5">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-calendar"></i>
                  </span>
                  <input type="date" class="form-control" name="fecha" placeholder="Fecha de consumo">
               </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">

                  <div class="col-md-5">
                    <select class="form-control" name="nombre_lote">
                      <option value="">Selecciona un lote </option>
                    <?php  foreach ($all_lotes as $lote): ?>
                      <option value="<?php echo (int)$lote['id'] ?>">
                        <?php echo $lote['nombre'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-5">
                    <select class="form-control selectpicker" name="producto" data-style="btn-primary">
                      <option value="">Selecciona un producto</option>
                    <?php  foreach ($all_products as $producto): ?>
                      <option value="<?php echo (int)$producto['id'] ?>">
                        <?php echo $producto['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              
              <button type="submit" name="add_consumo" class="btn btn-danger">Guardar consumo</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
