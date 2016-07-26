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
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
$loginFormAction1 = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
$loginFormAction2 = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
$loginFormAction3 = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['txtusername'])) {
  $loginUsername=$_POST['txtusername'];
  $password=$_POST['txtpassword'];
  $MM_fldUserAuthorization = "S_Department";
  $MM_redirectLoginSuccess = "S_RDHomepage.php";
  $MM_redirectLoginFailed = "S_LoginFail.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  	
  $LoginRS__query=sprintf("SELECT S_Username, S_Password, S_Department FROM staff WHERE S_Username=%s AND S_Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'S_Department');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}

if (isset($_POST['txtusername1'])) {
  $loginUsername=$_POST['txtusername1'];
  $password=$_POST['txtpassword1'];
  $MM_fldUserAuthorization = "S_Department";
  $MM_redirectLoginSuccess = "S_HRDHomepage.php";
  $MM_redirectLoginFailed = "S_LoginFail.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  	
  $LoginRS__query=sprintf("SELECT S_Username, S_Password, S_Department FROM staff WHERE S_Username=%s AND S_Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'S_Department');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
if (isset($_POST['txtusername2'])) {
  $loginUsername=$_POST['txtusername2'];
  $password=$_POST['txtpassword2'];
  $MM_fldUserAuthorization = "S_Department";
  $MM_redirectLoginSuccess = "S_FDHomepage.php";
  $MM_redirectLoginFailed = "S_LoginFail.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  	
  $LoginRS__query=sprintf("SELECT S_Username, S_Password, S_Department FROM staff WHERE S_Username=%s AND S_Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'S_Department');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
if (isset($_POST['txtusername3'])) {
  $loginUsername=$_POST['txtusername3'];
  $password=$_POST['txtpassword3'];
  $MM_fldUserAuthorization = "S_Department";
  $MM_redirectLoginSuccess = "S_Manager.php";
  $MM_redirectLoginFailed = "S_LoginFail.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  	
  $LoginRS__query=sprintf("SELECT S_Username, S_Password, S_Department FROM staff WHERE S_Username=%s AND S_Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'S_Department');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>STAFF LOGIN</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />  
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Abril Fatface">  
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
	<link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
     <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
<link href="css/css.css" media="screen" rel="stylesheet" type="text/css" />
<style>
::-webkit-input-placeholder { 
  color: #FFF;
  line-height: 1.0;
}
.login123
{
  visibility: hidden;
}
#boxe1:hover .login123 {
	visibility:visible;
	transition: ease-in;
	transition-delay: 0.1s
}
#boxe2:hover .login123 {
	visibility:visible;
	transition: ease-in;
	transition-delay: 0.1s
}
#boxe3:hover .login123 {
	visibility:visible;
	transition: ease-in;
	transition-delay: 0.1s
}
#boxe4:hover .login123 {
	visibility:visible;
	transition: ease-in;
	transition-delay: 0.1s
}

</style>

<body> 
 	

      <div class="home-sec" id="home" >
           <div class="overlay">
<div class="container">
           <div class="row text-center " >
               <div class="col-lg-12  col-md-12 col-sm-12">

           <div class="flexslider set-flexi" id="main-section" >
          <ul class="slides move-me">

                         
                              <h3>IT'S ALWAYS SUNNY SOMEWHERE</h3>
                           <h1>THE UNIQUE HOMESTAY</h1>
                          
                          


             </ul>  
                </div>
             </div>
      </div>
             </div>

           </div>
           
    </div>
    <div  class="tag-line" >
         <div class="container">
           <div class="row text-center" >
           
               <div class="col-lg-12  col-md-12 col-sm-12">
               
        <h2 data-scroll-reveal="enter from the bottom after 0.1s" ><i class="fa fa-circle-o-notch"></i>SUNFLOWER HOUSE MALACCA<i class="fa fa-circle-o-notch"></i></h2>

             </div>
           </div>
        
    </div>
    </div>



          
    <div data-scroll-reveal="enter from the bottom after 0.3s" id="register-sec">
      <div class="row text-center containerstaff">
      
        <div id="boxe1" class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 widthstaff box1">
        
          <p>&nbsp;</p>
          <p>RECEPTIONIST</p>
          <p>DEPARTMENT</p>
          <p>&nbsp;</p>
          <div class="login123">

		<form name="form1" action="<?php echo $loginFormAction; ?>" method="POST">
          <p align="center">
            <input class="txtbox1" name="txtusername" type="text" id="txtusername" placeholder="Username" />
          </p>
          <p align="center">
            <input class="txtbox1" type="password" name="txtpassword" id="txtpassword" placeholder="Password" />
          </p>
          <p align="center">
            <input type="submit" name="button" id="button" value="Log In" class="btn btn-primary btn-lg buttonlogin" />
          </p>
          
		</form>

	</div>
        </div>
        <div id="boxe2" class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 widthstaff box1">
          <p>&nbsp;</p>
          <p>HUMAN RESOURCE</p>
           <p>DEPARTMENT</p>
          <p>&nbsp;</p>
          <div class="login123">

		<form name="form2" action="<?php echo $loginFormAction1; ?>" method="post">
          <p align="center">
            <input class="txtbox1" name="txtusername1" type="text" id="txtusername1" placeholder="Username" />
          </p>
          <p align="center">
            <input class="txtbox1" type="password" name="txtpassword1" id="txtpassword1" placeholder="Password" />
          </p>
          <p align="center">
            <input type="submit" name="button" id="button" value="Log In" class="btn btn-primary btn-lg buttonlogin" />
          </p>
          
		</form>

	</div>
        </div>
        <div id="boxe3" class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 widthstaff box1">
          <p>&nbsp;</p>
          <p>FINANCE</p>
          <p>DEPARTMENT</p>
          <p>&nbsp;</p>
          <div class="login123">

		<form name="form3" action="<?php echo $loginFormAction2; ?>" method="post">
          <p align="center">
            <input class="txtbox1" name="txtusername2" type="text" id="txtusername2" placeholder="Username" />
          </p>
          <p align="center">
            <input class="txtbox1" type="password" name="txtpassword2" id="txtpassword2" placeholder="Password" />
          </p>
          <p align="center">
            <input type="submit" name="button" id="button" value="Log In" class="btn btn-primary btn-lg buttonlogin" />
          </p>
          
		</form>

	</div>
        </div>
        <div id="boxe4" class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 widthstaff box1">
        <p>&nbsp;</p>
          <p>MANAGER</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <div class="login123">

		<form name="form4" action="<?php echo $loginFormAction3; ?>" method="post">
          <p align="center">
            <input class="txtbox1" name="txtusername3" type="text" id="txtusername3" placeholder="Username" />
          </p>
          <p align="center">
            <input class="txtbox1" type="password" name="txtpassword3" id="txtpassword3" placeholder="Password" />
          </p>
          <p align="center">
            <input type="submit" name="button" id="button" value="Log In" class="btn btn-primary btn-lg buttonlogin" />
          </p>
          
		</form>

	</div>
        </div>
        
      </div>
    </div>
   
    
    <script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery_popup.js"></script>
    <script type="text/javascript" src="js/jssor.slider.mini.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/jquery.flexslider.js"></script>
    <script src="assets/js/scrollReveal.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
 
</body>
</html>
<?php
?>
