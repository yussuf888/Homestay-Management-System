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
  $updateSQL = sprintf("UPDATE guest SET Guest_Name=%s, Guest_IC=%s, Guest_BirthDate=%s, Guest_Gender=%s, Guest_Address=%s, Guest_City=%s, Guest_State=%s, Guest_Country=%s, Guest_PhoneNumber=%s, Guest_Password=%s, Verify=%s WHERE Guest_Email=%s",
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
                       GetSQLValueString($_POST['Verify'], "text"),
                       GetSQLValueString($_POST['Guest_Email'], "text"));

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
if (isset($_GET['Email'])) {
  $colname_Recordset1 = $_GET['Email'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM guest WHERE Guest_Email = %s", GetSQLValueString($colname_Recordset1, "text"));
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
<title>Guest Update</title>
</head>

<body>
<div id="homestay-sec" class="container set-pad" >
  <div class="row text-center">
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center" class="margintable1234" style="margin:auto;">
      <tr valign="baseline">
          <td width="125" align="left" nowrap="nowrap" class="roomtype"><div align="left">Email</div></td>
          <td width="263"><div align="left">: <?php echo $row_Recordset1['Guest_Email']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">Name</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_Name" value="<?php echo htmlentities($row_Recordset1['Guest_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            : <?php echo $row_Recordset1['Guest_Name']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">IC/Passport No</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_IC" value="<?php echo htmlentities($row_Recordset1['Guest_IC'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            : <?php echo $row_Recordset1['Guest_IC']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">Birthday</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_BirthDate" value="<?php echo htmlentities($row_Recordset1['Guest_BirthDate'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
             : <?php echo $row_Recordset1['Guest_BirthDate']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">Gender</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_Gender" value="<?php echo htmlentities($row_Recordset1['Guest_Gender'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            : <?php echo $row_Recordset1['Guest_Gender']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">Address</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_Address" value="<?php echo htmlentities($row_Recordset1['Guest_Address'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            : <?php echo $row_Recordset1['Guest_Address']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">City</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_City" value="<?php echo htmlentities($row_Recordset1['Guest_City'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            : <?php echo $row_Recordset1['Guest_City']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">State</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_State" value="<?php echo htmlentities($row_Recordset1['Guest_State'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            : <?php echo $row_Recordset1['Guest_State']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">Country</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_Country" value="<?php echo htmlentities($row_Recordset1['Guest_Country'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            : <?php echo $row_Recordset1['Guest_Country']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">Phone</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_PhoneNumber" value="<?php echo htmlentities($row_Recordset1['Guest_PhoneNumber'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            : <?php echo $row_Recordset1['Guest_PhoneNumber']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">Password</div></td>
          <td><div align="left">
            <input type="hidden" name="Guest_Password" value="<?php echo htmlentities($row_Recordset1['Guest_Password'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            : <?php echo $row_Recordset1['Guest_Password']; ?></div></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="left" class="roomtype"><div align="left">Verify</div></td>
          <td><div align="left">
          <select name="Verify">
              <option value="VERIFIED" <?php if (!(strcmp("VERIFIED", htmlentities($row_Recordset1['Verify'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>VERIFIED</option>
              <option value="UNVERIFIED"  class="option1"  <?php if (!(strcmp("UNVERIFIED", htmlentities($row_Recordset1['Verify'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>UNVERIFIED</option>
              <option value="BLOCK"  class="option1"  <?php if (!(strcmp("BLOCK", htmlentities($row_Recordset1['Verify'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOCK</option>
            </select>
          </div></td>
        </tr>
        <tr valign="baseline">
          <td colspan="2" align="center" nowrap="nowrap"><input type="submit" class="btn btn-primary btn-lg buttonRegister12" value="UPDATE GUEST" style="margin-top:10px; width:auto;" />          </td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="Guest_Email" value="<?php echo $row_Recordset1['Guest_Email']; ?>" />
    </form>
    <p>&nbsp;</p>
  </div></div>
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