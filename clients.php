<?php
  $page_title = 'Lista de clientes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $clients = find_clients_table();
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
           <a href="add_client.php" class="btn btn-primary">Registrar nuevo cliente</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 10%;"> Identificación </th>
                <th class="text-center" style="width: 10%;"> Nombres </th>
                <th class="text-center" style="width: 10%;"> Apellidos </th>
                <th class="text-center" style="width: 10%;"> Ciudad </th>
                <th class="text-center" style="width: 20%"> Dirección </th>
                <th class="text-center" style="width: 10%;"> Teléfono </th>
                <th class="text-center" style="width: 10%;"> Correo </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($clients as $client):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($client['identificacion']); ?></td>
                <td class="text-center"> <?php echo remove_junk($client['nombres']); ?></td>
                <td class="text-center"> <?php echo remove_junk($client['apellidos']); ?></td>
                <td class="text-center"> <?php echo remove_junk($client['ciudad']); ?></td>
                <td class="text-center"> <?php echo remove_junk($client['direccion']); ?></td>
                <td class="text-center"> <?php echo remove_junk($client['telefono']); ?></td>
                <td class="text-center"> <?php echo remove_junk($client['email']); ?></td>
                
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_client.php?id=<?php echo (int)$client['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_client.php?id=<?php echo (int)$client['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
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
