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



$colname_Recordset1 = "-1";
if (isset($_GET['Description'])) {
  $colname_Recordset1 = $_GET['Description'];
}
$colname1_Recordset1 = "-1";
if (isset($_GET['Checkin'])) {
  $colname1_Recordset1 = $_GET['Checkin'];
}
$colname2_Recordset1 = "-1";
if (isset($_GET['Checkout'])) {
  $colname2_Recordset1 = $_GET['Checkout'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM reservation natural join guest natural join homestay WHERE Description = %s and Date_Checkin = %s and Date_Checkout = %s ORDER BY Reservation_ID DESC", GetSQLValueString($colname_Recordset1, "text"),GetSQLValueString($colname1_Recordset1, "text"),GetSQLValueString($colname2_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>RESERVATION SUMMARY</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="dropzone/dropzone.css" rel="stylesheet" type="text/css">
</head>
<body >
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
<style type="text/css">

    #printable { display: none; }

    @media print
    {
    	#homestay-sec { display: none; }
    	#printable { display: block; }
		  #footer { display: none; }
    }
    </style>

</ul>
</div>
</div>
</div>
<div class="row" ></div>
<div class="row" ></div>
<p>&nbsp;</p>
</div>

<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <h1 class="header-line" >SUMMARY</h1>
              
<form name="form1" method="post" action="G_Payment.php">
                     <p align="center">
                     <label for="textfield1"></label>
                     <p>
                                            
               <?php
    if(isset($_POST['sumit']))
      {
        if(getimagesize($_FILES['PaymentProof_Slip']['tmp_name']) == FALSE)
        {
          echo "Please select an image.";
        }
        else
        {
          $image= addslashes($_FILES['PaymentProof_Slip']['tmp_name']);
          $name= addslashes($_FILES['PaymentProof_Slip']['name']);
          $image= file_get_contents($image);
          $image= base64_encode($image);
      
        $con=mysql_connect("localhost", "root", "");
        mysql_select_db("myhomestay",$con);
echo $var1=40;        
$qry="UPDATE reservation SET PaymentProof_Slip='$image' WHERE Reservation_ID LIKE '%".$var1."%'";
        $result=mysql_query($qry, $con);
        if($result)
        {
          echo "<br/>Successfully upload.";
        }
        else
        {
          echo "<br/>Not uploaded.";
        }
		
      }
	  }
      ?>
                 </form>
<table width="747" height="190" border="0">
                             <tr>
                               <td width="153" class="roomtype">Name</td>
                               <td width="393"><div align="left">: <?php echo $row_Recordset1['Guest_Name']; ?></div></td>
                               <td width="71" class="roomtype">Date</td>
                               <td width="157"><div align="left">: <?php echo $row_Recordset1['Date']; ?></div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Email</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Guest_Email']; ?></div></td>
                               <td class="roomtype">Time</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Time']; ?></div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">IC/ Passport No</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Guest_IC']; ?></div></td>
                               <td class="roomtype">Status</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Status']; ?></div></td>
                             </tr>
                             <tr>
                               <td class="roomtype">Phone</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Guest_PhoneNumber']; ?></div></td>
                               <td class="roomtype">Res ID</td>
                               <td><div align="left">: <?php echo $row_Recordset1['Reservation_ID']; ?></div></td>
                             </tr>
                 </table></td>
                       </tr>
                       <tr>
                         <td>&nbsp;</td>
                     </tr>
                     </table>
                     <table width="200" border="0">
                       <tr>
                         <td width="394" height="45" class="roomtype">Homestay  Type</td>
                         <td width="118" class="roomtype">Checkin</td>
                         <td width="118" class="roomtype">Checkout</td>
                         <td width="123" class="roomtype">Rate per/night</td>
                       </tr>
                       <tr>
                         <td class="descriptiontable" height="32"><div align="left"><?php echo $row_Recordset1['Description']; ?></div></td>
                         <td class="descriptiontable"><div align="left"><?php echo $row_Recordset1['Date_Checkin']; ?></div></td>
                         <td class="descriptiontable"><div align="left"><?php echo $row_Recordset1['Date_Checkout']; ?></div></td>
                         <td class="descriptiontable"><div align="left">RM <?php echo $row_Recordset1['Price']; ?></div></td>
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
$g = ($x * $y)*0.06; echo number_format($g,2); ?></td>
                       </tr>
                       <tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">Total</td>
                         <td class="roomtype">: RM <?php echo $row_Recordset1['Total']; ?></td>
					   </tr>
                     </table>
                     <p> </p>
                     
                 <div align="right">
                     <input type="submit" name="btnsubmit" id="btnsubmit" value="Print" class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table3" onClick="window.print()" formtarget="_new">
                   
                 </div>
                 <td class="lefttext"><div></div>
                               <div>
                                 <div align="left"></div>
                                 </tr>
               </div></td>
               </div>

             </div>
             <!--/.HEADER LINE END-->


           <div class="row" ></div>
             </div>
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
                               <td class="roomtype">Reservation ID</td>
                               <td>: <?php echo $row_Recordset1['Reservation_ID']; ?></td>
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
$g = ($x * $y)*0.06; echo number_format($g,2); ?></td>
                       </tr>
                       <tr>
                       <tr>
                         <td height="37">&nbsp;</td>
                         <td>&nbsp;</td>
                         <td class="roomtype">Total</td>
                         <td class="roomtype">: RM <?php echo $row_Recordset1['Total']; ?></td>
                       </tr>
                     </table>
    </div></div></div>
<?php $_SESSION['id_Reservation']= $row_Recordset1['Reservation_ID']; ?>

    
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
?>
