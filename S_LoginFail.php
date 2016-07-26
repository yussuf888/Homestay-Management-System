<meta http-equiv="refresh" content="0; URL='Staff_Index.php'" />

<?php
if (!isset($_SESSION)) {
  session_start();
}
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	
}
?>
<?php phpAlert(   "Your username or password is wrong."   );   ?>