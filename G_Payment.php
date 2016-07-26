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
	
  $logoutGoTo = "Guest_Index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
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



$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
$colname1_Recordset1 = "-1";
if (isset($_POST['textfield1'])) {
  $colname1_Recordset1 = $_POST['textfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM reservation natural join guest natural join homestay WHERE Guest_Email = %s and Reservation_ID = %s", GetSQLValueString($colname_Recordset1, "text"),GetSQLValueString($colname1_Recordset1, "text"));
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
    <title>PAYMENT</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="dropzone/dropzone.css" rel="stylesheet" type="text/css">
    <style type="text/css">
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
<style type="text/css">

    #printable { display: none; }

    @media print
    {
    	#homestay-sec { display: none; }
    	#printable { display: block; }
		  #footer { display: none; }
		  #NAMESLIP {display:none;}
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
                 <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line" >PAYMENT</h1>
              
<form data-scroll-reveal="enter from the bottom after 0.5s" name="form1" method="post" action="G_Payment.php">
                     <p align="center">
                     <label for="textfield1"></label>
                     <input name="textfield1" type="text" class="textfield_Login widthregister searchreservation" placeholder="Reservation ID" id="textfield1" value="<?php echo isset($_POST['textfield1'])?$var=mysql_escape_string($_POST['textfield1']):$var=""; ?>">                     
                     <p>
                       <input type="submit" class="btn btn-primary btn-lg searchreservation" name="btnSearch" disabled id="btnSearch" value="Search">
                 </form>

                     </p>
                  <?php  if(!isset($_POST['textfield1'])<="" && $row_Recordset1['Time']<="") { ?><td class="lefttext"><div>
                                 <p data-scroll-reveal="enter from the bottom after 0.6s">No reservation found.                                 </p>
                                 <h2 data-scroll-reveal="enter from the bottom after 0.7s" align="left">Bank Transfer</h2>
                               </div>
                                 <div data-scroll-reveal="enter from the bottom after 0.9s">
                                   <ul>
                                     <li>
                                       <div align="left">Account Name: <strong>SUNFLOWER HOUSE</strong></div>
                                     </li>
                                     <li>
                                       <div align="left">Bank: <strong>CIMB BANK BERHAD</strong></div>
                                     </li>
                                     <li>
                                       <div align="left">Account Number: <strong>8450 1412 2553</strong></div>
                                     </li>
                                     <li>
                                       <div align="left">Swift Code: <strong>CBBEMYKL</strong></div>
                                     </li>
                                   </ul>
                                   <div align="left">
                                     <ol>
                                       <li>Proceed the payment on your preferred bank payable to the bank account stated above.</li>
                                       <li>Make sure upload the bank slip at "PAYMENT" page within 24hours otherwise the reservation will be cancel.</li>
                                       <li>We will update your reservation to "PAID" status manually and check your status at "PAYMENT" page.  </li>
                                       <li>You will able to print reservation at the payment page.</li>
                                       <li>Once the payment made, there will no refund or cancel the reservation.</li>
                                     </ol>
                                     <p>&nbsp;</p>
                                   </div>
                                   <ol>
                                   </ol>
                               </div></td><?php } else { ?>
                     <?php  if (!empty($_POST)) { ?>
                        
                 	     
                 <table data-scroll-reveal="enter from the bottom after 0.6s" width="747" height="190" border="0">
                             <tr>
                               <td width="153" class="roomtype">Name</td>
                               <td width="393"><div align="left">: <?php echo $row_Recordset1['Guest_Name']; ?></div></td>
                               <td width="71" class="roomtype">Date</td>
                               <td width="157"><div align="left">: <?php echo $row_Recordset1['Date']; ?></div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Email</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Guest_Email']; ?></div></td>
                               <td class="roomtype">Time</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Time']; ?></div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">IC/ Passport No</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Guest_IC']; ?></div></td>
                               <td class="roomtype">Status</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Status']; ?></div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Phone</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Guest_PhoneNumber']; ?></div></td>
                               <?php if($row_Recordset1['Status']<="PAID") {} else { ?><td colspan="2" class="roomtype"><div align="left"><button class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table4" onclick="javascript:void window.open('G_RUpload.php','1452488152659','width=600,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=400,top=200,directories=no,location=no');return false;">Click Here To Upload Bank Slip</button></div></td><?php }; ?>
                             </tr>
                 </table></td>
                       </tr>
                       <tr>
                         <td>&nbsp;</td>
                     </tr>
                     </table>
                     <table data-scroll-reveal="enter from the bottom after 0.7s" width="200" border="0">
                       <tr>
                         <td width="394" height="45" class="roomtype">Homestay  Type</td>
                         <td width="118" class="roomtype">Checkin</td>
                         <td width="118" class="roomtype">Checkout</td>
                         <td width="123" class="roomtype">Rate per/night</td>
                       </tr>
                       <tr>
                         <td class="descriptiontable" height="32"><div align="left"><?php echo $row_Recordset1['Description']; ?></div></td>
                         <td class="descriptiontable"><div align="left"><?php echo $row_Recordset1['Date_Checkin']; ?></div></td>
                         <td class="descriptiontable"><div align="left"><?php echo $row_Recordset1['Date_Checkout']; ?></div></td>
                         <td class="descriptiontable"><div align="left">RM <?php echo $row_Recordset1['Price']; ?></div></td>
                       </tr>
                       <tr>
                       <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">Days</td>
                         <td class="roomtype">: <?php $a = new Datetime($row_Recordset1['Date_Checkin']);
$b = new Datetime($row_Recordset1['Date_Checkout']);
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
                         <td class="roomtype">: RM <?php echo $row_Recordset1['Total']; ?></td>
					   </tr>
                     </table>
                     <p> </p>
                     
                 <div align="right">
                     <p><input data-scroll-reveal="enter from the bottom after 0.9s" type="submit" name="btnsubmit" id="btnsubmit" value="Print" class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table3" onClick="window.print()" formtarget="_new"></p>
             
                 </div>
                 <p>&nbsp;</p>
                                      <?php } else { ?> <tr>
                               <td class="lefttext"><div>
                                 <h2 align="left">&nbsp;</h2>
                                 <h2 data-scroll-reveal="enter from the bottom after 0.7s" align="left">Bank Transfer</h2>
                               </div>
                                 <div data-scroll-reveal="enter from the bottom after 0.9s">
                                   <ul>
                                     <li>
                                       <div align="left">Account Name: <strong>SUNFLOWER HOUSE</strong></div>
                                     </li>
                                     <li>
                                       <div align="left">Bank: <strong>CIMB BANK BERHAD</strong></div>
                                     </li>
                                     <li>
                                       <div align="left">Account Number: <strong>8450 1412 2553</strong></div>
                                     </li>
                                     <li>
                                       <div align="left">Swift Code: <strong>CBBEMYKL</strong></div>
                                     </li>
                                   </ul>
                                   <div align="left">
                                     <ol>
                                       <li>Proceed the payment on your preferred bank payable to the bank account stated above.</li>
                                       <li>Make sure upload the bank slip at "PAYMENT" page within 24hours otherwise the reservation will be cancel.</li>
                                       <li>We will update your reservation to "PAID" status manually and check your status at "PAYMENT" page.  </li>
                                       <li>You will able to print reservation at the payment page.</li>
                                       <li>Once the payment made, there will no refund or cancel the reservation.</li>
                                     </ol>
                                     <p>&nbsp;</p>
                                   </div>
                                   <ol>
                                   </ol>
                               </div></td>
                             </tr>
				     <?php } } ?>

               </div>

             </div>



           <div class="row" ></div>
             </div>
             <div id="printable">
<div id="apDiv1">
  <table width="129%" height="150" border="0">
    <tr>
      <td width="746"><div align="center"><img src="assets/img/logopdf.png" alt="" width="440" height="115" /></div></td>
      <td width="369" class="fontsize"><h4>Sunflower House Malacca,</h4>
        <h4>No. 57, Jalan PJ 1,</h4>
        <h4>Taman Pertam Jaya,</h4>
        <h4>75050 Melaka,</h4>
        <h4>Malaysia.</h4>
        <h4><strong>Call:</strong> +606-282-1500</h4></td>
    </tr>
  </table>
</div>
                     <p>&nbsp;</p>
                     <p>&nbsp;</p>

    	 <table width="782" height="273" border="0">
                       <tr>
                         <td height="45" colspan="7" class="reservationsummary">Reservation  Summary</td>
                       </tr>
                       <tr>
                         <td height="30" colspan="7"><div align="center">
                           <table width="747" height="190" border="0">
                             <tr>
                               <td width="120" class="roomtype">Name</td>
                               <td width="394">: <?php echo $row_Recordset1['Guest_Name']; ?></td>
                               <td width="68" class="roomtype">Date</td>
                               <td width="147">: <?php echo $row_Recordset1['Date'];?></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Email</td>
                               <td>: <?php echo $row_Recordset1['Guest_Email']; ?></td>
                               <td class="roomtype">Time</td>
                               <td>: <?php echo $row_Recordset1['Time']; ?></td>
                             </tr>
                             <tr>
                               <td class="roomtype">IC/ Passport No</td>
                               <td>: <?php echo $row_Recordset1['Guest_IC']; ?></td>
                               <td class="roomtype">Status</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Status']; ?></div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Phone</td>
                               <td>: <?php echo $row_Recordset1['Guest_PhoneNumber']; ?></td>
                               <td class="roomtype">Reservation ID</td>
                               <td>: <?php echo $row_Recordset1['Reservation_ID']; ?></td>
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
                     <table width="701" border="0">
                       <tr>
                         <td width="394" height="45" class="roomtype">Homestay  Type</td>
                         <td width="118" class="roomtype">Checkin</td>
                         <td width="118" class="roomtype">Checkout</td>
                         <td width="123" class="roomtype">Rate per/night</td>
                       </tr>
                       <tr>
                         <td class="descriptiontable" height="32"><?php echo $row_Recordset1['Description'];?></td>
                         <td class="descriptiontable"><?php echo $row_Recordset1['Date_Checkin'];?></td>
                         <td class="descriptiontable"><?php echo $row_Recordset1['Date_Checkout'];?></td>
                         <td class="descriptiontable">RM <?php echo $row_Recordset1['Price']; ?></td>
                       </tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">Days</td>
                         <td class="roomtype">: <?php $a = new Datetime($row_Recordset1['Date_Checkin']);
$b = new Datetime($row_Recordset1['Date_Checkout']);
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
                         <td class="roomtype">: RM <?php echo $row_Recordset1['Total']; ?></td>
                       </tr>
                     </table>
    </div></div></div>
<?php $_SESSION['id_Reservation']= $row_Recordset1['Reservation_ID']; ?>

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
<script src="dropzone/dropzone.js"></script>
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
<script type="text/javascript">
    $(function () {
        $("#textfield1").bind("change keyup",
  function () {      
      if ($("#textfield1").val() != "")
          $(this).closest("form").find(":submit").removeAttr("disabled");
      else
          $(this).closest("form").find(":submit").attr("disabled", "disabled");      
      });
        });
</script>
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
?>
