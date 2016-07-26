<?php require_once('Connections/MyHomeStay_System.php'); ?>

<?php
  ini_set('mysql.connect_timeout', 300);
  ini_set('default_socket_timeout', 300);
  
?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM reservation natural join guest WHERE Guest_Email = %s ORDER BY Date desc, Time desc", GetSQLValueString($colname_Recordset1, "text"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
$colname1_Recordset2 = "-1";
if (isset($_POST['textfield1'])) {
  $colname1_Recordset2 = $_POST['textfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = sprintf("SELECT * FROM (SELECT * FROM reservation WHERE Guest_Email = %s) AS ME WHERE Reservation_ID LIKE %s OR Date LIKE %s ORDER BY Date desc, Time desc", GetSQLValueString($colname_Recordset2, "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"));
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

$colname_Recordset3 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset3 = $_SESSION['MM_Username'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset3 = sprintf("SELECT * FROM guest WHERE Guest_Email = %s", GetSQLValueString($colname_Recordset3, "text"));
$Recordset3 = mysql_query($query_Recordset3, $MyHomeStay_System) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HISTORY</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="dropzone/dropzone.css" rel="stylesheet" type="text/css">
    <style type="text/css">

    #printable { display: none; }

    @media print
    {
    	#homestay-sec { display: none; }
    	#printable { display: block; }
		  #footer { display: none; }
    }
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
</head>
<body >
        <div id="NAMESLIP"><p>Hi, <?php echo $row_Recordset3['Guest_Name']; ?></p></div>
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
<a class="navbar-brand" href="G_Homepage.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="G_Homepage.php">HOME</a></li>
<li><a href="G_Profile.php">PROFILE</a></li>
<li><a href="G_Payment.php">PAYMENT</a></li>
<li><a href="G_History.php">HISTORY</a></li>
<li><a href="G_About.php">ABOUT US</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>


</ul>
</div>
</div>
</div>
<div class="row" ></div>
<div class="row" ></div>
<p>&nbsp;</p>


<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line" >HISTORY</h1>
              
<form data-scroll-reveal="enter from the bottom after 0.3s" name="form1" method="post" action="G_History.php">
                     <p align="center">
                     <label for="textfield1"></label>
                     <input name="textfield1" type="text" class="textfield_Login widthregister searchreservation" placeholder="Reservation ID" id="textfield1" value="<?php echo isset($_POST['textfield1'])?$var=mysql_escape_string($_POST['textfield1']):$var=""; ?>">                     
                     <p>
                       <input type="submit" class="btn btn-primary btn-lg searchreservation" name="btnSearch" disabled id="btnSearch" value="Search">
                     </form>
                 <p>
<?php  if(!isset($_POST['textfield1'])<="" && $row_Recordset2['Date']<="") {echo $index3="<p data-scroll-reveal='enter from the bottom after 0.3s'>No matching reservation found.</p><p>&nbsp;</p>
                      ";} else { ?>
                 <?php  if (!empty($_POST)) { ?>
                     <table data-scroll-reveal="enter from the bottom after 0.3s" width="300" border="0" class="margintable12345">
                       <tr class="roomtype">
                         <td width="34%" height="38"><div align="left">Reservation ID</div></td>
                         <td width="25%"><div align="left">Date</div></td>
                         <td width="16%"><div align="left">Time</div></td>
                         <td width="17%"><div align="left">Status</div></td>
                         <td width="8%">&nbsp;</td>
                       </tr>
                       <?php do { ?>
                       <tr height="30px">
                         <td><div align="left"><?php echo $row_Recordset2['Reservation_ID']; ?></div></td>
                         <td><div align="left"><?php echo $row_Recordset2['Date']; ?></div></td>
                         <td><div align="left"><?php echo $row_Recordset2['Time']; ?></div></td>
                         <td><div align="left"><?php echo $row_Recordset2['Status']; ?></div></td>
                         <td><a href="S_VReservation.php?ID=<?php echo $row_Recordset2['Reservation_ID']; ?>" onclick="javascript:void window.open('G_VReservation.php?ID=<?php echo $row_Recordset2['Reservation_ID']; ?>','1452488152659','width=950,height=800,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=100,top=100,directories=no,location=no');return false;">View</a></td>
                       </tr>
                         <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                     </table>
                     <?php } else { ?>
                     <?php  if(isset($_POST['textfield1'])<="" && $row_Recordset2['Date']<="") {echo $index3="<p data-scroll-reveal='enter from the bottom after 0.3s'>No reservation found.</p><p>&nbsp;</p>
                      ";} else { ?>
                     <table data-scroll-reveal="enter from the bottom after 0.3s" width="300" border="0" class="margintable12345">
                       <tr class="roomtype">
                         <td width="34%" height="38"><div align="left">Reservation ID</div></td>
                         <td width="25%"><div align="left">Date</div></td>
                         <td width="16%"><div align="left">Time</div></td>
                         <td width="17%"><div align="left">Status</div></td>
                         <td width="8%">&nbsp;</td>
                       </tr>
                      
                       <?php do { ?>
                       <tr height="30px">
                         <td><div align="left"><?php echo $row_Recordset1['Reservation_ID']; ?></div></td>
                         <td><div align="left"><?php echo $row_Recordset1['Date']; ?></div></td>
                         <td><div align="left"><?php echo $row_Recordset1['Time']; ?></div></td>
                         <td><div align="left"><?php echo $row_Recordset1['Status']; ?></div></td>
                         <td><a href="S_VReservation.php?ID=<?php echo $row_Recordset1['Reservation_ID']; ?>" onclick="javascript:void window.open('G_VReservation.php?ID=<?php echo $row_Recordset1['Reservation_ID']; ?>','1452488152659','width=950,height=800,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=100,top=100,directories=no,location=no');return false;">View</a></td>
                       </tr>
                                                <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

                       <tr height="30px">
                         <td colspan="5">
                           <table border="0" class="margintable1234">
                             <tr>
                               <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                                   <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><img src="First.gif"></a>
                               <?php } // Show if not first page ?></td>
                               <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                                   <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="Previous.gif"></a>
                               <?php } // Show if not first page ?></td>
                               <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                                   <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="Next.gif"></a>
                               <?php } // Show if not last page ?></td>
                               <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                                   <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="Last.gif"></a>
                               <?php } // Show if not last page ?></td>
                             </tr>
                         </table></td>
                       </tr>
                     </table>
                     <?php } }}?>
                 <p>&nbsp;</p>
                     </p></p>
                 

			</div></div></div>

           <div class="row" ></div>
            
          
<div id="footer" style="position:fixed; bottom:0; left:0; min-height:auto; margin:auto;">
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
<script src="dropzone/dropzone.js"></script>
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
<script type="text/javascript">
    $(function () {
        $("#textfield1").bind("change keyup",
  function () {      
      if ($("#textfield1").val() != "")
          $(this).closest("form").find(":submit").removeAttr("disabled");
      else
          $(this).closest("form").find(":submit").attr("disabled", "disabled");      
      });
        });
</script>
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

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
