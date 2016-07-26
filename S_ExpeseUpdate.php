<?php require_once('Connections/MyHomeStay_System.php'); ?>
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
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM company_expenses WHERE Expense_ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE company_expenses SET Expense_Date=%s, `Description`=%s, Price=%s WHERE Expense_ID=%s",
                       GetSQLValueString($_POST['Expense_Date'], "date"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Price'], "double"),
                       GetSQLValueString($_POST['Expense_ID'], "int"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($updateSQL, $MyHomeStay_System) or die(mysql_error());

  echo $updateGoTo = "<script>
alert('Successfully update.');
window.close();
</script>";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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
<title>Expense Update</title>
</head>

<body>
<div id="homestay-sec" class="container set-pad" >
  <div class="row text-center"><div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
                   <div align="center">
                     <table align="center" class="margintable123">
                       <tr valign="baseline">
                         <td><div align="center">
                         <input type="hidden" name="Expense_ID"  value="<?php echo $_GET['ID']; ?>" size="32" class="form-control form_control1"/>
                           <input type="date" id="" required="required" name="Expense_Date" placeholder="Date" value="<?php echo $row_Recordset1['Expense_Date']; ?>" size="32" class="form-control form_control1"/>
                         </div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center">
                           <textarea name="Description" cols="50" required="required" placeholder="Description" rows="5" class="form-control form_control1"><?php echo $row_Recordset1['Description']; ?></textarea>
                         </div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center">
                           <input type="text" name="Price" required="required" value="<?php echo $row_Recordset1['Price']; ?>" placeholder="Price" size="32" class="form-control form_control1">
                         </div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center">
                           <input type="submit" value="Update Expense" class="btn btn-primary btn-lg buttonRegister" style="width:300px;">
                         </div></td>
                       </tr>
                     </table>
                   </div>
                   <input type="hidden" name="MM_update" value="form1" />
                 </form>
                 <p>&nbsp;</p>
               </div></div></div>
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
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function() {
	   $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1});
    $( "#datepicker" ).datepicker();
  });
  </script>