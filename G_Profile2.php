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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form6")) {
  $updateSQL = sprintf("UPDATE guest SET Guest_Name=%s, Guest_IC=%s, Guest_BirthDate=%s, Guest_Gender=%s, Guest_Address=%s, Guest_City=%s, Guest_State=%s, Guest_Country=%s, Guest_PhoneNumber=%s, Guest_Password=%s WHERE Guest_Email=%s",
                       GetSQLValueString($_POST['Guest_Name'], "text"),
                       GetSQLValueString($_POST['Guest_IC'], "text"),
                       GetSQLValueString($_POST['Guest_BirthDate'], "date"),
                       GetSQLValueString($_POST['Guest_Gender'], "text"),
                       GetSQLValueString($_POST['Guest_Address'], "text"),
                       GetSQLValueString($_POST['Guest_City'], "text"),
                       GetSQLValueString($_POST['Guest_State'], "text"),
                       GetSQLValueString($_POST['Guest_Country'], "text"),
                       GetSQLValueString($_POST['Guest_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['Guest_Password'], "text"),
                       GetSQLValueString($_POST['Guest_Email'], "text"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($updateSQL, $MyHomeStay_System) or die(mysql_error());
  echo $updateGoTo = "<script>
alert('Successfully update.');
window.location.href='G_Profile2.php';
</script>";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM guest WHERE Guest_Email = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PROFILE</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
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
    <link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
</head>
<body >
<div id="NAMESLIP"><p>Hi, <?php echo $row_Recordset1['Guest_Name']; ?><p></div>
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
<a class="navbar-brand" href="G_HomepageUnverify.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="G_HomepageUnverify.php">HOME</a></li>
					<li><a href="G_Profile2.php">PROFILE</a></li>
               		<li><a href="G_About2.php">ABOUT US</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>


</ul>
</div>
</div>
</div>
<div class="row" ></div>
</div>.
<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <h1 data-scroll-reveal="enter from the bottom after 0.1s"  class="header-line">PROFILE</h1>
                     
                   
                 <form data-scroll-reveal="enter from the bottom after 0.5s" action="<?php echo $editFormAction; ?>" method="POST" name="form6" id="form6">
                 
                   <div align="center">
                     <table width="68%" align="center" class="widthregister widthregisteradjust">
                     <tr valign="baseline">
                         <td><div align="center"><span id="sprytextfield1">
                         <input type="hidden" name="Guest_Email" placeholder="Email Address" class="form-control form_control1 profilebold" value="<?php echo $row_Recordset1['Guest_Email']; ?>" readonly size="32" />
                         </div></td>
                       </tr>
                       <tr valign="baseline">
                       <td width="135" class="roomtype">Name</td>
                         <td width="353"><div align="center"><span id="sprytextfield2">
                         <input type="text" name="Guest_Name" placeholder="Name" required class="form-control form_control1"  value="<?php echo htmlentities($row_Recordset1['Guest_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                       <td width="135" class="roomtype">IC/Passport No</td>
                         <td width="353"><div align="center"><span id="sprytextfield15">
                         <input type="text" name="Guest_IC" placeholder="Identity Card No" class="form-control form_control1"  value="<?php echo htmlentities($row_Recordset1['Guest_IC'], ENT_COMPAT, 'utf-8'); ?>" size="32" required />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                       <td width="135" class="roomtype">Birthday Date</td>
                         <td><div align="center"><span id="sprytextfield3">
                         <input type="date" name="Guest_BirthDate" placeholder="Birthday Date (YYYY-MM-DD)" id="birthdate" class="form-control form_control1" value="<?php echo htmlentities($row_Recordset1['Guest_BirthDate'], ENT_COMPAT, 'utf-8'); ?>" size="32" required />
                         <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div></td> <input type="hidden" name="Guest_Gender" placeholder="Birthday Date (YYYY-MM-DD)" id="birthdate" class="form-control form_control1" value="<?php echo htmlentities($row_Recordset1['Guest_Gender'], ENT_COMPAT, 'utf-8'); ?>" size="32" required />
                       </tr>
                       
                       <tr valign="baseline">
                       <td width="135" class="roomtype">Address</td>
                         <td><div align="center"><span id="sprytextarea1">
                           <textarea name="Guest_Address" required cols="50" style="margin-top:-20px;" placeholder="Address" class="form-control form_control1" rows="5"><?php echo $row_Recordset1['Guest_Address']; ?></textarea>
                         <span class="textareaRequiredMsg">A value is required.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                       <td width="135" class="roomtype">City</td>
                         <td><div align="center"><span id="sprytextfield4">
                         <input type="text" required name="Guest_City" placeholder="City" class="form-control form_control1" value="<?php echo htmlentities($row_Recordset1['Guest_City'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                       <td width="135" class="roomtype">State</td>
                         <td><div align="center"><span id="sprytextfield5">
                         <input type="text" name="Guest_State" required placeholder="State" class="form-control form_control1" value="<?php echo htmlentities($row_Recordset1['Guest_State'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                       <td width="135" class="roomtype">Country</td>
                         <td><div align="center"><span id="sprytextfield6">
                         <input type="text" required name="Guest_Country" placeholder="Country" class="form-control form_control1" value="<?php echo htmlentities($row_Recordset1['Guest_Country'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                       <td width="135" class="roomtype">Phone</td>
                         <td><div align="center"><span id="sprytextfield7">
                         <input type="text" name="Guest_PhoneNumber" required placeholder="Phone Number" class="form-control form_control1" value="<?php echo htmlentities($row_Recordset1['Guest_PhoneNumber'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                       <td width="135" class="roomtype">Password</td>
                         <td><div align="center"><span id="sprytextfield8">
                           <input type="password" name="Guest_Password" placeholder="Password" id="password" required class="form-control form_control1" value="<?php echo htmlentities($row_Recordset1['Guest_Password'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span></span></div></td>
                       </tr>
                        <tr valign="baseline">
                       <td width="135" class="roomtype">Confirm Password</td>
                         <td><div align="center"><span id="spryconfirm1">
                           <input type="password" name="Guest_Password1" placeholder="Password" required class="form-control form_control1" value="<?php echo htmlentities($row_Recordset1['Guest_Password'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                          <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">Password not matching.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                       <td width="135">&nbsp;</td>
                         <td><div align="center">
                           <input type="submit" class="btn btn-primary btn-lg buttonRegister1" value="Update Profile" />
                         </div></td>
                       </tr>
                     </table>
                     
                   </div>
                   <input type="hidden" name="MM_update" value="form6">
                 </form>
                 <p>&nbsp;</p>
                
                 <p>&nbsp;</p>
               </div>

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
<script>

var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"], minChars:3, maxChars:50});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {validateOn:["blur"], isRequired:false});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"], minChars:2, maxChars:50});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"], minChars:2, maxChars:50});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], minChars:2, maxChars:50});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer", {validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur"]});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "none", {validateOn:["blur"]});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["blur"]});
</script>
<?php
mysql_free_result($Recordset1);
?>
