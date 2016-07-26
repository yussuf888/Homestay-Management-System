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

$colname1_Recordset1 = "0";
if (isset($_POST['textfield2'])) {
  $colname1_Recordset1 = $_POST['textfield2'];
}
$colname_Recordset1 = "-1";
if (isset($_POST['textfield1'])) {
  $colname_Recordset1 = $_POST['textfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT DATE_FORMAT(Month, %s) AS Months, SUM(Total) AS Total, SUM(Price) AS Price, SUM(Total)-SUM(Price) AS Net_Revenue  FROM   (SELECT * FROM  (SELECT Month, Price, Total FROM  (SELECT R.DATE as Month, COALESCE((R.TOTAL),0) AS Total, COALESCE((E.PRICE),0) AS Price FROM (SELECT DATE, SUM(TOTAL) AS TOTAL FROM RESERVATION WHERE RESERVATION.STATUS='PAID'  GROUP BY DATE) as R LEFT OUTER JOIN (SELECT COALESCE(SUM(PRICE),0) AS PRICE, EXPENSE_DATE FROM COMPANY_EXPENSES GROUP BY EXPENSE_DATE) as E ON E.EXPENSE_DATE=R.DATE  UNION  SELECT E.Expense_DATE as DATE, COALESCE((R.TOTAL),0) AS Total, COALESCE((E.PRICE),0) AS Price FROM (SELECT DATE, SUM(TOTAL) AS TOTAL FROM RESERVATION WHERE RESERVATION.STATUS='PAID' GROUP BY DATE) as R RIGHT OUTER JOIN (SELECT COALESCE(SUM(PRICE),0) AS PRICE, EXPENSE_DATE FROM COMPANY_EXPENSES GROUP BY EXPENSE_DATE) as E ON E.EXPENSE_DATE=R.DATE) AS mys) as MYS1 ) AS MYZ2 WHERE Month LIKE %s GROUP BY DATE_FORMAT(Month,%s) ORDER BY Month", GetSQLValueString($colname1_Recordset1, "text"),GetSQLValueString("%" . $colname_Recordset1 . "%", "text"),GetSQLValueString($colname1_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname1_Recordset2 = "-1";
if (isset($_POST['textfield2'])) {
  $colname1_Recordset2 = $_POST['textfield2'];
}
$colname_Recordset2 = "-1";
if (isset($_POST['textfield1'])) {
  $colname_Recordset2 = $_POST['textfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = sprintf("SELECT SUM(Total) as total, SUM(Price) as price, SUM(Net_Revenue) as revenue FROM (SELECT DATE_FORMAT(Month, %s) AS Month, SUM(Total) AS Total, SUM(Price) AS Price, SUM(Total)-SUM(Price) AS Net_Revenue   FROM  ( SELECT * FROM (SELECT Month, Price, Total FROM ( SELECT R.DATE as Month, COALESCE((R.TOTAL),0) AS Total, COALESCE((E.PRICE),0) AS Price FROM (SELECT DATE, SUM(TOTAL) AS TOTAL FROM RESERVATION WHERE RESERVATION.STATUS='PAID' GROUP BY DATE) as R LEFT OUTER JOIN (SELECT COALESCE(SUM(PRICE),0) AS PRICE, EXPENSE_DATE FROM COMPANY_EXPENSES GROUP BY EXPENSE_DATE) as E ON E.EXPENSE_DATE=R.DATE  UNION  SELECT E.Expense_DATE as DATE, COALESCE((R.TOTAL),0) AS Total, COALESCE((E.PRICE),0) AS Price FROM (SELECT DATE, SUM(TOTAL) AS TOTAL FROM RESERVATION WHERE RESERVATION.STATUS='PAID' GROUP BY DATE) as R RIGHT OUTER JOIN (SELECT COALESCE(SUM(PRICE),0) AS PRICE, EXPENSE_DATE FROM COMPANY_EXPENSES GROUP BY EXPENSE_DATE) as E ON E.EXPENSE_DATE=R.DATE) AS mys) as MYS1 ) AS MYZ2 WHERE Month LIKE %s GROUP BY DATE_FORMAT(Month,%s)) as difference ", GetSQLValueString($colname1_Recordset2, "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString($colname1_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $MyHomeStay_System) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_POST['textfield1'])) {
  $colname_Recordset3 = $_POST['textfield1'];
}
$colname1_Recordset3 = "-1";
if (isset($_POST['textfield2'])) {
  $colname1_Recordset3 = $_POST['textfield2'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset3 = sprintf("SELECT DATE_FORMAT(Month, %s) AS Months, SUM(Total) AS Total, SUM(Price) AS Price, SUM(Total)-SUM(Price) AS Net_Revenue  FROM   (SELECT * FROM  (SELECT Month, Price, Total FROM  (SELECT R.DATE as Month, COALESCE((R.TOTAL),0) AS Total, COALESCE((E.PRICE),0) AS Price FROM (SELECT DATE, SUM(TOTAL) AS TOTAL FROM RESERVATION WHERE RESERVATION.STATUS='PAID'  GROUP BY DATE) as R LEFT OUTER JOIN (SELECT COALESCE(SUM(PRICE),0) AS PRICE, EXPENSE_DATE FROM COMPANY_EXPENSES GROUP BY EXPENSE_DATE) as E ON E.EXPENSE_DATE=R.DATE  UNION  SELECT E.Expense_DATE as DATE, COALESCE((R.TOTAL),0) AS Total, COALESCE((E.PRICE),0) AS Price FROM (SELECT DATE, SUM(TOTAL) AS TOTAL FROM RESERVATION WHERE RESERVATION.STATUS='PAID' GROUP BY DATE) as R RIGHT OUTER JOIN (SELECT COALESCE(SUM(PRICE),0) AS PRICE, EXPENSE_DATE FROM COMPANY_EXPENSES GROUP BY EXPENSE_DATE) as E ON E.EXPENSE_DATE=R.DATE) AS mys) as MYS1 ) AS MYZ2 WHERE Month LIKE %s GROUP BY DATE_FORMAT(Month,%s) ORDER BY Month", GetSQLValueString($colname1_Recordset3, "text"),GetSQLValueString("%" . $colname_Recordset3 . "%", "text"),GetSQLValueString($colname1_Recordset3, "text"));
$Recordset3 = mysql_query($query_Recordset3, $MyHomeStay_System) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>REVENUE</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <style type="text/css">

    #printable {display:none;}

    @media print
    {
    	#homestay-sec { display: none; }
    	#printable { display: block; }
		  #footer { display: none; }
    }
    </style>
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
<a class="navbar-brand" href="S_Manager.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="S_Manager.php">HOME</a></li>
<li><a href="S_MReservation.php">RESERVATION</a></li>
<li><a href="S_Guest.php">GUEST</a></li>
<li><a href="S_MStaff.php">STAFF</a></li>
<li><a href="S_MRevenue.php">REVENUE</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>

</ul>
</div>
</div>
</div>
<div class="row" ></div>
<p>&nbsp;</p>
<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <h1 class="header-line">REVENUE               </h1>
                 <form name="form1" method="post" action="S_MRevenue.php">
                   <p>
                     <label for="textfield1">
                       <input name="textfield1" type="text" class="form-control form_control1 widthrevenue" value="<?php echo isset($_POST['textfield1'])?$textfield1=mysql_escape_string($_POST['textfield1']):$textfield1=""; ?>" placeholder="Date (YYYY-MM-DD)"/>
                     </label>
                     <select name="textfield2" size="1" id="textfield2" class="yussuf888">
                       <option value="%d-%m-%Y">Day</option>
<option value="%m-%Y"><?php echo isset($_POST['Month'])?$textfield1=mysql_escape_string($_POST['Month']):$textfield2="Month"; ?></option>
<option value="%Y">Year</option>
                     </select>
                   </p>
                   <p>
                     <input name="search" type="submit" value="Search" class="btn btn-primary btn-lg buttonRegister buttonwidthrevenue"/>
                   </p>
                 </form>
                 <p>
                 <p>
                 <?php  if(!isset($_POST['textfield1'])<="" && $row_Recordset1['Total']<="") { ?><p>No record found.</p><?php } else { ?>
<?php  if (!empty($_POST['textfield1'])) { ?>
                 <div align="center">
                   <table width="600px" class="margintable12345" height="30" border="0"> 
                     <tr class="roomtype descriptiontable">
                       <td width="19%"><div align="center">Date</div></td>
                       <td width="27%"><div align="center">Revenue</div></td>
                       <td width="27%"><div align="center">Expense</div></td>
                       <td width="27%"><div align="center">Net Revenue</div></td>
                     </tr>
                     <?php do { ?>
                     <tr>
                       <td><div align="center"><?php echo $row_Recordset1['Months']; ?></div></td>
                       <td><div align="center">RM <?php echo $row_Recordset1['Total']; ?></div></td>
                       <td><div align="center">RM <?php echo $row_Recordset1['Price']; ?></div></td>
                       <td><div align="center">RM <?php echo $row_Recordset1['Net_Revenue']; ?></div></td>
                     </tr>
                     <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                     <tr class="roomtype descriptiontable">
                       <td><div align="center">Total</div></td>
                       <td><div align="center">RM <?php echo $row_Recordset2['total']; ?></div></td>
                       <td><div align="center">RM <?php echo $row_Recordset2['price']; ?></div></td>
                       <td><div align="center">RM <?php echo $row_Recordset2['revenue']; ?></div></td>
                     </tr>
                       
                   </table>
                   <p></p>
                   <p><input type="submit" name="btnsubmit" id="btnsubmit" value="Print" class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table3 widthprint" onClick="window.print()" formtarget="_new"></p>
                 </div>
                 </p>
                 <p>                                      <?php }else { echo $index3='Please enter date.'; }}?> <tr>
</p>
              
                     
                   
                
               </div>

             </div></div>
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
</div><div align="center"><table width="747" height="190" border="0">
                      <tr></tr>
                     <tr>
                         <td height="45" colspan="7" class="reservationsummary">Sales Revenue</td>
                       </tr>
                       <p><tr><h2>&nbsp;<h2></tr>
                        <td width="68" class="roomtype">Date</td>
                               <td width="147">: <?php echo date("Y-m-d");?></td>
                               <td width="120" class="roomtype"></td>
                               <td width="394"></td>
                      </tr></p>
                      
                        <p><tr>
                          <td class="roomtype">Time</td>
                               <td>: <?php date_default_timezone_set ("Asia/Kuala_Lumpur"); echo date("H:i:s");?></td>
                      </tr></p>
                    </table>
                    <table width="600px" class="" height="30" border="0"> 
                     <tr class="roomtype descriptiontable">
                       <td width="19%"><div align="center">Date</div></td>
                       <td width="27%"><div align="center">Revenue</div></td>
                       <td width="27%"><div align="center">Expense</div></td>
                       <td width="27%"><div align="center">Net Revenue</div></td>
                     </tr>
                     <?php do { ?>
  <tr class="margintable12345">
    <td><div align="center"><?php echo $row_Recordset3['Months']; ?></div></td>
    <td><div align="center">RM <?php echo $row_Recordset3['Total']; ?></div></td>
    <td><div align="center">RM <?php echo $row_Recordset3['Price']; ?></div></td>
    <td><div align="center">RM <?php echo $row_Recordset3['Net_Revenue']; ?></div></td>
  </tr>
  <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
                     <tr class="roomtype descriptiontable">
                       <td><div align="center">Total</div></td>
                       <td><div align="center">RM <?php echo $row_Recordset2['total']; ?></div></td>
                       <td><div align="center">RM <?php echo $row_Recordset2['price']; ?></div></td>
                       <td><div align="center">RM <?php echo $row_Recordset2['revenue']; ?></div></td>
                     </tr>
                       
                   </table>
                   </div></div>


<script type="text/javascript">
  document.getElementById('textfield2').value = "<?php echo $_POST['textfield2'];?>";
</script>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/scrollReveal.js"></script>
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
