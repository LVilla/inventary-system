<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $consumo = find_by_id('consumos',(int)$_GET['id']);
  if(!$consumo){
    $session->msg("d","ID vacío");
    redirect('consumos.php');
  }
?>
<?php
  $delete_id = delete_by_id('consumos',(int)$consumo['id']);
  if($delete_id){
      $session->msg("s","Consumo eliminado");
      redirect('consumos.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('consumos.php');
  }
?>
