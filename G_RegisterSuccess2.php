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
<meta http-equiv="refresh" content="15; URL='Guest_Index.php'" />
<?php function generateRandomString($length = 200) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_=';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$random = generateRandomString();

?>
<?php 
$email=$row_Recordset1['Guest_Email'];
$name=$row_Recordset1['Guest_Name'];
require_once "Mail.php";

$from = 'yussuf650@gmail.com';
$to = $row_Recordset1['Guest_Email'];
$subject = 'SUNFLOWER HOUSE EMAIL VERIFICATION';
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
      <td><h1>EMAIL VERIFICATION</h1>
        <h3>Hello, $name .</h3>
        <p>Thank you for signing up for an account on Sunflower House Malacca.</p>
		<p></p>
		<p>Please click on the link below to verify your email address and login to your account.</p>
		<p></p>
		
		<p><a href='localhost/G_Confirm2.php?$random&email=$email' target='_blank'>localhost/G_Confirm2.php?$random&email=$email</a></p></td>
    </tr>
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
    <title>REGISTRATION SUCCESS</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="js/jquery.countdown360.js" type="text/javascript" charset="utf-8"></script>
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


</ul>
</div>
</div>
</div>
<div class="row" ></div>
<div id="homestay-sec" class="container set-pad" >
             
                   <div class="row text-center">
                   <p>&nbsp;</p>
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                   <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line" >CONGRATULATIONS</h1>
                     <p data-scroll-reveal="enter from the bottom after 0.5s">Thanks for registering with SUNFLOWER HOUSE. Verification email has been sent to your email address. This page will redirect to homepage in 15 seconds.</p>
                     <p data-scroll-reveal="enter from the bottom after 0.5s">&nbsp;</p>
                     <p align="center"><div id="countdown"></div></p>
                  
                 </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora05l" style="top:158px;left:248px;width:40px;height:40px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;" data-autocenter="2"></span>
        <a href="http://www.jssor.com" style="display:none">Bootstrap Carousel</a>
    </div></h2>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                 </div>

             </div>
             <!--/.HEADER LINE END-->


           <div class="row" ></div>
<div id="footer" style="position:absolute; bottom:0; left:0; min-height:auto; margin:auto; margin-top: 10px;">
          MOHAMED YUSSUF BIN JAHUBAR SATHIK | © 2016 SUNFLOWER HOUSE MALACCA| All Rights Reserved |  <a style="color: #fff" target="_blank"></a>
    </div>
            
    <script type="text/javascript" charset="utf-8">
$("#countdown").countdown360({
radius      : 100,
seconds     : 15,
fontColor   : '#FFFFFF',
autostart   : false,
onComplete  : function () { console.log('done') }
}).start()
</script>

<?php
mysql_free_result($Recordset1);
?>
