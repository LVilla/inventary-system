<?php
  $page_title = 'Lista de consumos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $consumos = join_consumo_table();
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
           <a href="add_consumo.php" class="btn btn-primary">Registrar consumo</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;vertical-align: middle;">#</th>
                <th class="text-center" style="width: 20%; vertical-align: middle;"> Nombre de lote</th>
                <th class="text-center" style="width: 10%;vertical-align: middle;"> Cantidad (quintales) </th>
                <th class="text-center" style="width: 30%;vertical-align: middle;"> Producto </th>
                <th class="text-center" style="width: 30%;vertical-align: middle;"> Fecha de consumo </th>
                <th class="text-center" style="width: 100px;vertical-align: middle;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($consumos as $consumo):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-left"> <?php echo remove_junk($consumo['nombre']); ?></td>
                <td class="text-center"> <?php echo remove_junk($consumo['cantidad']); ?></td>
                <td class="text-center"> <?php echo remove_junk($consumo['producto']); ?></td>
                <td class="text-center"> <?php echo remove_junk($consumo['fecha']); ?></td>

                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_consumo.php?id=<?php echo (int)$consumo['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_consumo.php?id=<?php echo (int)$consumo['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
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
