<meta http-equiv="refresh" content="0; URL='S_FDHomepage.php'" />

<?php
if (!isset($_SESSION)) {
  session_start();
}
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	
}
?>
<?php phpAlert(   "Successfully update."   );   ?>