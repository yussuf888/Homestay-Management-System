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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
<title>TERMS &amp; CONDITIONS</title>
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

<a class="navbar-brand" href="G_Homepage.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>




</ul>
</div>
</div>
</div>
<div class="row" ></div>
<div class="row" >
  </div>
</div>
<div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
               <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                 <div>
                   <h3 align="left">&nbsp;</h3>
                   <h3 align="left">TERMS AND CONDITIONS</h3>
                 </div>
                 <ul>
                   <li>
                     <div align="left">Check in: 2pm</div>
                   </li>
                   <li>
                     <div align="left">Check out: 12pm</div>
                   </li>
                   <li>
                     <div align="left">No pets allowed</div>
                   </li>
                   <li>
                     <div align="left">Terms and Conditions apply                 </div>
                   </li>
                 </ul>
                 <tr>
                 </tr>
                 </table>
                 <p> </p>
                     
                 <div align="right"></div>
                 <td class="lefttext"><div></div>
                   <div>
                                 <div align="left"></div>
                 </div></td>
               </div>

  </div>
</div>
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


<script>
$(function() {
      $(function() {
		        $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1});
    $( "#birthdate" ).datepicker();
  });
});
</script>
