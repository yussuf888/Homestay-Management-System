<?php require_once('Connections/MyHomeStay_System.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO shift (Staff_ID, Work_Date, Work_Checkin, Work_Checkout) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['Staff_ID'], "int"),
                       GetSQLValueString($_POST['Work_Date'], "date"),
                       GetSQLValueString($_POST['Work_Checkin2'], "text"),
                       GetSQLValueString($_POST['Work_Checkout'], "text"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($insertSQL, $MyHomeStay_System) or die(mysql_error());
  echo $insertGoTo = "<script>
alert('Successfully clockin.');
window.location.href='S_HRDHomepage.php';
</script>";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE shift SET Work_Checkout=%s WHERE Work_ID=%s",
                       GetSQLValueString($_POST['Work_Checkout2'], "text"),
                       GetSQLValueString($_POST['Work_ID'], "int"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($updateSQL, $MyHomeStay_System) or die(mysql_error());

  echo $updateGoTo = "<script>
alert('Successfully clockout.');
window.location.href='S_HRDHomepage.php';
</script>";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_POST['txtfield1'])) {
  $colname_Recordset1 = $_POST['txtfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM shift right outer join staff on shift.Staff_ID = staff.Staff_ID WHERE S_IC = %s ORDER BY Work_Date DESC, Work_Checkin DESC", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = "SELECT * FROM feedback ORDER BY Feedback_ID DESC";
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

if (!function_exists("GetSQLValueString")) 
{
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
	  if (PHP_VERSION < 6) 
	  {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	  }
	
	  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
	  switch ($theType) 
	  {
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
<title>HUMAN RESOURCE DEPARTMENT</title>
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
  <div class="row text-center">
    <div class="col-lg-4  col-md-4 col-sm-4 widthreses">               <h1 class="header-line" >FEEDBACK</h1>
    <p><table width="300" border="0">
    <tr class="roomtype">
          <td width="35%" height="33">Email</td>
          <td width="65%">Message</td>
        </tr>
      <?php do { ?>
        <tr class="descriptiontable">
          <td width="35%" height="33"><div align="left"><?php echo $row_Recordset2['Guest_Email']; ?></div></td>
          <td width="65%"><div align="left"><?php echo $row_Recordset2['Feedback']; ?></div></td>
        </tr>
        <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
    </table>
</p>
<div align="right">Records <?php echo ($startRow_Recordset2 + 1) ?> to <?php echo min($startRow_Recordset2 + $maxRows_Recordset2, $totalRows_Recordset2) ?> of <?php echo $totalRows_Recordset2 ?>
</div>
<table border="0">
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
    </div>
               <div class="col-lg-4  col-md-4 col-sm-4 widthreses">
                 <h1 class="header-line" >STAFF CLOCKIN / CLOCKOUT</h1>
                 <form id="form3" name="form3" method="post" action="S_HRDHomepage.php">
                 <p>
                   <input name="txtfield1" id="txtfield1" placeholder="Identity Card No" class="textfield_Login widthregister searchreservation" type="text" value="<?php echo isset($_POST['txtfield1'])?$var=mysql_escape_string($_POST['txtfield1']):$var=""; ?>" />
                   </p>
                   <p>
                     <input type="submit" class="btn btn-primary btn-lg searchreservation" name="btnsubmit" id="btnsubmit" value="Search" />
                   </p>
                 </form>
                 <div align="center">
              <?php  if (!empty($_POST)) { ?>
                   <?php  if($row_Recordset1['S_Name']<="" && $row_Recordset1['Work_Checkout'] <="") { echo $index1="Staff not found"; } else {?>
                 </div>
                 <p>
                   <?php  if($row_Recordset1['Work_Checkout']=="NULL") { ?>
                 </p>
                 <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
                   <table align="center">
                     <tr valign="baseline">
                       <td><table width="200" border="0" class="margintable">
                         <tr>
                           <td width="26%"><div align="left" class="roomtype">Name</div></td>
                           <td width="74%"><div align="left">: <?php echo $row_Recordset1['S_Name']; ?></div></td>
                         </tr>
                         <tr>
                           <td><div align="left" class="roomtype">IC No</div></td>
                           <td><div align="left">: <?php echo $row_Recordset1['S_IC']; ?></div></td>
                         </tr>
                         <tr>
                           <td><div align="left" class="roomtype">Date</div></td>
                           <td><div align="left">: <?php echo date("Y-m-d");?></div></td>
                         </tr>
                         <tr>
                           <td><div align="left" class="roomtype">Checkin</div></td>
                           <td><div align="left">: <?php echo $row_Recordset1['Work_Checkin']; ?></div></td>
                         </tr>
                       </table></td>
                     </tr>
                     <tr valign="baseline">
                           <td><input name="Work_Checkout2" type="text" class="checktime" id="Work_Checkout2" value="<?php date_default_timezone_set ("Asia/Kuala_Lumpur"); echo date("H:i:s");?>" size="32" />
                   <input type="submit" value="Clockout" class="btn btn-primary btn-lg searchreservation buttoncheckin" /></td>
                     </tr>
                   </table>
                   <input type="hidden" name="Work_ID" value="<?php echo $row_Recordset1['Work_ID']; ?>" />
                   <input type="hidden" name="Staff_ID" value="<?php echo htmlentities($row_Recordset1['Staff_ID'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="Work_Date" value="<?php echo htmlentities($row_Recordset1['Work_Date'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="Work_Checkin" value="<?php echo htmlentities($row_Recordset1['Work_Checkin'], ENT_COMPAT, 'utf-8'); ?>" />
                   <input type="hidden" name="MM_update" value="form2" />
                   <input type="hidden" name="Work_ID" value="<?php echo $row_Recordset1['Work_ID']; ?>" />
                 </form>
                 <?php } else { ?>
                 <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                   <table align="center">
                     <tr valign="baseline">
                       <td><table width="200" border="0" class="margintable">
                         <tr>
                           <td width="26%"><div align="left" class="roomtype">Name</div></td>
                           <td width="74%"><div align="left">: <?php echo $row_Recordset1['S_Name']; ?></div></td>
                         </tr>
                         <tr>
                           <td><div align="left" class="roomtype">IC No</div></td>
                           <td><div align="left">: <?php echo $row_Recordset1['S_IC']; ?></div></td>
                         </tr>
                         <tr>
                           <td><div align="left" class="roomtype">Date</div></td>
                           <td><div align="left">: <?php echo date("Y-m-d");?></div></td>
                         </tr>
                       </table></td>
                     </tr>
                     <tr valign="baseline">
                       <td><input name="Work_Checkin2" type="text" class="checktime" id="Work_Checkin" placeholder="CHECK IN TIME" value="<?php date_default_timezone_set ("Asia/Kuala_Lumpur"); echo date("H:i:s");?>" size="32" />
                       <input type="submit" value="Clockin" class="btn btn-primary btn-lg searchreservation buttoncheckin" /></td>
                     </tr>
                   </table>
                   <input type="hidden" name="Staff_ID" value="<?php echo $row_Recordset1['Staff_ID']; ?>" />
                   <input type="hidden" name="Work_Date" value="<?php echo date("Y-m-d");?>" />
                   <input type="hidden" name="Work_Checkout" value="NULL" />
                   <input type="hidden" name="MM_insert" value="form1" />
                 </form>&nbsp;</p> <?php }}}else{}; ?>
               </div></div></div>

                 

             
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