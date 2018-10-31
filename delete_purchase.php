<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $purchase = find_by_id('purchases',(int)$_GET['id']);
  if(!$purchase){
    $session->msg("d","ID vacío");
    redirect('purchases.php');
  }
?>
<?php
  $delete_id = delete_by_id('purchases',(int)$purchase['id']);
  if($delete_id){
      $session->msg("s","Compra eliminada");
      redirect('purchases.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('purchases.php');
  }
?>
