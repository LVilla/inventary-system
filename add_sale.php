<?php
  $page_title = 'Agregar venta';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('s_id','quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,qty,price,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Venta agregada ");
                  redirect('add_sale.php', false);
                } else {
                  $session->msg('d','Lo siento, registro falló.');
                  redirect('add_sale.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_sale.php',false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Búsqueda</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Buscar por el nombre del producto">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <span>Información del cliente</span><input type="submit" class="btn btn-success pull-right" name="add_client.php" value="Nuevo" action="add_client.php">
      </div>
      <div class="panel-body">
        <div class="form-group">
          <div class="row">
              <div class="col-md-3">
                <div class="input-group">
                  <label style="margin-top: 5px;">Identificación: </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="input-group">
                 <input type="text" class="form-control" onkeypress="return pulsar(event)" placeholder="Ingrese RUC/Cédula" name="identificacion" id="cedula">
                 <span class="input-group-btn">
                  <button class="btn btn-default" type="button" onclick="buscarCedulaCliente()"><i class="glyphicon glyphicon-search"></i> </button>
                 </span>
               </div>
              </div>
            </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
                <div class="input-group">
                  <label style="">Nombres Completos: </label>
                </div>
              </div>
              <div class="col-md-7">
                <div class="input-group">
                 <input type="text" class="form-control" placeholder="">
               </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <span>Datos de Factura</span>
      </div>
      <div class="panel-body">
        <div class="row">
          <div></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Registrar venta</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <label class="btn btn-primary">Identificación:</label>
            </span>
            <input type="text" id="sug_input" class="form-control" name="nombres"  placeholder="Buscar por el nombre del producto">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
        <form method="post" action="add_sale.php">
          <div class="input-group">
            <label> Indentificación: </label>
            <input type="text" name="identificacion" placeholder="Ingrese el RUC/Cédula">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <div class="input-group">
                 <label><strong> Indentificación: </strong></label>
                 <input type="text" class="form-control" name="identificacion" placeholder="Ingrese el RUC/Cédula">
               </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-5">
                <div class="input-group">
                 <label><strong> Nombres: </strong></label>
                 <input type="text" class="form-control" name="nombres" placeholder="Ingrese los nombres">
               </div>
              </div>
              <div class="col-md-5">
                <div class="input-group">
                 <label><strong> Apellidos: </strong></label>
                 <input type="text" class="form-control" name="apellidos" placeholder="Ingrese los apellidos">
               </div>
              </div>
            </div>
          </div>
         <table class="table table-bordered">
           <thead>
            <th> Producto </th>
            <th> Precio </th>
            <th> Cantidad </th>
            <th> Total </th>
            <th> Agregado</th>
            <th> Acciones</th>
           </thead>
             <tbody  id="product_info"> </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
