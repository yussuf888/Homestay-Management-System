<?php require_once('Connections/MyHomeStay_System.php'); ?>
<?php
echo $id=$_GET['ID']; 
$con=mysqli_connect("localhost","root","","myhomestay");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="Insert into unpaid_reservation 
        Select * from reservation WHERE Reservation_ID=$id";
mysqli_query($con,$sql); 

$query = "SELECT Reservation_ID FROM unpaid_reservation";
$result = mysqli_query($con,$query);

?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
if ((isset($_GET['ID'])) && ($_GET['ID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM reservation WHERE Reservation_ID=%s",
                       GetSQLValueString($_GET['ID'], "int"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($deleteSQL, $MyHomeStay_System) or die(mysql_error());

  $deleteGoTo = "S_FDHomepage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	
}
?>
<?php phpAlert(   "Have succesfully delete."   );   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>