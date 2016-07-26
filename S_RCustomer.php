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
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form4")) {
  $insertSQL = sprintf("INSERT INTO guest (Guest_Email, Guest_Name, Guest_IC, Guest_BirthDate, Guest_Gender, Guest_Address, Guest_City, Guest_State, Guest_Country, Guest_PhoneNumber, Guest_Password, Verify) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['Guest_Password'], "text"),
                       GetSQLValueString($_POST['verify'], "text"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($insertSQL, $MyHomeStay_System) or die(mysql_error());

echo $insertGoTo =  "<script>
alert('The guest have been successfully register');
window.location.href='S_RCustomer.php';
</script>";  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>REGISTER CUSTOMER</title>
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
</head>

<body >
<div id="homestay-sec" ><div class="container set-pad">
        <div class="col-lg-4  col-md-4 col-sm-4">
            <div class="row text-center">
              
            <form id="form4" name="form4" method="POST" action="<?php echo $editFormAction; ?>">
              <table width="538" align="center" class="widthregister">
                <tr valign="baseline">
                <td width="530"><div align="center"><span id="sprytextfield2">
                  <input type="text" name="Guest_Name" placeholder="Name" class="form-control form_control3" required  value="" size="32" />
                  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                         <td width="350"><div align="center"><span id="sprytextfield15">
                         <input type="text" required name="Guest_IC" placeholder="Identity Card No" class="form-control form_control3"  value="" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield3">
                  <input type="date" required name="Guest_BirthDate" placeholder="Birthday Date (YYYY-MM-DD)" id="birthdate" class="form-control form_control3" value="" size="32" />
                  <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td valign="baseline"><div align="center">
                  <table width="231" border="0" class="table1">
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
                  <input required type="text" name="Guest_Email" id="username" onblur="return check_username()" placeholder="Email Address" class="form-control form_control3" value="" size="32" /><div id="Info"></div>
                  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextarea1">
                <textarea name="Guest_Address" cols="50" placeholder="Address" class="form-control form_control3" rows="5"></textarea>
</span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield4">
                  <input type="text" name="Guest_City" placeholder="City" class="form-control form_control3" value="" size="32" />
<span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield5">
                  <input type="text" name="Guest_State" placeholder="State" class="form-control form_control3" value="" size="32" />
<span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield6">
                  <input type="text" name="Guest_Country" placeholder="Country" class="form-control form_control3" value="" size="32" />
<span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center"><span id="sprytextfield7">
                  <input type="text" name="Guest_PhoneNumber" placeholder="Phone Number" class="form-control form_control3" value="" size="32" />
</span></div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center">
                  <input type="hidden" name="Guest_Password" placeholder="Password" class="form-control form_control3" value="123456" size="32" />
                  </div></td>
                </tr>
                <tr valign="baseline">
                <td><div align="center">
                <input type="hidden" name="verify" value="VERIFIED"/>
                  <input type="submit" class="btn btn-primary btn-lg buttonRegister registerbutton1" value="Register" style="min-width:300px;" />
                </div></td>
                </tr>
              </table>
                  <input type="hidden" name="MM_insert" value="form4">
            </form>
            </div>
      </div>
    </div>
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
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"], minChars:2, maxChars:50, isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"], minChars:2, maxChars:50, isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], minChars:2, maxChars:50, isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "none", {validateOn:["blur"]});

</script>