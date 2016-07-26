<meta http-equiv="refresh" content="0; URL='G_Summary.php'" />
<?php require_once('Connections/MyHomeStay_System.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

 
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

$colname_Recordset1 = "-1";
if (isset($_SESSION['ID'])) {
  $colname_Recordset1 = $_SESSION['ID'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM homestay WHERE `Homestay_ID` LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php

if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if (isset($_POST['txtemail'])) {
  $loginUsername=$_POST['txtemail'];
  $password=$_POST['txtpassword'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "G_Summary.php";
  echo $MM_redirectLoginFailed =  "G_LoginFail.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  
  $LoginRS__query=sprintf("SELECT Guest_Email, Guest_Password FROM guest WHERE Guest_Email=%s AND Guest_Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}

    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}

?>
<?php isset($_GET['ID'])?$var=mysql_escape_string($_GET['ID']):$var=$row_Recordset1['Homestay_ID'];
$_SESSION['ID']= $var;
isset($_GET['Checkin'])?$var1=mysql_escape_string($_GET['Checkin']):$var1=$_SESSION['Checkin'];
$_SESSION['Checkin']= $var1;
isset($_GET['Checkout'])?$var2=mysql_escape_string($_GET['Checkout']):$var2=$_SESSION['Checkout'];
$_SESSION['Checkout']= $var2; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login/Register</title>
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <link href="assets/css/flexslider.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />    
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
  <link href="homepage.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>

<body >
  <div class="navbar navbar-inverse navbar-fixed-top " id="menu">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <p></p>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <p></p>
        </button>
        <a class="navbar-brand" href="Guest_Index.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
      </div>
      <div class="navbar-collapse collapse move-me">
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="Guest_Index.php">HOME</a></li>
            <li><a href="Guest_Index.php#homestay-sec">HOMESTAY</a></li>
            <li><a href="Guest_Index.php#aboutus-sec">ABOUT US</a></li>
          </ul>
      </div>
    </div>
  </div>

  </div>.

  <div id="footer">MOHAMED YUSSUF BIN JAHUBAR SATHIK | @copyright 2016 MyHomeStay | All Rights Reserved |  <a href="http://binarytheme.com" style="color: #fff" target="_blank"></a>
  </div>
    
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/scrollReveal.js"></script>
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> <script>
$(function() {
      $(function() {
		        $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1});
    $( "#birthdate" ).datepicker();
  });
});
</script>
  <?php
mysql_free_result($Recordset1);
?>
