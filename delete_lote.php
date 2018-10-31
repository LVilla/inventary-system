<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $lote = find_by_id('lotes',(int)$_GET['id']);
  if(!$lote){
    $session->msg("d","ID vacío");
    redirect('lotes.php');
  }
?>
<?php
  $delete_id = delete_by_id('lotes',(int)$lote['id']);
  if($delete_id){
      $session->msg("s","Lote eliminado");
      redirect('lotes.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('lotes.php');
  }
?>
