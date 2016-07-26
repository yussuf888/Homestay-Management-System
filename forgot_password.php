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
if (isset($_GET['txtfield1'])) {
  $colname_Recordset1 = $_GET['txtfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM guest WHERE Guest_Email = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<meta http-equiv="refresh" content="10; URL='G_ForgotP.php'" />

<?php 

require_once "Mail.php";
$name = $row_Recordset1['Guest_Name'];
$password = $row_Recordset1['Guest_Password'];
$from = 'yussuf650@gmail.com';
$to = $row_Recordset1['Guest_Email'];
$subject = 'Password Recovery for SUNFLOWER HOUSE account';
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
      <td><h1>PASSWORD RECOVERY</h1>
        <h3>Hello, $name.</h3>
        <p>Your account password is <h3>$password</h3></p></td>
    </tr>
  </tbody>
</table>
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


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Reservation</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<body >
<div class="navbar navbar-inverse navbar-fixed-top" id="menu">
<div class="container">
<div class="navbar-header">

<a class="navbar-brand" href="G_Homepage.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>




</ul>
</div>
</div>
<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">                     
                   <p>&nbsp;</p>
                   <p>&nbsp;</p>
				   <p>&nbsp;</p>
                   <p>&nbsp;</p>


                   <?php if (PEAR::isError($mail)) {
   echo ('<p>Invalid email address.</p>');
} else {
   echo ('<p>Password has been successfully sent to email.</p>');
}
?>
                   
               </div>

             </div></div>


<div class="row" ></div>
<p>
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
</p>
<script>
$(function() {
      $(function() {
		        $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1});
    $( "#birthdate" ).datepicker();
  });
});
             </script>
