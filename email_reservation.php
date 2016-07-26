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
<meta http-equiv="refresh" content="0; URL='G_RPayment.php'" />
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
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM reservation natural join guest natural join homestay WHERE Guest_Email = %s ORDER BY DATE DESC, TIME DESC", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$name = $row_Recordset1['Guest_Name'];
$reservenumber = $row_Recordset1['Reservation_ID'];
$date=$row_Recordset1['Date'];
$time=$row_Recordset1['Time'];
$checkin=$row_Recordset1['Date_Checkin'];
$checkout=$row_Recordset1['Date_Checkout'];
$total= $row_Recordset1['Total'];
$price= $row_Recordset1['Price'];
$description= $row_Recordset1['Description'];
?>
<?php
echo "<script>alert('Reservation summary has been sent to your email address.');</script>";
?>
<?php 

require_once "Mail.php";

$from = 'yussuf650@gmail.com';
$to = $row_Recordset1['Guest_Email'];
$subject = 'Reservation Confirmation for SUNFLOWER HOUSE';
$body = "<html>
</head>

<body>
<table>
  <tbody>
    <tr>
      <td><div align='center'><img src='http://s11.postimg.org/ys7x2920z/Untitled.png' alt='' tabindex='0' />
        <p>Customer service: +606-282-1500  </a>   Website: <a href='localhost/Guest_Index.php' target='_blank'>Guest_Index.php</a></p></td>
    </tr>
  </tbody>
</table>
<table>
  <tbody>
    <tr>
      <td><h1>YOUR RESERVATION</h1>
        <h3>Hello, $name.</h3>
        <p>Thank you for making reservation at SUNFLOWER HOUSE. We are pleased to confirm your reservation and the details are listed below.</p></td>
    </tr>
  </tbody>
</table>
<table>
  <colgroup>
  <col width='225px' />
  <col />
  </colgroup>
  <tbody>
    <tr>
      <td>Reservation number</td>
      <td>: $reservenumber</td>
    </tr>
    <tr>
      <td>Date</td>
      <td>: $date</td>
    </tr>
    <tr>
      <td>Time</td>
      <td>: $time</td>
    </tr>
    <tr>
      <td>Type of Homestay</td>
      <td>: $description</td>
    </tr>
    <tr>
      <td>Checkin Date</td>
      <td>: $checkin</td>
    </tr>
    <tr>
      <td>Checkout Date</td>
      <td>: $checkout</td>
    </tr>
    <tr>
      <td>Rate per/night</td>
      <td>: $price</td>
    </tr>
    <tr>
      <td>Total</td>
      <td>: $total</td>
    </tr>
  </tbody>
</table>
<table>
  <tbody>
   <table width='747' height='190' border='0'>
                            
                             <tr>
                               <td><div>
                                 <h2>Bank Transfer</h2>
                               </div>
                                 <div>
                                   <ul>
                                     <li>Account Name: <strong>SUNFLOWER HOUSE</strong></li>
                                     <li>Bank: <strong>CIMB BANK BERHAD</strong></li>
                                     <li>Account Number: <strong>8450 1412 2553</strong></li>
                                     <li>Swift Code: <strong>CBBEMYKL</strong></li>
                                   </ul>
                                   <ol>
                                     <li>Proceed the payment on your preferred bank payable to the bank account stated above.</li>
                                     <li>Make sure upload the bank slip at 'PAYMENT' page within 24hours otherwise the reservation will be cancel.</li>
                                     <li>We will update your reservation to 'PAID' status manually and check your status at 'PAYMENT' page.  </li>
                                     <li>You will able to print reservation at the payment page.</li>
									 <li>Once the payment made, there will no refund or cancel the reservation.</li>
                                   </ol>
                               </div></td>
                             </tr>
                           </table>
  </tbody>
</table>
</body>
</html>";

$headers = array(
    'From' => $from,
    'Reply-To' => $to,
    'Subject' => $subject,
    'MIME-Version' => "1.0",
  'Content-type' => "text/html; charset=iso-8859-1\r\n\r\n"
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'yussuf650@gmail.com',
        'password' => '0165279786'
    ));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    ('<p>' . $mail->getMessage() . '</p>');
} else {
    ('<p>Message successfully sent!</p>');
}
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
    <link href="homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<body >




           <div class="row" ></div>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/scrollReveal.js"></script>
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
?>
