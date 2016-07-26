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


$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  echo $MM_dupKeyRedirect="<script>
alert('Email already been registered.');
window.location.href='G_RLogin.php';
</script>";
  $loginUsername = $_POST['Guest_Email'];
  $LoginRS__query = sprintf("SELECT Guest_Email FROM guest WHERE Guest_Email=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $LoginRS=mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  if($loginFoundUser){
    $MM_qsChar = "?";
 
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form4")) {
  $insertSQL = sprintf("INSERT INTO guest (Guest_Email, Guest_Name, Guest_IC, Guest_BirthDate, Guest_Gender, Guest_Address, Guest_City, Guest_State, Guest_Country, Guest_PhoneNumber, Guest_Password) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Guest_Email'], "text"),
                       GetSQLValueString($_POST['Guest_Name'], "text"),
                       GetSQLValueString($_POST['Guest_IC'], "text"),
                       GetSQLValueString($_POST['Guest_BirthDate'], "date"),
                       GetSQLValueString($_POST['Guest_Gender'], "text"),
                       GetSQLValueString($_POST['Guest_Address'], "text"),
                       GetSQLValueString($_POST['Guest_City'], "text"),
                       GetSQLValueString($_POST['Guest_State'], "text"),
                       GetSQLValueString($_POST['Guest_Country'], "text"),
                       GetSQLValueString($_POST['Guest_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['Guest_Password'], "text"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($insertSQL, $MyHomeStay_System) or die(mysql_error());

  echo $email=$_POST['Guest_Email'];
  $insertGoTo = "G_RegisterSuccess.php?email=$email";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
  <title>LOGIN/REGISTER</title>
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <link href="assets/css/flexslider.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />    
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
  <link href="Style/homepage.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
</head>

<body >
 

  
  
    
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
  $MM_redirectLoginFailed = "G_LoginFail.php";
  $MM_redirecttoReferrer = false;
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
  $MM_redirectLoginFailed = "G_LoginFail.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  	
  $LoginRS__query=sprintf("SELECT Guest_Email, Guest_Password, Verify FROM guest WHERE Guest_Email=%s AND Guest_Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'Verify');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
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
<?php isset($_GET['Description'])?$var=mysql_escape_string($_GET['Description']):$var=$row_Recordset1['Description'];
$_SESSION['Description']= $var;
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
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <link href="assets/css/flexslider.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />    
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
  <link href="Style/homepage.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
  <link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
<link href="css/css.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript">

$(document).ready(function() {
	$('#Loading').hide();    
});

function check_username(){

	var username = $("#username").val();
	if(username.length > 2){
		$('#Loading').show();
		$.post("check_username_availablity.php", {
			username: $('#username').val(),
		}, function(response){
			$('#Info').fadeOut();
			 $('#Loading').hide();
			setTimeout("finishAjax('Info', '"+escape(response)+"')", 450);
		});
		return false;
	}
}

function finishAjax(id, response){
 
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn(1000);
} 

</script>

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
            <li><a href="Guest_Index.php#homestay-sec">FIND HOMESTAY</a></li>
                                 <li><a href="Guest_Index.php#register-sec">ATTRACTIONS</a></li>

            <li><a href="Guest_Index.php#aboutus-sec">ABOUT US</a></li>
          </ul>
      </div>
    </div>
</div>

  </div>.

  <div id="homestay-sec" >
    <div class="container set-pad">
      <div class="row text-center">
      </div>
      <div class="row" >
        <div class="col-lg-4  col-md-4 col-sm-4 widthreses" data-scroll-reveal="enter from the bottom after 0.1s">
          <div class="faculty-div">
          </div>
          <div class="row text-center">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
              <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">LOG IN </h1>
              <p></p>
            </div>
            <form data-scroll-reveal="enter from the bottom after 0.5s" id="form3" name="form3" method="POST" action="<?php echo $loginFormAction; ?>">
              <p align="center">
                <label for="txtemail"></label>
                <input name="txtemail" type="text" autocomplete="off" class="form-control form_control2" style="width:200px;" id="txtemail" placeholder="Email Address" required />
                <label for="txtpassword"></label>
                <input type="password" name="txtpassword"  class="form-control form_control2" required id="txtpassword" style="width:200px; margin-top:-20px;" placeholder="Password" />
                <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary btn-lg buttonRegister loginbutton" value="Log In" style="width:300px; margin-top:7px;" />
              <p><a class="forgotp" onclick="javascript:void window.open('G_ForgotP.php','1452488152659','width=600,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=400,top=200,directories=no,location=no');return false;">Click here if forgot the password</a></p>
              </p>
            </form>
          </div>
        </div>
        <div class="col-lg-4  col-md-4 col-sm-4 widthreses" data-scroll-reveal="enter from the bottom after 0.4s">
          <div class="faculty-div"></div>
            <div class="row text-center">
              <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">REGISTER </h1>
                <p></p>
              </div>
            <form data-scroll-reveal="enter from the bottom after 0.5s" id="form4" name="form4" method="POST" action="<?php echo $editFormAction; ?>">
              <table width="538" align="center" class="widthregister">
                <tr valign="baseline">
                <td width="530"><div align="center"><span id="sprytextfield2">
                  <input type="text" name="Guest_Name" placeholder="Full Name" class="form-control form_control3" style="width:200px;"  value="" size="32" required />
                  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                         <td width="350"><div align="center"><span id="sprytextfield15">
                         <input type="text" name="Guest_IC" placeholder="Identity Card/Passport No" required class="form-control form_control3"  value="" size="32" style="width:200px;" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield3">
                  <input type="date" required name="Guest_BirthDate" placeholder="Birthday Date (YYYY-MM-DD)" class="form-control form_control3" value="" size="32" style="width:200px;" />
                  <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td valign="baseline"><div align="center">
                  <table width="200" border="0" class="table1">
                    <tr>
                      <td width="99"><div align="center">
                        <input required type="radio" name="Guest_Gender" value="Male" /> 
                        Male</div></td>
                      <td width="91"><div align="center">
                        <input required type="radio" name="Guest_Gender" value="Female" /> 
                        Female</div></td>
                      </tr>
                  </table>
                </div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield1">
                  <input required type="text" style="width:200px;" name="Guest_Email" id="username" onblur="return check_username()" placeholder="Email Address" class="form-control form_control3" value="" size="32" /><div id="Info"></div>
                  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextarea1">
                <textarea required style="width:200px;" name="Guest_Address" cols="50" placeholder="Address" class="form-control form_control3" rows="5"></textarea>
                  <span class="textareaRequiredMsg">A value is required.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield4">
                  <input required style="width:200px;" type="text" name="Guest_City" placeholder="City" class="form-control form_control3" value="" size="32" />
                  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield5">
                  <input required style="width:200px;" type="text" name="Guest_State" placeholder="State" class="form-control form_control3" value="" size="32" />
                  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield6">
                  <input required style="width:200px;" type="text" name="Guest_Country" placeholder="Country" class="form-control form_control3" value="" size="32" />
                  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield7">
                <input required style="width:200px;" type="text" name="Guest_PhoneNumber" placeholder="Phone Number" class="form-control form_control3" value="" size="32" />
                <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield8">
                <input required style="width:200px;" type="password" name="Guest_Password" placeholder="Password" id="password" class="form-control form_control3" value="" size="32" />
                <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="spryconfirm1">
                  <input required style="width:200px;" type="password" name="Confirm_Password" id="confirm_password" placeholder="Confirm Password" class="form-control form_control3" value="" size="32" />
                  <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">Passwords not matching.</span></span></div></td>
                </tr>
                
                <tr valign="baseline">
                <td><div align="center">
                  <input type="submit" style="width:300px;" class="btn btn-primary btn-lg buttonRegister registerbutton1" value="Register" />
                </div></td>
                </tr>
              </table>
                  <input type="hidden" name="MM_insert" value="form4">
            </form>
            </div>
        </div>
      </div>
    </div>
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
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>

<script>
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email", {minChars:5, maxChars:100, validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"], minChars:3, maxChars:30});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {validateOn:["blur"], isRequired:false});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"], minChars:2, maxChars:50});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"], minChars:2, maxChars:50});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], minChars:2, maxChars:50});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer", {validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur"], minChars:5, maxChars:20});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "none", {validateOn:["blur"]});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["blur", "change"]});
</script>
  
