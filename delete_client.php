<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $client = find_by_id('clients',(int)$_GET['id']);
  if(!$client){
    $session->msg("d","ID vacío");
    redirect('clients.php');
  }
?>
<?php
  $delete_id = delete_by_id('clients',(int)$client['id']);
  if($delete_id){
      $session->msg("s","Cliente eliminado");
      redirect('clients.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('clients.php');
  }
?>
