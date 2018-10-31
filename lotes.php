<?php
  $page_title = 'Lista de lotes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $lotes = find_lotes_table();

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
           <a href="add_lote.php" class="btn btn-primary">Crear nuevo lote</a>
         </div>
        </div>
        <div class="panel-body">
            <div class="content-box">
                <?php foreach ($lotes as $lote):?>
              <div class="grid-row">
                <div class="col-md-3">
                  <div class="thumbnail">
                    <div class="caption">
                  <h3 class="text-center"><?php echo remove_junk($lote['nombre']); ?></h3>
                    <hr style="width: 80%">
                    <div class="text-center"><div style="width: 40%; display: inline-block; ">
                      <p class="text-center"><strong>Cantidad</strong></p>
                      <p class="text-center"> <?php echo remove_junk($lote['cantidad']); ?> </p>
                    </div>
                    <div style="width: 40%;display: inline-block;">
                      <p class="text-center"><strong>Raza(s)</strong></p>
                      <p class="text-center"> <?php echo remove_junk($lote['raza']); ?> </p>
                    </div>
                    </div>
                    <div class="text-center">
                    <p class="btn-group" ><a href="edit_lote.php?id=<?php echo (int)$client['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_lote.php?id=<?php echo (int)$lote['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a></p></div></div></div>
                </div>
              </div><?php endforeach; ?>
            </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>