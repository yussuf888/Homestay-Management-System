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
$colname1_Search_Reservation1 = "-1";
if (isset($_POST['txtCheckout'])) {
  $colname1_Search_Reservation1 = $_POST['txtCheckout'];
}
$colname_Search_Reservation1 = "-1";
if (isset($_POST['txtCheckin'])) {
  $colname_Search_Reservation1 = $_POST['txtCheckin'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Search_Reservation1 = sprintf("(SELECT h.Homestay_ID, h.Description, h.Price FROM homestay h WHERE NOT EXISTS (     SELECT * FROM reservation r WHERE r.Homestay_ID = h.Homestay_ID      AND      (          (%s > r.Date_Checkin AND %s  < r.Date_Checkout)        OR (%s <= r.Date_Checkin AND %s > r.Date_Checkin)     ) ) limit 0,1) UNION ALL (SELECT h.Homestay_ID, h.Description, h.Price FROM homestay h WHERE NOT EXISTS (     SELECT * FROM reservation r WHERE r.Homestay_ID = h.Homestay_ID      AND      (          (%s > r.Date_Checkin AND %s  < r.Date_Checkout)        OR (%s <= r.Date_Checkin AND %s > r.Date_Checkin)     ) )  limit 5,1)", GetSQLValueString($colname_Search_Reservation1, "text"),GetSQLValueString($colname_Search_Reservation1, "text"),GetSQLValueString($colname_Search_Reservation1, "text"),GetSQLValueString($colname1_Search_Reservation1, "text"),GetSQLValueString($colname_Search_Reservation1, "text"),GetSQLValueString($colname_Search_Reservation1, "text"),GetSQLValueString($colname_Search_Reservation1, "text"),GetSQLValueString($colname1_Search_Reservation1, "text"));
$Search_Reservation1 = mysql_query($query_Search_Reservation1, $MyHomeStay_System) or die(mysql_error());
$row_Search_Reservation1 = mysql_fetch_assoc($Search_Reservation1);
$totalRows_Search_Reservation1 = mysql_num_rows($Search_Reservation1);
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
    <link rel="stylesheet" href="jquery-ui-1.11.4.custom/jquery-ui.css">
<title>RECEPTIONIST DEPARTMENT</title>
<style>

</style>
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
<a class="navbar-brand" href="S_RDHomepage.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="S_RDHomepage.php">HOME</a></li>
<li><a href="S_Reservation.php">RESERVATION</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>


</ul>
</div>
</div>
</div>
                   <p>&nbsp; </p>
    <div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1  class="header-line">FIND HOMESTAY</h1>
                     
                   <form name="form1" method="post" action="#homestay-sec" >
                     <p>
                       <label for="txtCheckin"></label>
                       <input name="txtCheckin" type="text" class="textfield_Login widthregister" readonly id="checkin"  placeholder="Check in Date" value="<?php echo isset($_POST['txtCheckin'])?$Checkin=mysql_escape_string($_POST['txtCheckin']):$Checkin=""; ?>">
                       <label for="txtCheckout"></label>
                       <input name="txtCheckout" type="text" class="textfield_Login widthregister" readonly id="checkout" placeholder="Check out Date" value="<?php echo isset($_POST['txtCheckout'])?$Checkout=mysql_escape_string($_POST['txtCheckout']):$Checkout=""; ?>">
                     </p>
                     <p>
                       <input name="BtnSearch" type="submit" class="btn btn-primary btn-lg" id="BtnSearch" value="Search" />
                     </p>
                       <?php
    isset($_POST['txtCheckin'])?$Checkin=mysql_escape_string($_POST['txtCheckin']):$Checkin="";
	isset($_POST['txtCheckout'])?$Checkout=mysql_escape_string($_POST['txtCheckout']):$Checkout="";

	?>
                   </form>
                   <p>
                      <?php  if(!isset($_POST['txtCheckin'])<="" && $_POST['txtCheckout']<="") {echo $index3="Please select check in and check out date.";} else { ?>

                     <?php  if (!empty($_POST)) { ?>
                   </p>
                   
                   <p>&nbsp; </p>
                   <form name="form2" method="post" action="_target">
                     <table width="718" height="117" border="0">
                     <?php 
					 if($row_Search_Reservation1 <= "") {echo $INDEX1="No homestay available.";}
					 else { ?>
                       <tr class="header_homestay">
                       	 <td width="78" height="30" ><div align="left"></div></td>
                         <td width="364"><div align="left"><strong>Description</strong></div></td>
                         <td width="184"><div align="left"><strong>Price</strong></div></td>
                         <td width="148"><div align="left"></div></td>
                       </tr>
                       <?php do { ?>
                       <tr>
                         <td></td>
                         <td height="20" class="body_homepage"><div align="left"><?php echo $row_Search_Reservation1['Description']; ?></div></td>
                         <td><div align="left">RM <span class="body_homepage"><?php echo $row_Search_Reservation1['Price']; ?></span></div></td>
                         <td><a href="S_RPayment.php?ID=<?php echo $row_Search_Reservation1['Homestay_ID']?>&Description=<?php echo $row_Search_Reservation1['Description']?>&Checkin=<?php echo $Checkin; ?>&Checkout=<?php echo $Checkout; ?>" class="buttonize">   Book   </td>
                       </tr>
                         <?php } while ($row_Search_Reservation1 = mysql_fetch_assoc($Search_Reservation1)); ?>
                         <?php } ?>
                  	
					                        
                         
                     </table>
                   </form>
                   <p>&nbsp;</p>
                   <p>
                     <?php } else {echo $INDEX2="";} }?>
                   </p>
                 </div>

             </div>  
             </div>
             
</body>
</html>
<?php
mysql_free_result($Search_Reservation1);
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
      $('#checkin').datepicker({minDate: 0, onSelect: function(selectedDate) {
            var minDate = $(this).datepicker('getDate');
            if (minDate) {
                  minDate.setDate(minDate.getDate() + 1);
            }
            $('#checkout').datepicker('option', 'minDate', minDate || 1); 
      }});
      $('#checkout').datepicker({minDate: +1, onSelect: function(selectedDate) {
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