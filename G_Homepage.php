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
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "VERIFIED";
$MM_donotCheckaccess = "false";


function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {  
  $isValid = False; 


  if (!empty($UserName)) { 

    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 

    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "G_HomepageUnverify.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
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

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = sprintf("SELECT * FROM guest WHERE Guest_Email = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $MyHomeStay_System) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WELCOME TO SUNFLOWER HOUSE MALACCA</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
	<link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="jquery-ui-1.11.4.custom/jquery-ui.css">
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
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
	<body> 
    <div id="NAMESLIP"><p>Hi, <?php echo $row_Recordset2['Guest_Name']; ?><p></div>
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

      <div class="home-sec" id="home" >
           <div class="overlay">
<div class="container">
           <div class="row text-center " >
               <div class="col-lg-12  col-md-12 col-sm-12">

           <div class="flexslider set-flexi" id="main-section" >
          <ul class="slides move-me">

                         
                              <h3>IT'S ALWAYS SUNNY SOMEWHERE</h3>
                           <h1>THE UNIQUE HOMESTAY</h1>
                           
                            <a  href="#homestay-sec" class="btn btn-success btn-lg" >
                                MAKE RESERVATION 
                            </a>
                          


             </ul>  
                </div>
             </div>
      </div>
             </div>

           </div>
           
    </div>
  
    <div  class="tag-line" >
         <div class="container">
           <div class="row  text-center" >
           
               <div class="col-lg-12  col-md-12 col-sm-12">
               
        <h2 data-scroll-reveal="enter from the bottom after 0.1s" >WELCOME TO SUNFLOWER HOUSE MALACCA</h2>

             </div>
           </div>
      </div>
        
    </div>



           <div class="row" ></div>
             </div>
     
         <div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.3s"  class="header-line">FIND HOMESTAY</h1>
                     
                   <form data-scroll-reveal="enter from the bottom after 0.5s" name="form1" method="post" action="#homestay-sec" >
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
                   <p data-scroll-reveal="enter from the bottom after 0.5s">
                      <?php  if(!isset($_POST['txtCheckin'])<="" && $_POST['txtCheckout']<="") {echo $index3="Please select check in and check out date.";} else { ?>

                     <?php  if (!empty($_POST)) { ?>
                   </p>
                   
                   <p>&nbsp; </p>
                   <form data-scroll-reveal="enter from the bottom after 0.7s" name="form2" method="post" action="_target">
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
                         <td><a href="G_RLogin2.php?ID=<?php echo $row_Search_Reservation1['Homestay_ID'] ?>&Description=<?php echo $row_Search_Reservation1['Description']?>&Checkin=<?php echo $Checkin; ?>&Checkout=<?php echo $Checkout; ?>" class="buttonize">   Book   </td>
                       </tr>
                         <?php } while ($row_Search_Reservation1 = mysql_fetch_assoc($Search_Reservation1)); ?>
                         <?php } ?>
                  	
					                        
                         
                     </table>
                   </form>
                   <p>&nbsp;</p>
                   <p>
                     <?php } else {echo $INDEX2="Please select check in and check out date.";} }?>
                   </p>
                   <p>&nbsp; </p>
                   <p data-scroll-reveal="enter from the bottom after 0.2s">&nbsp;</p>
                 </div>

             </div>       </div>
             </div>
<div id="footer">
         MOHAMED YUSSUF BIN JAHUBAR SATHIK | © 2016 SUNFLOWER HOUSE MALACCA| All Rights Reserved |  <a style="color: #fff" target="_blank"></a>
   </div>
</body>
</html>
<?php
mysql_free_result($Search_Reservation1);

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
      $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1,changeYear: true});
      $('#checkin').datepicker({minDate: +2,maxDate: "+6M", onSelect: function(selectedDate) {
            var minDate = $(this).datepicker('getDate');
            if (minDate) {
                  minDate.setDate(minDate.getDate() + 1);
            }
            $('#checkout').datepicker('option', 'minDate', minDate || 1); 
      }});
      $('#checkout').datepicker({minDate: +3,maxDate: "+7M", onSelect: function(selectedDate) {
            var maxDate = $(this).datepicker('getDate');
            if (maxDate) {
                  maxDate.setDate(maxDate.getDate() - 1);
            }
            $('#checkin').datepicker('option', 'maxDate', maxDate); 
      $(function() {
    $( "#birthdate" ).datepicker();
  });
});
</script>