<meta http-equiv="refresh" content="0; URL='Guest_Index.php'" />

<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
  
}

phpAlert(   "The feedback have been sent successfully."   ); 
?>