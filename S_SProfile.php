<?php require_once('Connections/MyHomeStay_System.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO staff (S_Name, S_IC, S_Address, S_PhoneNumber, S_Department, Salary_PerHour, S_Username, S_Password) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['S_Name'], "text"),
                       GetSQLValueString($_POST['S_IC'], "text"),
                       GetSQLValueString($_POST['S_Address'], "text"),
                       GetSQLValueString($_POST['S_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['S_Department'], "text"),
                       GetSQLValueString($_POST['Salary_PerHour'], "double"),
                       GetSQLValueString($_POST['S_Username'], "text"),
                       GetSQLValueString($_POST['S_Password'], "text"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($insertSQL, $MyHomeStay_System) or die(mysql_error());

  echo $insertGoTo = "<script>
alert('Successfully register new staff.');
window.location.href='S_SProfile.php';
</script>";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_POST['txtfield1'])) {
  $colname_Recordset1 = $_POST['txtfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM staff WHERE S_IC LIKE %s OR S_Name LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"),GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 5;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = "SELECT * FROM staff ORDER BY S_Name ASC";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $MyHomeStay_System) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

$queryString_Recordset2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset2") == false && 
        stristr($param, "totalRows_Recordset2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset2 = sprintf("&totalRows_Recordset2=%d%s", $totalRows_Recordset2, $queryString_Recordset2);
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
<title>STAFF</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
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
<a class="navbar-brand" href="S_HRDHomepage.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="S_HRDHomepage.php">HOME</a></li>
<li><a href="S_SProfile.php">STAFF</a></li>
<li><a href="S_SWorking.php">WORKING TIME</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>


</ul>
</div>
</div>
</div>
<p>&nbsp; </p>
<div id="homestay-sec" class="container set-pad" >
<div class="row text-center"><div class="col-lg-4  col-md-4 col-sm-4 widthreses"><p>&nbsp;</p><p>&nbsp;</p>
                 <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
          <table class="margintable123" align="center">
            <tr valign="baseline">
              <td><span id="sprytextfield1">
              <input placeholder="Full Name" required="required" class="form-control form_control1" type="text" name="S_Name" value="" size="32" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td><span id="sprytextfield2">
              <input placeholder="Identity Card No" required="required" class="form-control form_control1" type="text" name="S_IC" value="" size="32" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td><span id="sprytextarea1">
              <textarea placeholder="Address" required="required" class="form-control form_control1" name="S_Address" cols="50" rows="5"></textarea>
              <span class="textareaRequiredMsg">A value is required.</span><span class="textareaMinCharsMsg">Minimum number of characters not met.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td><span id="sprytextfield3">
              <input placeholder="Phone Number" required="required" class="form-control form_control1" type="text" name="S_PhoneNumber" value="" size="32" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td><select name="S_Department" class="form-control form_control1" style="cursor:pointer">
        <option value="Human Resource Department" <?php if (!(strcmp("Human Resource Department", ""))) {echo "SELECTED";} ?>>Human Resource Department</option>
        <option value="Receptionist Department" <?php if (!(strcmp("Receptionist Department", ""))) {echo "SELECTED";} ?>>Receptionist Department</option>
        <option value="Manager" <?php if (!(strcmp("Manager", ""))) {echo "SELECTED";} ?>>Manager</option>
        <option value="Finance Department" <?php if (!(strcmp("Finance Department", ""))) {echo "SELECTED";} ?>>Finance Department</option>
        <option value="Cleaner Department" <?php if (!(strcmp("Cleaner Department", ""))) {echo "SELECTED";} ?>>Cleaner Department</option>
      </select></td>
            </tr>
            <tr valign="baseline">
              <td><span id="sprytextfield4">
              <input placeholder="Salary Per Hour" class="form-control form_control1" type="text" name="Salary_PerHour" value="" size="32" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td><span id="sprytextfield5">
              <input placeholder="Username" class="form-control form_control1" type="text" name="S_Username" value="" size="32" />
<span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td><span id="sprytextfield6">
              <input placeholder="Password" class="form-control form_control1" type="text" name="S_Password" value="" size="32" />
<span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td><input type="submit" value="Register" class="btn btn-primary btn-lg buttonRegister12" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1" />
</form> </div>
    <div class="col-lg-4  col-md-4 col-sm-4 widthreses">               
                 <p>&nbsp;</p><p>&nbsp;</p>
                 <form name="form30" method="post" action="S_SProfile.php">
                     <p align="center">
                     <label for="textfield1"></label>
                     <input name="txtfield1" id="txtfield1" type="text" class="textfield_Login widthregister searchreservation" placeholder="Name / IC No" value="<?php echo isset($_POST['txtfield1'])?$var=mysql_escape_string($_POST['txtfield1']):$var=""; ?>">                     
                     <p>
                       <input type="submit" class="btn btn-primary btn-lg searchreservation" name="btnSearch" id="btnSearch" value="Search">
                     </form>
                 <?php  if(!isset($_POST['txtfield1'])<="" && $row_Recordset1['S_Name']<="") {echo $index3="<p>Staff not found.</p>
                      <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";} else { ?>
                 <?php  if (!empty($_POST)) { ?>
      <table width="300" border="0">
                   <tr class="roomtype">
                     <td width="42%" height="44"><div align="center">Name</div></td>
                     <td width="32%"><div align="center">Identity Card No</div></td>
                     <td width="14%">&nbsp;</td>
                     <td width="12%">&nbsp;</td>
                   </tr>
        <?php do { ?>
                     <tr>
                       <td><?php echo $row_Recordset1['S_Name']; ?></td>
                       <td><?php echo $row_Recordset1['S_IC']; ?></td>
                       <td><a href="S_SProfileUpdate.php?Staff_ID=<?php echo $row_Recordset1['Staff_ID']; ?>" onclick="javascript:void window.open('S_SProfileUpdate.php?Staff_ID=<?php echo $row_Recordset1['Staff_ID']; ?>','1452488152659','width=650,height=750,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=200,top=180,directories=no,location=no');return false;">Edit</a></td>
                       <td><a href="delete_staffprofile.php?Staff_ID=<?php echo $row_Recordset1['Staff_ID']; ?>" onclick="return confirm('Press Ok button, if you want to delete <?php echo $row_Recordset1['S_Name']; ?>.')">Delete</a></td>
                     </tr>
                     <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>
      <p>
        <?php } else {?>
      </p>
                 <table width="300" border="0">
                   <tr class="roomtype">
                     <td width="42%" height="44"><div align="center">Name</div></td>
                     <td width="32%"><div align="center">Identity Card No</div></td>
                     <td width="14%">&nbsp;</td>
                     <td width="12%">&nbsp;</td>
                   </tr>
                   <?php do { ?>
                     <tr>
                       <td><?php echo $row_Recordset2['S_Name']; ?></td>
                       <td><?php echo $row_Recordset2['S_IC']; ?></td>
                       <td><a href="S_SProfileUpdate.php?Staff_ID=<?php echo $row_Recordset2['Staff_ID']; ?>" onclick="javascript:void window.open('S_SProfileUpdate.php?Staff_ID=<?php echo $row_Recordset2['Staff_ID']; ?>','1452488152659','width=650,height=750,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=200,top=180,directories=no,location=no');return false;">Edit</a></td>
                       <td><a href="delete_staffprofile.php?Staff_ID=<?php echo $row_Recordset2['Staff_ID']; ?>" onclick="return confirm('Press Ok button, if you want to delete <?php echo $row_Recordset2['S_Name']; ?>')">Delete</a></td>
                     </tr>
                     <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                 </table>
                 <p align="right"><span class="radio">Records <?php echo ($startRow_Recordset2 + 1) ?> to <?php echo min($startRow_Recordset2 + $maxRows_Recordset2, $totalRows_Recordset2) ?> of <?php echo $totalRows_Recordset2 ?></span> </p>
                 <table width="71%" border="0" class="margintable123">
                   <tr>
                     <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
                         <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, 0, $queryString_Recordset2); ?>"><img src="First.gif" /></a>
                     <?php } // Show if not first page ?></td>
                     <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
                         <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, max(0, $pageNum_Recordset2 - 1), $queryString_Recordset2); ?>"><img src="Previous.gif" /></a>
                     <?php } // Show if not first page ?></td>
                     <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
                         <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, min($totalPages_Recordset2, $pageNum_Recordset2 + 1), $queryString_Recordset2); ?>"><img src="Next.gif" /></a>
                     <?php } // Show if not last page ?></td>
                     <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
                         <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, $totalPages_Recordset2, $queryString_Recordset2); ?>"><img src="Last.gif" /></a>
                     <?php } // Show if not last page ?></td>
                   </tr>
      </table>
                 <p>
                   <?php }}?>
                 </p>
                 
                 </p>
                 <p>&nbsp;</p>
    </div>
                 
                 
                 
</div></div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"], minChars:2, maxChars:100});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"], minChars:5, maxChars:20});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], minChars:10});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "currency", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {minChars:5, maxChars:15, validateOn:["blur"], isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], minChars:5, maxChars:20, isRequired:false});
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
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
<script type="text/javascript">
    $(function () {
        $("#txtfield1").bind("change keyup",
  function () {      
      if ($("#txtfield1").val() != "")
          $(this).closest("form").find(":submit").removeAttr("disabled");
      else
          $(this).closest("form").find(":submit").attr("disabled", "disabled");      
      });
        });
</script>