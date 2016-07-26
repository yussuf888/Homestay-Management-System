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

$colname1_Recordset1 = "-1";
if (isset($_POST['textfield1'])) {
  $colname1_Recordset1 = $_POST['textfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM reservation natural join guest natural join homestay WHERE Guest_Email LIKE %s OR Reservation_ID = %s OR Guest_Name LIKE %s OR Guest_IC = %s OR Date_Checkin LIKE %s ORDER BY DATE DESC, TIME DESC", GetSQLValueString("%" . $colname1_Recordset1 . "%", "text"),GetSQLValueString($colname1_Recordset1, "text"),GetSQLValueString("%" . $colname1_Recordset1 . "%", "text"),GetSQLValueString($colname1_Recordset1, "text"),GetSQLValueString("%" . $colname1_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<script type="text/javascript">
setInterval(function() {
    $("#responsecontainer").load(location.href+" #responsecontainer>*","");
}, 10000);
</script>
<title>RESERVATION</title>
<p>&nbsp;</p>
<style type="text/css">

    #printable { display: none; }

    @media print
    {
    	#homestay-sec { display: none; }
    	#printable { display: block; }
		  #footer { display: none; }
    }
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
<div class="row" ></div>
<div class="row" ></div>
<div id="printable">
<div id="apDiv1">
  <table width="129%" height="150" border="0">
    <tr>
      <td width="746"><div align="center"><img src="assets/img/logopdf.png" alt="" width="440" height="115" /></div></td>
      <td width="369" class="fontsize"><h4>Sunflower House Malacca,</h4>
        <h4>No. 57, Jalan PJ 1,</h4>
        <h4>Taman Pertam Jaya,</h4>
        <h4>75050 Melaka,</h4>
        <h4>Malaysia.</h4>
        <h4><strong>Call:</strong> +606-282-1500</h4></td>
    </tr>
  </table>
</div>
                     <p>&nbsp;</p>
                     <p>&nbsp;</p>

    	 <table width="782" height="273" border="0">
                       <tr>
                         <td height="45" colspan="7" class="reservationsummary">Reservation  Summary</td>
                       </tr>
                       <tr>
                         <td height="30" colspan="7"><div align="center">
                           <table width="747" height="190" border="0">
                             <tr>
                               <td width="120" class="roomtype">Name</td>
                               <td width="394">: <?php echo $row_Recordset1['Guest_Name']; ?></td>
                               <td width="68" class="roomtype">Date</td>
                               <td width="147">: <?php echo $row_Recordset1['Date'];?></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Email</td>
                               <td>: <?php echo $row_Recordset1['Guest_Email']; ?></td>
                               <td class="roomtype">Time</td>
                               <td>: <?php echo $row_Recordset1['Time']; ?></td>
                             </tr>
                             <tr>
                               <td class="roomtype">IC/ Passport No</td>
                               <td>: <?php echo $row_Recordset1['Guest_IC']; ?></td>
                               <td class="roomtype">Status</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Status']; ?></div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Phone</td>
                               <td>: <?php echo $row_Recordset1['Guest_PhoneNumber']; ?></td>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                             </tr>
                           </table>
                         </div></td>
                       </tr>
                       <tr>
                         <td height="30" colspan="7" class="reservationguest">&nbsp;</td>
                       </tr>
  </table>
                   <p></p>
                   <div align="center">
                     <table width="701" border="0">
                       <tr>
                         <td width="394" height="45" class="roomtype">Homestay  Type</td>
                         <td width="118" class="roomtype">Checkin</td>
                         <td width="118" class="roomtype">Checkout</td>
                         <td width="123" class="roomtype">Rate per/night</td>
                       </tr>
                       <tr>
                         <td class="descriptiontable" height="32"><?php echo $row_Recordset1['Description'];?></td>
                         <td class="descriptiontable"><?php echo $row_Recordset1['Date_Checkin'];?></td>
                         <td class="descriptiontable"><?php echo $row_Recordset1['Date_Checkout'];?></td>
                         <td class="descriptiontable">RM <?php echo $row_Recordset1['Price']; ?></td>
                       </tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">Days</td>
                         <td class="roomtype">: <?php $a = new Datetime($row_Recordset1['Date_Checkin']);
$b = new Datetime($row_Recordset1['Date_Checkout']);
$interval = $a->diff($b); echo $interval->format("%D");?></td>
                       </tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">GST (6%)</td>
                         <td class="roomtype">: RM <?php $x = $interval->format("%D"); 
$y = $row_Recordset1['Price'];
$g = ($x * $y)*0.06; echo $g; ?></td>
                       </tr>
                       <tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">Total</td>
                         <td class="roomtype">: RM <?php echo $row_Recordset1['Total']; ?></td>
                       </tr>
                     </table>
    </div></div>
<div id="homestay-sec" class="container set-pad" >
  <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <h1 align="center" class="header-line" >RESERVATION</h1>
              
<form name="form1" method="post" action="S_Reservation.php">
                     <p align="center">
                     <label for="textfield1"></label>
                     <input name="textfield1" type="text" class="textfield_Login widthregister searchreservation" placeholder="Reservation ID/Name/ Email/ IC " id="textfield1" value="<?php echo isset($_POST['textfield1'])?$var=mysql_escape_string($_POST['textfield1']):$var=""; ?>">   
                           
        <p>
                       <input type="submit" class="btn btn-primary btn-lg searchreservation" name="btnSearch" disabled id="btnSearch" value="Search"></form>
                 <?php  if(!isset($_POST['textfield1'])<="" && $row_Recordset1['Time']<="") {echo $index3="<p>Did not found reservation.</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";} else { ?>      
                         <?php  if (!empty($_POST)) { ?>   
                     <table width="300" border="0">
                       <tr class="roomtype">
                         <td width="25%"><div align="left">Reservation ID</div></td>
                         <td width="30%"><div align="left">Guest Name</div></td>
                         <td width="24%"><div align="left">Date Checkin</div></td>
                         <td width="17%"><div align="left">Status</div></td>
                         <td width="4%">&nbsp;</td>
                       </tr>
                       <?php do { ?>
                       <tr>
                         <td><div align="left"><?php echo $row_Recordset1['Reservation_ID']; ?></div></td>
                         <td><div align="left"><?php echo $row_Recordset1['Guest_Name']; ?></div></td>
                         <td><div align="left"><?php echo $row_Recordset1['Date_Checkin']; ?></div></td>
                         <td><div align="left"><?php echo $row_Recordset1['Status']; ?></div></td>
                         <td><a href="S_VReservation.php?ID=<?php echo $row_Recordset1['Reservation_ID']; ?>" onclick="javascript:void window.open('S_VReservation.php?ID=<?php echo $row_Recordset1['Reservation_ID']; ?>','1452488152659','width=950,height=800,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=100,top=100,directories=no,location=no');return false;">View</a></td>
                       </tr>
                         <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                     </table>
                     <p>                     
                 <p>                     
						
                     </p>
                  <?php } else { ?> <tr>
                             
				     <?php } } ?>

    </div>
  </div> 
</div>

         
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