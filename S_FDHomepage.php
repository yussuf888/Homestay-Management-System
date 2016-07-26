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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE reservation SET Homestay_ID=%s, Guest_Email=%s, `Date`=%s, `Time`=%s, Date_Checkin=%s, Date_Checkout=%s, Total=%s, PaymentProof_Slip=%s, Status=%s WHERE Reservation_ID=%s",
                       GetSQLValueString($_POST['Homestay_ID'], "text"),
                       GetSQLValueString($_POST['Guest_Email'], "text"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Time'], "date"),
                       GetSQLValueString($_POST['Date_Checkin'], "date"),
                       GetSQLValueString($_POST['Date_Checkout'], "date"),
                       GetSQLValueString($_POST['Total'], "double"),
                       GetSQLValueString($_POST['PaymentProof_Slip'], "text"),
                       GetSQLValueString($_POST['Status'], "text"),
                       GetSQLValueString($_POST['Reservation_ID'], "int"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($updateSQL, $MyHomeStay_System) or die(mysql_error());

  $updateGoTo = "S_Rupdate2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname1_Recordset1 = "-1";
if (isset($_POST['textfield1'])) {
  $colname1_Recordset1 = $_POST['textfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM reservation natural join guest natural join homestay WHERE Reservation_ID = %s", GetSQLValueString($colname1_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_r1 = "SELECT * FROM reservation WHERE Status = 'UNPAID' ORDER BY Date DESC";
$r1 = mysql_query($query_r1, $MyHomeStay_System) or die(mysql_error());
$row_r1 = mysql_fetch_assoc($r1);
$totalRows_r1 = mysql_num_rows($r1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<script type="text/javascript">
setInterval(function() {
    $("#responsecontainer").load(location.href+" #responsecontainer>*","");
}, 10000);
</script>
<title>PAYMENT CONFIRM</title>
<p>&nbsp;</p>
<style type="text/css">

    #printable { display: none; }

    @media print
    {
    	#homestay-sec { display: none; }
    	#printable { display: block; }
		  #footer { display: none; }
    }
    </style>
</head>

<body>
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
<a class="navbar-brand" href="S_FDHomepage.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="S_FDHomepage.php">HOME</a></li>
<li><a href="S_Expense.php">EXPENSE</a></li>
<li><a href="S_Revenue.php">REVENUE</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>


</ul>
</div>
</div>
</div>
<div class="row" ></div>
<div class="row" ></div>
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
$g = ($x * $y)*0.06; echo $g; ?></td>
                       </tr>
                       <tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">Total</td>
                         <td class="roomtype">: RM <?php echo $row_Recordset1['Total']; ?></td>
                       </tr>
                     </table>
    </div></div>
<div id="homestay-sec" class="container set-pad" >
  <div class="row text-center">
               <div class="col-lg-4  col-md-4 col-sm-4 widthrese">
                 <h1 align="center" class="header-line" >RESERVATION</h1>
              
<form name="form1" method="post" action="S_FDHomepage.php">
                     <p align="center">
                     <label for="textfield1"></label>
                     <input name="textfield1" type="text" class="textfield_Login widthregister searchreservation" placeholder="Reservation ID" id="textfield1" value="<?php echo isset($_POST['textfield1'])?$var=mysql_escape_string($_POST['textfield1']):$var=""; ?>">                     
                     <p>
                       <input type="submit" class="btn btn-primary btn-lg searchreservation" name="btnSearch" id="btnSearch" value="Search">
                 </form>

                     </p>
                  <?php  if(!isset($_POST['textfield1'])<="" && $row_Recordset1['Time']<="") {echo $index3="<p>Please enter again reservation id.</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                      <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";} else { ?>
                     <?php  if (!empty($_POST)) { ?>
                        
              
                 <form action="<?php echo $editFormAction; ?>" method="post" name="form3" id="form3">	     
                 <table width="234%" height="182" border="0">
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
                               <td><div align="left">
                                 <select class="option1" name="Status">
                                   <option class="option1" value="PAID" <?php if (!(strcmp("PAID", htmlentities($row_Recordset1['Status'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PAID</option>
                                   <option class="option1" value="UNPAID" <?php if (!(strcmp("UNPAID", htmlentities($row_Recordset1['Status'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>UNPAID</option>
                                 </select>
                               </div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Phone</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Guest_PhoneNumber']; ?></div></td>
                               <td colspan="2" class="roomtype"><div align="left"><input type="submit" class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table3 updatebutton" value="Update" /></div></td>
                             </tr>
                   </table>
                 <tr>
                   <td>&nbsp;</td>
                   </tr>
                 <div align="right">
                   <input type="hidden" name="Reservation_ID" value="<?php echo $row_Recordset1['Reservation_ID']; ?>" />
                   <input type="hidden" name="Homestay_ID" value="<?php echo htmlentities($row_Recordset1['Homestay_ID'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="Guest_Email" value="<?php echo htmlentities($row_Recordset1['Guest_Email'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="Date" value="<?php echo htmlentities($row_Recordset1['Date'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="Time" value="<?php echo htmlentities($row_Recordset1['Time'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="Date_Checkin" value="<?php echo htmlentities($row_Recordset1['Date_Checkin'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="Date_Checkout" value="<?php echo htmlentities($row_Recordset1['Date_Checkout'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="Total" value="<?php echo htmlentities($row_Recordset1['Total'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="PaymentProof_Slip" value="<?php echo htmlentities($row_Recordset1['PaymentProof_Slip'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="MM_update" value="form3" />
                   <input type="hidden" name="Reservation_ID" value="<?php echo $row_Recordset1['Reservation_ID']; ?>" />
                   </div>
                   <table width="200" border="0">
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
                 </form>
                 <div align="right">
                   <form method="post" action="">
                   </form>
                 </div>
                                      <?php } else { ?> <tr>
                             
				     <?php } } ?>

               </div>
    <div id="responsecontainer" class="col-lg-4  col-md-4 col-sm-4 widthrese1">
                 <h1 align="center" class="header-line"  >UNPAID</h1>
      <?php if($row_r1['Reservation_ID']){?>
      
      <p><table width="50px" height="80" border="0">
  <tr>
    <td width="30%" class="roomtype"><div align="center">ID</div></td>
    <td width="40%" class="roomtype"><div align="center">Payment Slip</div></td>
    <td width="30%"><div align="center"></div></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><div align="center"><?php echo $row_r1['Reservation_ID']; ?></div></td>
      <td><div align="center"><a href="ViewSlip.php?ID=<?php echo $row_r1['Reservation_ID']; ?>" onclick="javascript:void window.open('ViewSlip.php?ID=<?php echo $row_r1['Reservation_ID']; ?>','1452488152659','width=650,height=710,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=1000,top=200,directories=no,location=no');return false;">View</a></div></td>
      <td><div align="center"><a onclick="return confirm('Press Ok button, if you want to delete reservation id = <?php echo $row_r1['Reservation_ID']; ?>')" href="delete_unpaid.php?ID=<?php echo $row_r1['Reservation_ID']; ?>">Reject</a></div></td>
    </tr>
    <?php } while ($row_r1 = mysql_fetch_assoc($r1)); ?>
      </table>
</p>
<?php } else {echo 'No reservation found.';}?>
    </div>  

  </div> 
</div>
         

         
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($r1);
?>



<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/scrollReveal.js"></script>
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/js/custom.js"></script>