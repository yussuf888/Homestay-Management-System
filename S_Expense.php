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
  $insertSQL = sprintf("INSERT INTO company_expenses (Expense_Date, `Description`, Price) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Expense_Date'], "date"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Price'], "double"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($insertSQL, $MyHomeStay_System) or die(mysql_error());

  $insertGoTo = "S_Expense.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_Recordset1 = 5;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = "SELECT * FROM company_expenses ORDER BY Expense_Date DESC";
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

$colname_Recordset2 = "-1";
if (isset($_POST['txtfield1'])) {
  $colname_Recordset2 = $_POST['txtfield1'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = sprintf("SELECT * FROM company_expenses WHERE Description LIKE %s OR Expense_Date LIKE  %s ORDER BY Expense_Date DESC", GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"));
$Recordset2 = mysql_query($query_Recordset2, $MyHomeStay_System) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

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
    <title>EXPENSES</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
<a class="navbar-brand" href="S_FDHomepage.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="S_FDHomepage.php">HOME</a></li>
<li><a href="S_Expense.php">EXPENSE</a></li>
<li><a href="S_Revenue.php">REVENUE</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>

</ul>
</div>
</div>
</div>
<div class="row" ></div>
<p>&nbsp;</p>
<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-4  col-md-4 col-sm-4 widthreses">
                 <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                   <div align="center">
                     <table align="center" class="margintable123">
                       <tr><p>&nbsp;</p></tr>
                       <tr><p>&nbsp;</p></tr>
                       <tr valign="baseline">
                         <td><div align="center">
                           <input type="date" id="" required name="Expense_Date" placeholder="Date" value="" size="32" class="form-control form_control1"/>
                         </div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center">
                           <textarea name="Description" required cols="50" placeholder="Description" rows="5" class="form-control form_control1"></textarea>
                         </div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center">
                           <input type="text" name="Price" value="" required placeholder="Price" size="32" class="form-control form_control1">
                         </div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center">
                           <input type="submit" value="Add Expense" class="btn btn-primary btn-lg buttonRegister" style="width:300px;">
                         </div></td>
                       </tr>
                     </table>
                     <input type="hidden" name="MM_insert" value="form1">
                   </div>
                 </form>
                 <p>&nbsp;</p>
               </div>
               <div class="col-lg-4  col-md-4 col-sm-4 widthreses">               
                 <p>&nbsp;</p><p>&nbsp;</p>
                 <form name="form30" method="post" action="S_Expense.php">
                     <p align="center">
                     <label for="textfield1"></label>
                     <input name="txtfield1" id="txtfield1" type="text" class="textfield_Login widthregister searchreservation" placeholder="Description/Date" value="<?php echo isset($_POST['txtfield1'])?$var=mysql_escape_string($_POST['txtfield1']):$var=""; ?>">                     
                     <p>
                       <input type="submit" class="btn btn-primary btn-lg searchreservation" name="btnSearch" id="btnSearch" value="Search">
                 </form>
                 <?php  if(!isset($_POST['txtfield1'])<="" && $row_Recordset2['Price']<="") {echo $index3="<p>No matching expenses found.</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                      ";} else { ?>
                 <?php  if (!empty($_POST)) { ?>
                 <table width="300" border="0">
                   <tr class="roomtype">
                     <td width="18%" height="44"><div align="left">Date</div></td>
                     <td width="47%"><div align="left">Expense</div></td>
                     <td width="10%" class="roomtype"><div align="left">Price</div></td>
                     <td width="12%"><div align="left"></div></td>
                     <td width="13%"><div align="left"></div></td>
                   </tr>
                  <?php do { ?>
                   <tr>
                     
                     <td><div align="left"><?php echo $row_Recordset2['Expense_Date']; ?></div></td>
                     <td><div align="left"><?php echo $row_Recordset2['Description']; ?></div></td>
                     <td width="10%"><div align="left"><?php echo $row_Recordset2['Price']; ?></div></td>
                     <td width="12%"><div align="center"><a href="S_ExpeseUpdate.php?ID=<?php echo $row_Recordset2['Expense_ID']; ?>" onclick="javascript:void window.open('S_ExpeseUpdate.php?ID=<?php echo $row_Recordset2['Expense_ID']; ?>','1452488152659','width=650,height=750,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=200,top=180,directories=no,location=no');return false;">Edit</a></div></td>
                     <td width="13%"><div align="center"><a href="delete_expense.php?Expenses_ID=<?php echo $row_Recordset2['Expense_ID']; ?>" onclick="return confirm('Press Ok button, if you want to delete')">Delete</a></div></td>
                       
                   </tr><?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                
                   <tr>
                     <td height="44" colspan="5"><div align="center"></div>
                       <div align="left"></div>
                       <div align="left"></div>
                       <div align="left"></div>
                       <div align="left"></div></td>
                   </tr>
                 </table>
                 <p>
        <?php } else {?>
      </p>
                 <table width="300" border="0">
        <tr class="roomtype">
                     <td width="18%" height="44"><div align="left">Date</div></td>
                     <td width="47%"><div align="left">Expense</div></td>
                   <td width="10%" class="roomtype"><div align="left">Price</div></td>
                     <td width="12%"><div align="left"></div></td>
                     <td width="13%"><div align="left"></div></td>
                   </tr>
    <?php do { ?>   <tr>
          
            <td><div align="left"><?php echo $row_Recordset1['Expense_Date']; ?></div></td>
            <td><div align="left"><?php echo $row_Recordset1['Description']; ?></div></td>
            <td width="10%"><div align="left"><?php echo $row_Recordset1['Price']; ?></div></td>
            <td width="12%"><div align="center"><a href="S_ExpeseUpdate.php?ID=<?php echo $row_Recordset1['Expense_ID']; ?>" onclick="javascript:void window.open('S_ExpeseUpdate.php?ID=<?php echo $row_Recordset1['Expense_ID']; ?>','1452488152659','width=500,height=470,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=400,top=180,directories=no,location=no');return false;">Edit</a></div></td>
            <td width="13%"><div align="center"><a href="delete_expense.php?Expenses_ID=<?php echo $row_Recordset1['Expense_ID']; ?>" onclick="return confirm('Press Ok button, if you want to delete')">Delete</a></div></td>
            
        </tr><?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        <tr>
                     <td height="44" colspan="5"><div align="center">
                       <table border="0">
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
                       </table>
                     </div>                       
                     <div align="left"></div>                       <div align="left"></div>                       <div align="left"></div>                       <div align="left"></div></td>
                   </tr>
      </table>
                 <p align="right">&nbsp;</p>
                 <p>
                   <?php }}?>
                 </p>
                 
                 </p>
                 <p>&nbsp;</p>
    </div>

             </div></div>

  
 <script>
  $(function() {
	   $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1});
    $( "#datepicker" ).datepicker();
  });
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
?>
