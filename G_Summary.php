<?php require_once('Connections/MyHomeStay_System.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "Guest_Index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "VERIFIED";
$MM_donotCheckaccess = "false";

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  $isValid = False; 

  if (!empty($UserName)) { 

    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 

    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "G_HomepageUnverify.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php if(!$_SESSION['MM_Username']){
   header("location:Guest_Index.php");
   die;
} ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO reservation (Reservation_ID, Homestay_ID, Guest_Email, `Date`, `Time`, Date_Checkin, Date_Checkout, Total, Checkin, Status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Reservation_ID'], "int"),
                       GetSQLValueString($_POST['Homestay_ID'], "text"),
                       GetSQLValueString($_POST['Guest_Email'], "text"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Time'], "date"),
                       GetSQLValueString($_POST['Date_Checkin'], "date"),
                       GetSQLValueString($_POST['Date_Checkout'], "date"),
                       GetSQLValueString($_POST['Total'], "double"),
                       GetSQLValueString($_POST['Checkin'], "text"),
                       GetSQLValueString($_POST['Status'], "text"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($insertSQL, $MyHomeStay_System) or die(mysql_error());

  $insertGoTo = "email_reservation.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = sprintf("SELECT * FROM guest WHERE Guest_Email = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $MyHomeStay_System) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SUMMARY</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style type="text/css">
    #apDiv2 {
	position: absolute;
	width: 200px;
	height: 115px;
	z-index: 1;
	}
    #NAMESLIP {
	position: fixed;
	width: auto;
	height: 40px;
	padding:5px;
	padding-left:15px;
	padding-right:10px;
	z-index: 5;
	right: 0px;
	top: 85px;
	background-color:#168A8F;
	font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
	color:#fff;
	-webkit-border-top-left-radius: 20px;
	-webkit-border-bottom-left-radius: 20px;
	-moz-border-radius-topleft: 20px;
	-moz-border-radius-bottomleft: 20px;
	border-top-left-radius: 20px;
	border-bottom-left-radius: 20px;
	}

    </style>
</head>
<body >
    <div id="NAMESLIP"><p>Hi, <?php echo $row_Recordset2['Guest_Name']; ?><p></div>
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
<a class="navbar-brand" href="G_Homepage.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="G_Homepage.php">HOME</a></li>
<li><a href="G_Profile.php">PROFILE</a></li>
<li><a href="G_Payment.php">PAYMENT</a></li>
<li><a href="G_History.php">HISTORY</a></li>
<li><a href="G_About.php">ABOUT US</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>


</ul>
</div>
</div>
</div>
<div class="row" ></div>
<p>&nbsp;</p>
<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <h1 data-scroll-reveal="enter from the bottom after 0.1s"  class="header-line">SUMMARY</h1>
                     
                   
                     <table data-scroll-reveal="enter from the bottom after 0.5s" width="782" height="273" border="0">
                       <tr>
                         <td height="45" colspan="7" class="reservationsummary">Reservation  Summary</td>
                       </tr>
                       <tr>
                         <td height="30" colspan="7"><div align="center">
                           <table width="747" height="190" border="0">
                             <tr>
                               <td width="120" class="roomtype">Name</td>
                               <td width="394">: <?php echo $row_Recordset2['Guest_Name']; ?></td>
                               <td width="68" class="roomtype">Date</td>
                               <td width="147">: <?php echo date("Y-m-d");?></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Email</td>
                               <td>: <?php echo $row_Recordset2['Guest_Email']; ?></td>
                               <td class="roomtype">Time</td>
                               <td>: <?php date_default_timezone_set ("Asia/Kuala_Lumpur"); echo date("H:i:s");?></td>
                             </tr>
                             <tr>
                               <td class="roomtype">IC/ Passport No</td>
                               <td>: <?php echo $row_Recordset2['Guest_IC']; ?></td>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                             </tr>
                             <tr>
                               <td class="roomtype">Phone</td>
                               <td>: <?php echo $row_Recordset2['Guest_PhoneNumber']; ?></td>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                             </tr>
                           </table>
                         </div></td>
                       </tr>
                       <tr>
                         <td height="30" colspan="7" class="reservationguest">&nbsp;</td>
                       </tr>
                     </table>
                   <p></p>
                   <div align="center">
                     <table data-scroll-reveal="enter from the bottom after 0.7s" width="701" border="0">
                       <tr>
                         <td width="394" height="45" class="roomtype">Homestay  Type</td>
                         <td width="118" class="roomtype">Checkin</td>
                         <td width="118" class="roomtype">Checkout</td>
                         <td width="123" class="roomtype">Rate per/night</td>
                       </tr>
                       <tr>
                         <td class="descriptiontable" height="32"><?php echo $row_Recordset1['Description'] ?></td>
                         <td class="descriptiontable"><?php echo $var1=$_SESSION["Checkin"];?></td>
                         <td class="descriptiontable"><?php echo $var2=$_SESSION["Checkout"];?></td>
                         <td class="descriptiontable">RM <?php echo $row_Recordset1['Price']; ?></td>
                       </tr>
                       <tr>
                         <td rowspan="3"><div>
                           <h5 class= "roomtype">&nbsp;</h5>
                         </div></td>
                         <td height="37">&nbsp;</td>
                         <td class="roomtype">Days</td>
                         <td class="roomtype">: <?php $a = new Datetime($_SESSION["Checkin"]);
$b = new Datetime($_SESSION["Checkout"]);
$interval = $a->diff($b); echo $interval->format("%D");?></td>
                       </tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td class="roomtype">GST (6%)</td>
                         <td class="roomtype">: RM <?php $x = $interval->format("%D"); 
$y = $row_Recordset1['Price'];
$g = ($x * $y)*0.06; echo number_format($g, 2);  ?></td>
                       </tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td class="roomtype">Total</td>
                         <td class="roomtype">: RM <?php $x = $interval->format("%D"); 
$y = $row_Recordset1['Price'];
$z = ($x * $y)+$g; $c=number_format($z,2); echo $c; ?></td>
                       </tr>
                         <td height="40" colspan="4"><form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                           <table width="769" border="0">
                            
                             <tr>
                             <td width="27" height="99"><input type="hidden" name="Reservation_ID" value="<?php echo $vercode = rand(10000000,99999999)?>" size="32"></td>
                                 <td width="27" height="99"><input type="hidden" name="Homestay_ID" value="<?php echo $row_Recordset1['Homestay_ID']; ?>" size="32"></td>
                               <td width="27"><input type="hidden" name="Guest_Email" value="<?php echo $row_Recordset2['Guest_Email']; ?>" size="32"></td>
                                 <td width="27"><input type="hidden" name="Date" value="<?php echo date("Y-m-d");?>" size="32"></td>
                                 <td width="27"><input type="hidden" name="Time" value="<?php date_default_timezone_set ("Asia/Kuala_Lumpur"); echo date("H:i:s");?>" size="32"></td>
                                 <td width="27"><input type="hidden" name="Date_Checkin" value="<?php echo $var1=$_SESSION["Checkin"];?>" size="32"></td>
                                 <td width="263"><input type="hidden" name="Date_Checkout" value="<?php echo $var2=$_SESSION["Checkout"];?>" size="32">
                                 <input type="hidden" name="Total" value="<?php $x = $interval->format("%D"); 
$y = $row_Recordset1['Price'];
$z = ($x * $y)+$g; echo $z; ?>" size="32"></td>
                                 <td width="24"><input type="hidden" name="Checkin" value="NO" size="32"></td>
                                 <td width="28"><input type="hidden" name="Status" value="UNPAID" size="32"></td>
                                 <td width="300"><div align="center">
                                  <p></p> <p><a  href="termscondition.php" onclick="javascript:void window.open('termscondition.php','1452488152659','width=400,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=1000,top=200,directories=no,location=no');return false;">Click here to read the terms and conditions</a></p>                                   <input type="checkbox" class="checkboxmargin" name="checkbox" id="checkbox">
I accept the terms and conditions</div>
                                   <div align="center">
                                     <input type="submit" class="btn btn-primary btn-lg confirmbooksummary" value="Confirm &amp; Book" id="button" disabled>
                                </div></td>
                             </tr>
                           </table>
                             <input type="hidden" name="MM_insert" value="form1">
                           </form>
                           <div></div></td>
                       </tr>
                     </table>
                   </div>
                   <p data-scroll-reveal="enter from the bottom after 0.2s"></p>
                   <p data-scroll-reveal="enter from the bottom after 0.2s">&nbsp;</p>
               </div>
               <div id="apDiv2"></div>

             </div>


           <div class="row" ></div>
             </div>
  


<div id="footer">
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
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
$(function() {
      $(function() {
		        $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1});
    $( "#birthdate" ).datepicker();
  });
});
jQuery(document).ready(function() { jQuery("#checkbox").click(function(){ if(jQuery("#button").is(":enabled")) { jQuery("#button").prop("disabled",true); } else { jQuery("#button").prop("disabled",false); } }); } );
</script>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
