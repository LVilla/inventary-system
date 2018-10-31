<?php
  $page_title = 'Agregar compra';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
 if(isset($_POST['add_purchase'])){
   $req_fields = array('n_fact','purchase-description','date','price');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_n_fact  = remove_junk($db->escape($_POST['n_fact']));
     $p_description   = remove_junk($db->escape($_POST['purchase-description']));
     $p_date   = remove_junk($db->escape($_POST['date']));
     $p_price   = remove_junk($db->escape($_POST['price']));
     
     $date    = make_date();
     $query  = "INSERT INTO purchases (";
     $query .=" n_fact,description,date,price";
     $query .=") VALUES (";
     $query .=" '{$p_n_fact}', '{$p_description}', '{$p_date}', '{$p_price}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE n_fact='{$p_n_fact}'";
     if($db->query($query)){
       $session->msg('s',"Compra agregada exitosamente. ");
       redirect('add_purchase.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('purchases.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_purchase.php',false);
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
            <span>Agregar compra</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_purchase.php" class="clearfix">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="n_fact" placeholder="Número de factura">
               </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-calendar"></i>
                  </span>
                  <input type="date" class="form-control" name="date" placeholder="Fecha de compra">
               </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-align-left"></i>
                  </span>
                  <input type="text" class="form-control" name="purchase-description" placeholder="Descripción">
               </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number" class="form-control" name="price" placeholder="Precio de compra">
                  </div>
                  </div>
                  <div class="col-md-8">
                    <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-file"></i>
                     </span>
                     <input type="file" class="form-control" name="buying-price" placeholder="Precio de compra">
                  </div>
                  </div>
                </div>
              </div>
             
              <button type="submit" name="add_purchase" class="btn btn-danger">Guardar</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>