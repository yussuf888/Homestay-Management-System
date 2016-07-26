<meta http-equiv="refresh" content="0; URL='G_RLogin.php'" />

<?php
if (!isset($_SESSION)) {
  session_start();
}
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	
}
?>
<?php phpAlert(   "Your email or password is wrong."   );   ?>