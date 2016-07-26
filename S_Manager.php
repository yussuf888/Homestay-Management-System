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

$colname_Recordset1 = "-1";
if (isset($_POST['txtname'])) {
  $colname_Recordset1 = $_POST['txtname'];
}
$colname1_Recordset1 = "-1";
if (isset($_POST['textfield1'])) {
  $colname1_Recordset1 = $_POST['textfield1'];
}
$colname2_Recordset1 = "-1";
if (isset($_POST['textfield2'])) {
  $colname2_Recordset1 = $_POST['textfield2'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM staff natural join shift WHERE S_IC = %s and (Work_Date BETWEEN %s and %s)", GetSQLValueString($colname_Recordset1, "text"),GetSQLValueString($colname1_Recordset1, "text"),GetSQLValueString($colname2_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_POST['txtname'])) {
  $colname_Recordset2 = $_POST['txtname'];
}
$colname1_Recordset2 = "-1";
if (isset($_POST['textfield1'])) {
  $colname1_Recordset2 = $_POST['textfield1'];
}
$colname2_Recordset2 = "-1";
if (isset($_POST['textfield2'])) {
  $colname2_Recordset2 = $_POST['textfield2'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = sprintf("SELECT *, SUM(HOUR(TIMEDIFF(Work_Checkout, Work_Checkin))) as `Hour`, SUM(Salary_PerHour *  HOUR(TIMEDIFF(Work_Checkout, Work_Checkin))) as 'Total' FROM SHIFT NATURAL JOIN STAFF WHERE S_IC = %s and (Work_Date between %s and %s)", GetSQLValueString($colname_Recordset2, "text"),GetSQLValueString($colname1_Recordset2, "text"),GetSQLValueString($colname2_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $MyHomeStay_System) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_POST['txtname'])) {
  $colname_Recordset3 = $_POST['txtname'];
}
$colname1_Recordset3 = "-1";
if (isset($_POST['textfield1'])) {
  $colname1_Recordset3 = $_POST['textfield1'];
}
$colname2_Recordset3 = "-1";
if (isset($_POST['textfield2'])) {
  $colname2_Recordset3 = $_POST['textfield2'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset3 = sprintf("SELECT * FROM staff natural join shift WHERE S_IC = %s and (Work_Date BETWEEN %s and %s)", GetSQLValueString($colname_Recordset3, "text"),GetSQLValueString($colname1_Recordset3, "text"),GetSQLValueString($colname2_Recordset3, "text"));
$Recordset3 = mysql_query($query_Recordset3, $MyHomeStay_System) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset4 = "SELECT * FROM staff";
$Recordset4 = mysql_query($query_Recordset4, $MyHomeStay_System) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

$maxRows_Recordset5 = 10;
$pageNum_Recordset5 = 0;
if (isset($_GET['pageNum_Recordset5'])) {
  $pageNum_Recordset5 = $_GET['pageNum_Recordset5'];
}
$startRow_Recordset5 = $pageNum_Recordset5 * $maxRows_Recordset5;

mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset5 = "SELECT * FROM shift natural join staff ORDER BY Work_Date DESC";
$query_limit_Recordset5 = sprintf("%s LIMIT %d, %d", $query_Recordset5, $startRow_Recordset5, $maxRows_Recordset5);
$Recordset5 = mysql_query($query_limit_Recordset5, $MyHomeStay_System) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);

if (isset($_GET['totalRows_Recordset5'])) {
  $totalRows_Recordset5 = $_GET['totalRows_Recordset5'];
} else {
  $all_Recordset5 = mysql_query($query_Recordset5);
  $totalRows_Recordset5 = mysql_num_rows($all_Recordset5);
}
$totalPages_Recordset5 = ceil($totalRows_Recordset5/$maxRows_Recordset5)-1;

$maxRows_Recordset6 = 10;
$pageNum_Recordset6 = 0;
if (isset($_GET['pageNum_Recordset6'])) {
  $pageNum_Recordset6 = $_GET['pageNum_Recordset6'];
}
$startRow_Recordset6 = $pageNum_Recordset6 * $maxRows_Recordset6;

mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset6 = "SELECT * FROM feedback ORDER BY Feedback_ID DESC";
$query_limit_Recordset6 = sprintf("%s LIMIT %d, %d", $query_Recordset6, $startRow_Recordset6, $maxRows_Recordset6);
$Recordset6 = mysql_query($query_limit_Recordset6, $MyHomeStay_System) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);

if (isset($_GET['totalRows_Recordset6'])) {
  $totalRows_Recordset6 = $_GET['totalRows_Recordset6'];
} else {
  $all_Recordset6 = mysql_query($query_Recordset6);
  $totalRows_Recordset6 = mysql_num_rows($all_Recordset6);
}
$totalPages_Recordset6 = ceil($totalRows_Recordset6/$maxRows_Recordset6)-1;

$queryString_Recordset5 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset5") == false && 
        stristr($param, "totalRows_Recordset5") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset5 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset5 = sprintf("&totalRows_Recordset5=%d%s", $totalRows_Recordset5, $queryString_Recordset5);

$queryString_Recordset6 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset6") == false && 
        stristr($param, "totalRows_Recordset6") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset6 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset6 = sprintf("&totalRows_Recordset6=%d%s", $totalRows_Recordset6, $queryString_Recordset6);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MANAGER</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/animation.css">
    
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
</div><div align="center">
                    <table width="747" height="190" border="0">
                      <tr></tr>
                     <tr>
                         <td height="45" colspan="7" class="reservationsummary">Salary Summary</td>
                       </tr>
                      <tr>
                      <tr><h2>&nbsp;<h2></tr>
                        <td width="120" class="roomtype">Name</td>
                               <td width="394">: <?php echo $row_Recordset1['S_Name']; ?></td>
                               <td width="68" class="roomtype">Date</td>
                               <td width="147">: <?php echo date("Y-m-d");?></td>
                      </tr>
                      <tr>
                        <td class="roomtype">IC No</td>
                        <td>: <?php echo $row_Recordset1['S_IC']; ?></td>
                        <td class="roomtype">Time</td>
                               <td>: <?php date_default_timezone_set ("Asia/Kuala_Lumpur"); echo date("H:i:s");?></td>
                      </tr>
                      <tr>
                        <td class="roomtype">Department</td>
                        <td>: <?php echo $row_Recordset1['S_Department']; ?></td>
                          <td class="roomtype">Start Date</td>
                               <td>: <?php echo isset($_POST['textfield1'])?$textfield1=mysql_escape_string($_POST['textfield1']):$textfield1=""; ?></td>
                      </tr>
                      <tr>
                        <td class="roomtype">Phone</td>
                        <td>: <?php echo $row_Recordset1['S_PhoneNumber']; ?></td>
                         <td class="roomtype">End Date</td>
                               <td>: <?php echo isset($_POST['textfield2'])?$textfield2=mysql_escape_string($_POST['textfield2']):$textfield2=""; ?></td>
                      </tr>
                    </table>
                    <p>&nbsp;</p>
                  </div><table width="300" border="0" align="center">
                    <tr class="roomtype">
                      <td width="16%" class="descriptiontable"><div align="center">Date</div></td>
                      <td width="18%" class="descriptiontable"><div align="center">Clockin Time</div></td>
                      <td width="19%" class="descriptiontable"><div align="center">Clockout Time</div></td>
                      <td width="17%" class="descriptiontable"><div align="center">Hours</div></td>
                      <td width="15%" class="descriptiontable"><div align="center">Salary/Hours</div></td>
                      <td width="15%" class="descriptiontable"><div align="center">Subtotal</div></td>
                    </tr><?php do { ?><tr align="center">
                        
                        <td><?php echo $row_Recordset3['Work_Date']; ?></td>
                          <td><?php echo $row_Recordset3['Work_Checkin']; ?></td>
                          <td><?php echo $row_Recordset3['Work_Checkout']; ?></td>
                          <td><?php $date1 = new DateTime($row_Recordset3['Work_Checkin']) ;
$date2 = new DateTime($row_Recordset3['Work_Checkout']); $diff = $date2->diff($date1); echo $hour=$diff->format('%h');

 ?></td>
                          <td>RM <?php echo $row_Recordset3['Salary_PerHour']; ?></td>
                          <td>RM <?php $SHour = $row_Recordset3['Salary_PerHour']; $Salary= $hour*$SHour; echo number_format($Salary,2);?></td>
                          
                      </tr><?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?><tr>
                        <td height="41"><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td class="roomtype"><div align="left">Total Hours</div></td>
                        <td class="roomtype"><div align="left">: <?php echo $row_Recordset2['Hour'];
?></div></td>
                      </tr>
                    <tr>
                        <td height="30"><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td class="roomtype"><div align="left">Total</div></td>
                        <td class="roomtype"><div align="left">: RM <?php echo $row_Recordset2['Total']; ?></div></td>
                      </tr></table></div>

                 <p>&nbsp;</p>
<div id="homestay-sec" class="container set-pad" ><div class="row text-center " >
 
  <div class="col-lg-4  col-md-4 col-sm-4 widthreses" style="width:650px;">
                          
                 <h1 class="header-line">WORKING TIME                 </h1>
                 <p>
    <form name="form1" method="post" action="S_Manager.php">
                  <p>
                    <label for="txtname"></label>
  <select name="txtname" id="txtname" class="form_control form_control1 textfieldw" style="cursor:pointer">
    <?php
do {  
?>
    <option style="cursor:pointer" value="<?php echo $row_Recordset4['S_IC']?>"><?php echo $row_Recordset4['S_IC']?>  (<?php echo $row_Recordset4['S_Name']?>)</option>
    
    <?php
} while ($row_Recordset4 = mysql_fetch_assoc($Recordset4));
  $rows = mysql_num_rows($Recordset4);
  if($rows > 0) {
      mysql_data_seek($Recordset4, 0);
	  $row_Recordset4 = mysql_fetch_assoc($Recordset4);
  }
?>
  </select>
  </p>
                  <p>
                    <input type="date" name="textfield1"  class="form_control1 textfieldw" id="textfield1" placeholder="Start Date"
  value="<?php echo isset($_POST['textfield1'])?$textfield1=mysql_escape_string($_POST['textfield1']):$textfield1=""; ?>">
                    <input type="date" name="textfield2" class="form_control1 textfieldw" id="textfield2" 
  value="<?php echo isset($_POST['textfield2'])?$textfield1=mysql_escape_string($_POST['textfield2']):$textfield2=""; ?>" placeholder="End Date">
                  </p>
                  <p>
                    <input type="submit" name="btnsearch" id="btnsearch" value="Search" class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment buttonworking">
                  </p>
                  <?php  if(!isset($_POST['textfield1'])<="" && $row_Recordset1['S_Name']<="") { ?>
                  <p>No working time.</p><?php } else { ?>
<?php  if (!empty($_POST)) { ?>
                  <div align="center">
                    <table width="300" border="0" class="margintable1234">
                      <tr>
                        <td width="40%" class="roomtype">Name </td>
                        <td width="60%">: <?php echo $row_Recordset1['S_Name']; ?></td>
                      </tr>
                      <tr>
                        <td class="roomtype">IC No</td>
                        <td>: <?php echo $row_Recordset1['S_IC']; ?></td>
                      </tr>
                      <tr>
                        <td class="roomtype">Department</td>
                        <td>: <?php echo $row_Recordset1['S_Department']; ?></td>
                      </tr>
                      <tr>
                        <td class="roomtype">Phone</td>
                        <td>: <?php echo $row_Recordset1['S_PhoneNumber']; ?></td>
                      </tr>
                    </table>
                    <p></p>
                  </div>
                  <table width="300" border="0" >
                    <tr class="roomtype">
                      <td width="16%" class="descriptiontable"><div align="center">Date</div></td>
                      <td width="18%" class="descriptiontable"><div align="center">Clockin Time</div></td>
                      <td width="19%" class="descriptiontable"><div align="center">Clockout Time</div></td>
                      <td width="17%" class="descriptiontable"><div align="center">Hours</div></td>
                      <td width="15%" class="descriptiontable"><div align="center">Salary/Hours</div></td>
                      <td width="15%" class="descriptiontable"><div align="center">Subtotal</div></td>
                    </tr>
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_Recordset1['Work_Date']; ?></td>
                        <td><?php echo $row_Recordset1['Work_Checkin']; ?></td>
                        <td><?php echo $row_Recordset1['Work_Checkout']; ?></td>
                        <td><?php $date1 = new DateTime($row_Recordset1['Work_Checkin']) ;
$date2 = new DateTime($row_Recordset1['Work_Checkout']); $diff = $date2->diff($date1); echo $hour=$diff->format('%h');

 ?></td>
                        <td>RM <?php echo $row_Recordset1['Salary_PerHour']; ?></td>
                        <td>RM <?php $SHour = $row_Recordset1['Salary_PerHour']; $Salary= $hour*$SHour; echo number_format($Salary,2);?></td>
                      </tr>
                                            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                      <tr>
                        <td height="41"><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td class="roomtype"><div align="left">Total Hours </div></td>
                        <td class="roomtype"><div align="left">: <?php echo $row_Recordset2['Hour'];
?></div></td>
                      </tr>
                    <tr>
                        <td height="30"><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td><div align="left"></div></td>
                        <td class="roomtype"><div align="left">Total </div></td>
                        <td class="roomtype"><div align="left">: RM <?php echo $row_Recordset2['Total']; ?></div></td>
                    </tr>
                  </table>
                  <p align="center"><input type="submit" name="btnsubmit" id="btnsubmit" value="Print" class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table3 widthprint" onClick="window.print()" formtarget="_new"></p>
    </form><?php } else { ?><table width="300" border="0" class="margintable12345">
  <tr class="roomtype">
    <td class="descriptiontable" width="40%" height="32"><div align="center">Name</div></td>
    <td class="descriptiontable" width="20%"><div align="center">Date</div></td>
    <td class="descriptiontable" width="20%"><div align="center">Clockin Time</div></td>
    <td class="descriptiontable" width="20%"><div align="center">Clockout Time</div></td>
   </tr>
  <?php do { ?>
    <tr>
      <td><div align="center"><?php echo $row_Recordset5['S_Name']; ?></div></td>
      <td><?php echo $row_Recordset5['Work_Date']; ?></td>
      <td><?php echo $row_Recordset5['Work_Checkin']; ?></td>
      <td><?php echo $row_Recordset5['Work_Checkout']; ?></td>
    </tr>
    <?php } while ($row_Recordset5 = mysql_fetch_assoc($Recordset5)); ?>
    <tr>
      <td colspan="4">&nbsp;
        <div align="center">
          <table border="0" class="table1">
            <tr>
              <td><?php if ($pageNum_Recordset5 > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Recordset5=%d%s", $currentPage, 0, $queryString_Recordset5); ?>"><img src="First.gif"></a>
                  <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_Recordset5 > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Recordset5=%d%s", $currentPage, max(0, $pageNum_Recordset5 - 1), $queryString_Recordset5); ?>"><img src="Previous.gif"></a>
                  <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_Recordset5 < $totalPages_Recordset5) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Recordset5=%d%s", $currentPage, min($totalPages_Recordset5, $pageNum_Recordset5 + 1), $queryString_Recordset5); ?>"><img src="Next.gif"></a>
                  <?php } // Show if not last page ?></td>
              <td><?php if ($pageNum_Recordset5 < $totalPages_Recordset5) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Recordset5=%d%s", $currentPage, $totalPages_Recordset5, $queryString_Recordset5); ?>"><img src="Last.gif"></a>
                  <?php } // Show if not last page ?></td>
              </tr>
          </table>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <?php } } ?>
  </div><div class="col-lg-4  col-md-4 col-sm-4 widthreses" style="width:500px;">               
  <h1 class="header-line" >FEEDBACK</h1>
    <p><table width="300" border="0">
    <tr class="roomtype">
          <td width="47%" height="33">Email</td>
          <td width="53%">Message</td>
        </tr>
                  <?php do { ?>
        <tr class="descriptiontable">
          <td width="47%" height="33"><div align="left"><?php echo $row_Recordset6['Guest_Email']; ?></div></td>
          <td width="53%"><div align="left"><?php echo $row_Recordset6['Feedback']; ?></div></td>
        </tr>
                <?php } while ($row_Recordset6 = mysql_fetch_assoc($Recordset6)); ?>
    </table>
<div align="right">Records <?php echo ($startRow_Recordset6 + 1) ?> to <?php echo min($startRow_Recordset6 + $maxRows_Recordset6, $totalRows_Recordset6) ?> of <?php echo $totalRows_Recordset6 ?></div>
</p>
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset6 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset6=%d%s", $currentPage, 0, $queryString_Recordset6); ?>"><img src="First.gif"></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset6 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset6=%d%s", $currentPage, max(0, $pageNum_Recordset6 - 1), $queryString_Recordset6); ?>"><img src="Previous.gif"></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset6 < $totalPages_Recordset6) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset6=%d%s", $currentPage, min($totalPages_Recordset6, $pageNum_Recordset6 + 1), $queryString_Recordset6); ?>"><img src="Next.gif"></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset6 < $totalPages_Recordset6) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset6=%d%s", $currentPage, $totalPages_Recordset6, $queryString_Recordset6); ?>"><img src="Last.gif"></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
  </div></div>
</body>


                   
  
    
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

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);

mysql_free_result($Recordset6);
?>
