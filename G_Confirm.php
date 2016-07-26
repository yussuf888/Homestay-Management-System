<?php require_once('Connections/MyHomeStay_System.php'); ?>

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

$colname_Recordset1 = "-1";
if (isset($_GET['email'])) {
  $colname_Recordset1 = $_GET['email'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM guest WHERE Guest_Email = %s", GetSQLValueString($colname_Recordset1, "text"));
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
  $MM_fldUserAuthorization = "Verify";
  $MM_redirectLoginSuccess = "G_Summary.php";
echo $MM_redirectLoginFailed = "<script>
alert('Your email or password is wrong.');
window.location.href='G_Confirm.php';
</script>";  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  	
  $LoginRS__query=sprintf("SELECT Guest_Email, Guest_Password, Verify FROM guest WHERE Guest_Email=%s AND Guest_Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'Verify');
    
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
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myhomestay";
$email=$_GET['email'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE Guest SET Verify='VERIFIED' WHERE Guest_Email='$email'";

if ($conn->query($sql) === TRUE) {
    "Record updated successfully";
} else {
    "Error updating record: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>VERIFICATION SUCCESS</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<body >
<div class="navbar navbar-inverse navbar-fixed-top" id="menu">
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
            <li><a href="Guest_Index.php#homestay-sec">FIND HOMESTAY</a></li>
                                 <li><a href="Guest_Index.php#register-sec">ATTRACTIONS</a></li>

            <li><a href="Guest_Index.php#aboutus-sec">ABOUT US</a></li>

</ul>
</div>
</div>
</div>
<div class="row" ></div>
<p>&nbsp;</p>
<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <h1 data-scroll-reveal="enter from the bottom after 0.3s" class="header-line">EMAIL VERIFIED</h1>
                 <p data-scroll-reveal="enter from the bottom after 0.4s">Congratulations!!! Your email has been verified successfully.</p>
                 <p data-scroll-reveal="enter from the bottom after 0.4s">Please log in to your account to continue.</p>
              <p></p>
            
            <div align="center">
            <form data-scroll-reveal="enter from the bottom after 0.5s" id="form3" name="form3" method="POST" action="<?php echo $loginFormAction; ?>" style="width:300px">
              
                <label for="txtemail"></label>
                <input name="txtemail" type="text" class="form-control form_control2" id="txtemail" placeholder="Email Address" style="margin-bottom: 10px;" />
                <label for="txtpassword"></label>
                <input type="password" name="txtpassword" class="form-control form_control2" id="txtpassword" placeholder="Password" />
                <input type="submit" style="width:300px;" name="btnSubmit" id="btnSubmit" class="btn btn-primary btn-lg buttonRegister loginbutton" value="Log In" /></form>
<p><a data-scroll-reveal="enter from the bottom after 0.6s" class="forgotp" onclick="javascript:void window.open('G_ForgotP.php','1452488152659','width=600,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=400,top=200,directories=no,location=no');return false;">Click here if forgot the password</a></p></div></div></div>
<div id="footer" style="position:absolute; bottom:0; left:0; min-height:auto; margin:auto; margin-top: 10px;">
         MOHAMED YUSSUF BIN JAHUBAR SATHIK | © 2016 SUNFLOWER HOUSE MALACCA| All Rights Reserved |  <a style="color: #fff" target="_blank"></a>
   </div>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/scrollReveal.js"></script>
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<?php
mysql_free_result($Recordset1);
?>
