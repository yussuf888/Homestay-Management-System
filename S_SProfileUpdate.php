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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE staff SET S_Username=%s, S_Name=%s, S_IC=%s, S_Address=%s, S_PhoneNumber=%s, S_Department=%s, S_Password=%s, Salary_PerHour=%s WHERE Staff_ID=%s",
                       GetSQLValueString($_POST['S_Username'], "text"),
                       GetSQLValueString($_POST['S_Name'], "text"),
                       GetSQLValueString($_POST['S_IC'], "text"),
                       GetSQLValueString($_POST['S_Address'], "text"),
                       GetSQLValueString($_POST['S_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['S_Department'], "text"),
                       GetSQLValueString($_POST['S_Password'], "text"),
                       GetSQLValueString($_POST['Salary_PerHour'], "double"),
                       GetSQLValueString($_POST['Staff_ID'], "int"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($updateSQL, $MyHomeStay_System) or die(mysql_error());

  echo $updateGoTo = "<script>
alert('Successfully update.');
window.close();
</script>";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['Staff_ID'])) {
  $colname_Recordset1 = $_GET['Staff_ID'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM staff WHERE Staff_ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<title>PROFILE UPDATE</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
</head>

<body>
<div id="homestay-sec" class="container set-pad" >
  <div class="row text-center"> <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">
  <input type="hidden" name="Staff_ID" value="<?php echo $row_Recordset1['Staff_ID']; ?>" size="32" />
          <table class="margintable123" align="center" style="width:500px;">
            <tr valign="baseline">
            <td width="188" class="roomtype">Name</td>
              <td width="300"><span id="sprytextfield1">
              <input placeholder="Full Name" required="required" class="form-control form_control1" type="text" name="S_Name" value="<?php echo $row_Recordset1['S_Name']; ?>" size="32" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td class="roomtype">IC/Passport No</td>
              <td><span id="sprytextfield2">
              <input placeholder="Identity Card No" required="required" class="form-control form_control1" type="text" name="S_IC" value="<?php echo $row_Recordset1['S_IC']; ?>" size="32" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
            </tr>
            <tr valign="baseline">
             <td class="roomtype">Address</td>
              <td><span id="sprytextarea1">
              <textarea placeholder="Address" required="required" class="form-control form_control1" name="S_Address" cols="50" rows="5"><?php echo $row_Recordset1['S_Address']; ?></textarea>
              <span class="textareaRequiredMsg">A value is required.</span><span class="textareaMinCharsMsg">Minimum number of characters not met.</span></span></td>
            </tr>
            <tr valign="baseline">
            <td class="roomtype">Phone</td>
              <td><span id="sprytextfield3">
              <input placeholder="Phone Number" required="required" class="form-control form_control1" type="text" name="S_PhoneNumber" value="<?php echo $row_Recordset1['S_PhoneNumber']; ?>" size="32" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
            </tr>
            <tr valign="baseline">
            <td class="roomtype">Department</td>
              <td><select name="S_Department" class="form-control form_control1" style="cursor:pointer">
        <option value="Human Resource Department" <?php if (!(strcmp("Human Resource Department", ""))) {echo "SELECTED";} ?>>Human Resource Department</option>
        <option value="Receptionist Department" <?php if (!(strcmp("Receptionist Department", ""))) {echo "SELECTED";} ?>>Receptionist Department</option>
        <option value="Manager" <?php if (!(strcmp("Manager", ""))) {echo "SELECTED";} ?>>Manager</option>
        <option value="Finance Department" <?php if (!(strcmp("Finance Department", ""))) {echo "SELECTED";} ?>>Finance Department</option>
        <option value="Cleaner Department" <?php if (!(strcmp("Cleaner Department", ""))) {echo "SELECTED";} ?>>Cleaner Department</option>
      </select></td>
            </tr>
            <tr valign="baseline">
           <td class="roomtype">Salary Per Hour</td>
              <td><span id="sprytextfield4">
              <input placeholder="Salary Per Hour" required="required" class="form-control form_control1" type="text" name="Salary_PerHour" value="<?php echo $row_Recordset1['Salary_PerHour']; ?>" size="32" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
            </tr>
            <tr valign="baseline">
                        <td class="roomtype">Username</td>
              <td><span id="sprytextfield5">
              <input placeholder="Username" class="form-control form_control1" type="text" name="S_Username" value="<?php echo $row_Recordset1['S_Username']; ?>" size="32" />
<span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
            </tr>
            <tr valign="baseline">
                        <td class="roomtype">Password</td>
              <td><span id="sprytextfield6">
              <input placeholder="Password" class="form-control form_control1" type="text" name="S_Password" value="<?php echo $row_Recordset1['S_Password']; ?>" size="32" />
<span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
            </tr>
            <tr valign="baseline">
            <td></td>
              <td><input type="submit" value="Update Profile" class="btn btn-primary btn-lg buttonRegister12" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form1" />
  </form> </div></div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"], minChars:2, maxChars:100});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:5, maxChars:20, validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], minChars:10});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {minChars:5, maxChars:20, validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "currency", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"], minChars:5, maxChars:15, isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], minChars:4, maxChars:20, isRequired:false});
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
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
      $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1});
      $('#checkin').datepicker({minDate: +4, onSelect: function(selectedDate) {
            var minDate = $(this).datepicker('getDate');
            if (minDate) {
                  minDate.setDate(minDate.getDate() + 1);
            }
            $('#checkout').datepicker('option', 'minDate', minDate || 1); 
      }});
      $('#checkout').datepicker({minDate: +5, onSelect: function(selectedDate) {
            var maxDate = $(this).datepicker('getDate');
            if (maxDate) {
                  maxDate.setDate(maxDate.getDate() - 1);
            }
            $('#checkin').datepicker('option', 'maxDate', maxDate); 
      }});
      $(function() {
    $( "#birthdate" ).datepicker();
  });
});
</script>