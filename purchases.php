<?php
  $page_title = 'Lista de compras';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $purchases = find_purchase_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_purchase.php" class="btn btn-primary">Agregar compra</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center"> Proveedor </th>
                <th class="text-center"> Nro. de Factura </th>
                <th class="text-center"> Descripción </th>
                <th class="text-center" style="width: 10%;"> Fecha de compra </th>
                <th class="text-center" style="width: 10%;"> Precio </th>
                <th class="text-center" style="width: 10%;"> Visualizar </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($purchases as $purchase):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($purchase['proveedor']); ?></td>
                <td class="text-center"> <?php echo remove_junk($purchase['n_fact']); ?></td>
                <td class="text-center"> <?php echo remove_junk($purchase['description']); ?></td>
                <td class="text-center"> <?php echo remove_junk($purchase['date']); ?></td>
                <td class="text-center">$ <?php echo remove_junk($purchase['price']); ?></td>

                <td class="text-center"><a href=""><img  style="width: 27px;" src="uploads/icons/pdf.png"></a></td>
                
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_purchase.php?id=<?php echo (int)$purchase['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_purchase.php?id=<?php echo (int)$purchase['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
