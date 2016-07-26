<?php require_once('Connections/MyHomeStay_System.php'); ?>
<?php require_once('Connections/MyHomeStay_System.php'); ?>
<?php
  ini_set('mysql.connect_timeout', 300);
  ini_set('default_socket_timeout', 300);
  
?>
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
	
  $logoutGoTo = "Staff_Index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form30")) {
  $insertSQL = sprintf("INSERT INTO reservation (Reservation_ID, Homestay_ID, Guest_Email, `Date`, `Time`, Date_Checkin, Date_Checkout, Total, Checkin, PaymentProof_Slip, Status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Reservation_ID'], "text"),
                       GetSQLValueString($_POST['Homestay_ID'], "text"),
                       GetSQLValueString($_POST['Guest_Email'], "text"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Time'], "date"),
                       GetSQLValueString($_POST['Date_Checkin'], "date"),
                       GetSQLValueString($_POST['Date_Checkout'], "date"),
                       GetSQLValueString($_POST['Total'], "double"),
                       GetSQLValueString($_POST['txtcheckin'], "text"),
                       GetSQLValueString($_POST['PaymentProof_Slip'], "text"),
                       GetSQLValueString($_POST['txtstatus'], "text"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($insertSQL, $MyHomeStay_System) or die(mysql_error());
 echo $insertGoTo = "email_reservation2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}



$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM homestay WHERE `Homestay_ID` LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_POST['textfield1'])) {
  $colname_Recordset2 = $_POST['textfield1'];
}
$colname1_Recordset2 = "-1";
if (isset($_POST['textfield1'])) {
  $colname1_Recordset2 = $_POST['textfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = sprintf("SELECT * FROM guest WHERE Guest_Email = %s or Guest_IC = %s", GetSQLValueString($colname_Recordset2, "text"),GetSQLValueString($colname1_Recordset2, "text"));
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
    <title>RESERVATION</title>
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
<a class="navbar-brand" href="S_RDHomepage.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="S_RDHomepage.php">HOME</a></li>
<li><a href="S_Reservation.php">RESERVATION</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>
<style type="text/css">

    #printable { display: none; }

    @media print
    {
    	#homestay-sec { display: none; }
    	#printable { display: block; }
		  #footer { display: none; }
    }
    </style>

</ul>
</div>
</div>
</div>
<div class="row" ></div>
<div class="row" ></div>
<p>&nbsp;</p>
</div>

<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <h1 class="header-line" >PAYMENT</h1>
              
<form name="form1" method="post" action="S_RPayment.php?ID=<?php echo $_GET['ID']?>&Description=<?php echo $_GET['Description']?>&Checkin=<?php echo $_GET['Checkin']; ?>&Checkout=<?php echo $_GET['Checkout']; ?>">
                     <p align="center">
                     <label for="textfield1"></label>
                     <input name="textfield1" type="text" class="textfield_Login widthregister searchreservation" placeholder="Email Address / IC No" id="textfield1" value="<?php echo isset($_POST['textfield1'])?$var=mysql_escape_string($_POST['textfield1']):$var=""; ?>">                     
                     <p>
                       <input type="submit" class="btn btn-primary btn-lg searchreservation" name="btnSearch" id="btnSearch" value="Search">
                     </form>

                     </p>
                  
<form name="form30" method="POST" action="<?php echo $editFormAction; ?>">
    <?php  if(!isset($_POST['textfield1'])<="" && $row_Recordset2['Guest_Name']<="") { ?>
    <p>The guest account does not exist. Please click &quot;Register Guest&quot; button for register guest account.</p><div align="right"><button class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table3 table10" style="width:180px;" onclick="javascript:void window.open('S_RCustomer.php','1452488152659','width=500,height=950,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=0,top=3,directories=no,location=no');return false;">Register Guest</button></div>
    <?php } else { ?> <?php  if (!empty($_POST)) { ?>
        <table width="747" height="190" border="0">
                             <tr>
                               <td width="153" class="roomtype">Name</td>
                               <td width="393"><div align="left">: <?php echo $row_Recordset2['Guest_Name']; ?></div></td>
                               <td width="71" class="roomtype">Date</td>
                               <td width="157"><div align="left">: <?php echo date("Y-m-d");?> </div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Email</td>
                               <td><div align="left">: <?php echo $row_Recordset2['Guest_Email']; ?></div></td>
                               <td class="roomtype">Time</td>
                               <td><div align="left">: <?php date_default_timezone_set ("Asia/Kuala_Lumpur"); echo date("H:i:s");?></div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">IC/ Passport No</td>
                               <td><div align="left">: <?php echo $row_Recordset2['Guest_IC']; ?></div></td>
                               <td class="roomtype">Status</td>
                               <td><div align="left">: 
                                 <label for="txtstatus"></label>
                                 <select class="option1" name="txtstatus" id="txtstatus">
                                   <option class="option1" value="PAID">PAID</option>
                                   <option class="option1" value="UNPAID">UNPAID</option>
                                 </select>
                               </div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Phone</td>
                               <td><div align="left">: <?php echo $row_Recordset2['Guest_PhoneNumber']; ?></div></td>
                               <td class="roomtype">Checkin</td>
                               <td><div align="left">: 
                                 <label for="txtcheckin"></label>
                                 <select class="option1" name="txtcheckin" id="txtcheckin">
                                   <option class="option1" value="YES">YES</option>
                                   <option class="option1" value="NO">NO</option>
                                 </select>
                               </div></td>
                             </tr>
        </table><?php } else { ?>	<p>Click "Register Guest" button, if the guest does not have an account</p><div align="right"><button class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table3 table10" style="width:180px;" onclick="javascript:void window.open('S_RCustomer.php','1452488152659','width=500,height=950,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=0,top=3,directories=no,location=no');return false;">Register Guest</button></div>			     <?php } } ?>
</td>
                       </tr>
        <tr>
                     </tr>
                     </table>
                     <tr>&nbsp;</tr>
                     <table width="200" border="0">
                       <tr>
                         <td width="394" height="45" class="roomtype">Homestay  Type</td>
                         <td width="118" class="roomtype">Checkin</td>
                         <td width="118" class="roomtype">Checkout</td>
                         <td width="123" class="roomtype">Rate per/night</td>
                       </tr>
                       <tr>
                         <td class="descriptiontable" height="32"><div align="left"><?php echo $row_Recordset1['Description']; ?></div></td>
                         <td class="descriptiontable"><div align="left"><?php echo $_GET['Checkin']; ?></div></td>
                         <td class="descriptiontable"><div align="left"><?php echo $_GET['Checkout']; ?></div></td>
                         <td class="descriptiontable"><div align="left">RM <?php echo $row_Recordset1['Price']; ?></div></td>
                       </tr>
                       <tr>
                       <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">Days</td>
                         <td class="roomtype">: <?php $a = new Datetime($_GET['Checkin']);
$b = new Datetime($_GET['Checkout']);
$interval = $a->diff($b); echo $interval->format("%D");?></td>
                       </tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">GST (6%)</td>
                         <td class="roomtype">: RM <?php $x = $interval->format("%D"); 
$y = $row_Recordset1['Price'];
$g = ($x * $y)*0.06; echo number_format($g,2); ?></td>
                       </tr>
                       <tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">Total</td>
                         <td class="roomtype">: RM <?php $x = $interval->format("%D"); 
$y = $row_Recordset1['Price'];
$z = ($x * $y)+$g; echo number_format($z,2); ?></td>
					   </tr>
                     </table>
                     <p> </p>
               <input type="hidden" name="Reservation_ID" value="<?php echo $vercode = rand(10000000,99999999)?>">
                       <input type="hidden" name="Homestay_ID" value="<?php echo $row_Recordset1['Homestay_ID']; ?>">
  <input type="hidden" name="Guest_Email" value="<?php echo $row_Recordset2['Guest_Email']; ?>">
  <input type="hidden" name="Date" value="<?php echo date("Y-m-d");?>">
  <input type="hidden" name="Time" value="<?php date_default_timezone_set ("Asia/Kuala_Lumpur"); echo date("H:i:s");?>">
  <input type="hidden" name="Date_Checkin" value="<?php echo $_GET['Checkin']; ?>">
  <input type="hidden" name="Date_Checkout" value="<?php echo $_GET['Checkout']; ?>">
  <input type="hidden" name="Total" value="<?php $x = $interval->format("%D"); 
$y = $row_Recordset1['Price'];
$z = ($x * $y)+$g; echo $z; ?>">
  <input type="hidden" name="PaymentProof_Slip" value="WALK IN">
                 <div align="right">
                     <input type="submit" value="Confirm Reservation" class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table3" style="width:190px;">
                     <input type="hidden" name="MM_insert" value="form30">
                 </form>

               </div>
                                              </tr>

               </div>

             </div>
             <p>&nbsp;</p>



           <div class="row" ></div>
             
    
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/scrollReveal.js"></script>
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="dropzone/dropzone.js"></script>
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
<script>
$(function() {
      $(function() {
		        $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1});
    $( "#birthdate" ).datepicker();
  });
});

</script>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
$email = $row_Recordset2['Guest_Email'];

?>
