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

$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  echo $MM_dupKeyRedirect="<script>
alert('Email already been registered.');
window.location.href='Guest_Index.php#login-sec';
</script>";
  $loginUsername = $_POST['Guest_Email'];
  $LoginRS__query = sprintf("SELECT Guest_Email FROM guest WHERE Guest_Email=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $LoginRS=mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);


  if($loginFoundUser){
    $MM_qsChar = "?";

    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form6")) {
  $insertSQL = sprintf("INSERT INTO guest (Guest_Email, Guest_Name, Guest_IC, Guest_BirthDate, Guest_Gender, Guest_Address, Guest_City, Guest_State, Guest_Country, Guest_PhoneNumber, Guest_Password) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Guest_Email'], "text"),
                       GetSQLValueString($_POST['Guest_Name'], "text"),
                       GetSQLValueString($_POST['Guest_IC'], "text"),
                       GetSQLValueString($_POST['Guest_BirthDate'], "date"),
                       GetSQLValueString($_POST['Guest_Gender'], "text"),
                       GetSQLValueString($_POST['Guest_Address'], "text"),
                       GetSQLValueString($_POST['Guest_City'], "text"),
                       GetSQLValueString($_POST['Guest_State'], "text"),
                       GetSQLValueString($_POST['Guest_Country'], "text"),
                       GetSQLValueString($_POST['Guest_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['Guest_Password'], "text"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($insertSQL, $MyHomeStay_System) or die(mysql_error());
    echo $email=$_POST['Guest_Email'];
  $insertGoTo = "G_RegisterSuccess2.php?email=$email";
  if (!isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form20")) {
  $insertSQL = sprintf("INSERT INTO feedback (Guest_Email, Feedback) VALUES (%s, %s)",
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['message'], "text"));

  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  $Result1 = mysql_query($insertSQL, $MyHomeStay_System) or die(mysql_error());

  $insertGoTo = "G_FeedbackSuccess.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
<?php
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['txtemail'])) {
  $loginUsername=$_POST['txtemail'];
  $password=$_POST['txtpassword'];
  $MM_fldUserAuthorization = "Verify";
  $MM_redirectLoginSuccess = "G_Homepage.php";
  $MM_redirectLoginFailed = "G_LoginFail2.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
  	
  $LoginRS__query=sprintf("SELECT Guest_Email, Guest_Password, Verify FROM guest WHERE Guest_Email=%s AND Guest_Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyHomeStay_System) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'Verify');
    
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
     <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
     <script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="css/css.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript">

$(document).ready(function() {
	$('#Loading').hide();    
});

function check_username(){

	var username = $("#username").val();
	if(username.length > 2){
		$('#Loading').show();
		$.post("check_username_availablity.php", {
			username: $('#username').val(),
		}, function(response){
			$('#Info').fadeOut();
			 $('#Loading').hide();
			setTimeout("finishAjax('Info', '"+escape(response)+"')", 450);
		});
		return false;
	}
}


function finishAjax(id, response){
 
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn(1000);
} 

</script>
<style>
        .jssora05l, .jssora05r {
            display: block;
            position: absolute;
            width: 40px;
            height: 40px;
            cursor: pointer;
            background: url('img/a17.png') no-repeat;
            overflow: hidden;
        }
        .jssora05l { background-position: -10px -40px; }
        .jssora05r { background-position: -70px -40px; }
        .jssora05l:hover { background-position: -130px -40px; }
        .jssora05r:hover { background-position: -190px -40px; }
        .jssora05l.jssora05ldn { background-position: -250px -40px; }
        .jssora05r.jssora05rdn { background-position: -310px -40px; }

        
        .jssort01-99-66 .p {
            position: absolute;
            top: 0;
            left: 0;
            width: 99px;
            height: 66px;
        }
        
        .jssort01-99-66 .t {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .jssort01-99-66 .w {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
        }
        
        .jssort01-99-66 .c {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 95px;
            height: 62px;
            border: #000 2px solid;
            box-sizing: content-box;
            background: url('img/t01.png') -800px -800px no-repeat;
            _background: none;
        }
        
        .jssort01-99-66 .pav .c {
            top: 2px;
            _top: 0px;
            left: 2px;
            _left: 0px;
            width: 95px;
            height: 62px;
            border: #000 0px solid;
            _border: #fff 2px solid;
            background-position: 50% 50%;
        }
        
        .jssort01-99-66 .p:hover .c {
            top: 0px;
            left: 0px;
            width: 97px;
            height: 64px;
            border: #fff 1px solid;
            background-position: 50% 50%;
        }
        
        .jssort01-99-66 .p.pdn .c {
            background-position: 50% 50%;
            width: 95px;
            height: 62px;
            border: #000 2px solid;
        }
        
        * html .jssort01-99-66 .c, * html .jssort01-99-66 .pdn .c, * html .jssort01-99-66 .pav .c {
            width /**/: 99px;
            height /**/: 66px;
        }
		
        
    </style>
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
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
                <a class="navbar-brand" href="Guest_Index.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
            </div>
           <div class="navbar-collapse collapse move-me">
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="#home">HOME</a></li>
                     <li><a href="#homestay-sec">FIND HOMESTAY</a></li>
                    <li><a href="#login-sec">LOGIN/REGISTER</a></li>
                     <li><a href="#register-sec">ATTRACTIONS</a></li>
                     <li><a href="#aboutus-sec">ABOUT US</a></li>
                     <li><a id="onclick">FEEDBACK</a></li>

               </ul>
            </div>
           
        </div></div></div>

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
           <div class="row text-center" >
           
               <div class="col-lg-12  col-md-12 col-sm-12">
               
        <h2 data-scroll-reveal="enter from the bottom after 0.1s" ><i class="fa fa-circle-o-notch"></i>WELCOME TO SUNFLOWER HOUSE MALACCA<i class="fa fa-circle-o-notch"></i></h2>

                   </div>
               </div>
             </div>
        
    </div>
     
           <div id="homestay-sec" class="container set-pad" >
             <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.3s"  class="header-line">FIND HOMESTAY</h1>
                     
                   <form data-scroll-reveal="enter from the bottom after 0.5s" name="form1" method="post" action="#homestay-sec" >
                     <p>
                       <label for="txtCheckin"></label>
                       <input name="txtCheckin" type="text" class="textfield_Login widthregister" required="required" readonly id="checkin"  placeholder="Check in Date" value="<?php echo isset($_POST['txtCheckin'])?$Checkin=mysql_escape_string($_POST['txtCheckin']):$Checkin=""; ?>">
                       <label for="txtCheckout"></label>
                       <input name="txtCheckout" type="text" class="textfield_Login widthregister" required="required" readonly id="checkout" placeholder="Check out Date" value="<?php echo isset($_POST['txtCheckout'])?$Checkout=mysql_escape_string($_POST['txtCheckout']):$Checkout=""; ?>">
                     </p>
                     <p>
                       <input name="BtnSearch" type="submit" class="btn btn-primary btn-lg" id="BtnSearch" value="Search" />
                     </p>
                       <?php
    isset($_POST['txtCheckin'])?$Checkin=mysql_escape_string($_POST['txtCheckin']):$Checkin="";
	isset($_POST['txtCheckout'])?$Checkout=mysql_escape_string($_POST['txtCheckout']):$Checkout="";

	?>
                   </form>
                   <p data-scroll-reveal="enter from the bottom after 0.3s">
                      <?php  if(!isset($_POST['txtCheckin'])<="" && $_POST['txtCheckout']<="") {echo $index3="Please select check in and check out date.";} else { ?>

                     <?php  if (!empty($_POST)) { ?>
                   </p>
                   
                   <p>&nbsp; </p>
                   <form name="form2" method="post" action="_target">
                     <table width="718" height="117" border="0">
                     <?php 
					 if($row_Search_Reservation1 <= "") {echo $INDEX1="No homestay available.";}
					 else { ?>
                       <tr data-scroll-reveal="enter from the bottom after 0.3s" class="header_homestay">
                       	 <td width="47" height="30" ><div align="left"></div></td>
                         <td width="394" data-scroll-reveal="enter from the bottom after 0.5s"><div align="left"><strong>Description</strong></div></td>
                         <td width="184" data-scroll-reveal="enter from the bottom after 0.5s"><div align="left"><strong>Price</strong></div></td>
                         <td width="149"><div align="left"></div></td>
                       </tr>
                       <?php do { ?>
                       <tr data-scroll-reveal="enter from the bottom after 0.5s">
                         <td></td>
                         <td height="20" class="body_homepage"><div align="left"><?php echo $row_Search_Reservation1['Description']; ?></div></td>
                         <td><div align="left">RM <span class="body_homepage"><?php echo $row_Search_Reservation1['Price']; ?></span></div></td>
                         <td><a href="G_RLogin.php?ID=<?php echo $row_Search_Reservation1['Homestay_ID']?>&Description=<?php echo $row_Search_Reservation1['Description']?>&Checkin=<?php echo $Checkin; ?>&Checkout=<?php echo $Checkout; ?>" class="buttonize">   Book   </td>
                       </tr>
                         <?php } while ($row_Search_Reservation1 = mysql_fetch_assoc($Search_Reservation1)); ?>
                         <?php } ?>
                  	
					                        
                         
                     </table>
                   </form>
                   <p>&nbsp;</p>
                   <p data-scroll-reveal="enter from the bottom after 0.5s">
                     <?php } else {echo $INDEX2="Please select check in and check out date.";} }?>
                   </p>
                   <p>&nbsp; </p>
                 </div>
             </div>
           </div>
              

    <div id="login-sec" >
    <div class="overlays">
    <div class="container set-pad">
             <div class="row text-center">
               
               <div class="col-lg-4  col-md-4 col-sm-4 widthreses" >
                 <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">LOG IN</h1>
                   <form data-scroll-reveal="enter from the bottom after 0.3s" id="form3" name="form3" method="POST" action="<?php echo $loginFormAction; ?>">
                       <p align="center">
                         <label for="txtemail"></label>
                         <input name="txtemail" type="text" class="form-control" id="txtemail" placeholder="Email Address" required="required" autocomplete="off" />
                       </p>
                     <p align="center">
                       <label for="txtpassword"></label>
                       <input type="password" name="txtpassword" class="form-control" id="txtpassword" placeholder="Password" required="required" autocomplete="off" />
                     </p>
                     <p align="center">
                       <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-success form-control btn-lg buttonRegister" value="Log In" />
                   
                 </form>
 <p data-scroll-reveal="enter from the bottom after 0.3s"><a class="forgotp colorforgot" onclick="javascript:void window.open('G_ForgotP.php','1452488152659','width=600,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=0,left=400,top=200,directories=no,location=no');return false;">Click here if forgot the password</a></p>                     <p>&nbsp;</p>
                 </div>
<div class="col-lg-4  col-md-4 col-sm-4 widthreses">
                 <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">REGISTER</h1>
                 
                 <form  action="<?php echo $editFormAction; ?>" method="POST" name="form6" id="form6">
                 
                   <div align="center">
                     <table width="725" data-scroll-reveal="enter from the bottom after 0.3s" align="center" class="widthregister">
                       <tr valign="baseline">
                         <td width="350"><div align="center"><span id="sprytextfield2">
                         <input type="text" name="Guest_Name" placeholder="Full Name" required="required" class="form-control"  value="" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td width="350"><div align="center"><span id="sprytextfield15">
                         <input type="text" name="Guest_IC" placeholder="Identity Card/Passport No" class="form-control"  value="" size="32" required="required" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center"><span id="sprytextfield3"><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td valign="baseline"><div align="center">
                           <input type="date" name="Guest_BirthDate" placeholder="Birthday Date (YYYY-MM-DD)" id="birthdate" class="form-control" value="" size="32" required="required" />
                           <table width="231" border="0" class="table1">
                             <tr>
                               <td width="99"><div align="center">
                                 <input type="radio" name="Guest_Gender" value="Male" required="required" />
                                 Male</div></td>
                               <td width="91"><div align="center">
                                 <input type="radio" name="Guest_Gender" value="Female" required="required" />
                               Female</div></td>
                             </tr>
                           </table>
                         </div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center"><span id="sprytextfield1">
                         <input type="text" id="username" onblur="return check_username()"  name="Guest_Email" placeholder="Email Address" class="form-control" required="required" value="" size="32" /><div id="Info"></div>
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center"><span id="sprytextarea1">
                           <textarea name="Guest_Address" cols="50" placeholder="Address" required="required" class="form-control" rows="5"></textarea>
                         <span class="textareaRequiredMsg">A value is required.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center"><span id="sprytextfield4">
                         <input type="text" name="Guest_City" placeholder="City" required="required" class="form-control" value="" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center"><span id="sprytextfield5">
                         <input type="text" name="Guest_State" placeholder="State" required="required" class="form-control" value="" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center"><span id="sprytextfield6">
                         <input type="text" name="Guest_Country" placeholder="Country" required="required" class="form-control" value="" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center"><span id="sprytextfield7">
                         <input type="text" name="Guest_PhoneNumber" placeholder="Phone Number" required="required" class="form-control" value="" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center"><span id="sprytextfield8">
                         <input type="password" name="Guest_Password" id="password" required="required" placeholder="Password" class="form-control" value="" size="32" />
                         <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center"><span id="spryconfirm1">
                           <input name="Guest_Password1" type="password" class="form-control" required="required" id="password1" placeholder="Confirm Password" value="" size="32" />
                         <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">Passwords not matching.</span></span></div></td>
                       </tr>
                       <tr valign="baseline">
                         <td><div align="center">
                           <input type="submit" id="register" class="btn btn-success form-control btn-lg buttonRegister" value="Register" />
                         </div></td>
                       </tr>
                     </table>
                     <input type="hidden" name="MM_insert" value="form6" />
                   </div>
                 </form>
                 <p>&nbsp;</p>
               </div>

             
        </div>
         </div></div></div>

      <div id="register-sec" class="container set-pad">
             <div class="row text-center">
             <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">ATTRACTIONS</h1>
             <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 bottomend" data-scroll-reveal="enter from the bottom after 0.2s" style="background-image:url(Images/Jonker%20Street.jpg); background-size:cover; margin:auto; height:300px; width:50%; padding:0px;"><p class="fonttransparent">Jonker Street in Melaka is one of the best places for tourists to visit due to the fact that the place is very historical and cultural in its roots. There are many shop outlets and stalls such as food stalls, art and craft stalls, souvenir stalls, and clothing stalls here. All these stalls are very much culturally prepared and thus, if guests like to have a taste on the local cultural, Jonker Street would definitely be thebest place to be. It takes approximately 15 minutes to drive from the hotel.</p></div>
             <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 bottomend" data-scroll-reveal="enter from the bottom after 0.2s" style="background-image:url(Images/melaka%20river%20cruise.jpg); background-size:cover; margin:auto; height:300px; padding:0px; width:50%;"><p class="fonttransparent">Experience the spectacular cruise down the River Melaka 9km away for 45 minutes while enjoying the beautiful scenery, buildings and shop houses relics Dutch era, traditional Malay houses and many other interesting sights of world heritage relics. It takes approximately 13 minutes to drive from the hotel.</p></div>
             <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 bottomend" data-scroll-reveal="enter from the bottom after 0.3s" style="background-image:url(Images/Taming%20Sari%20Tower.jpg); background-size:cover; margin:auto; padding:0px; height:300px; width:50%;"><p class="fonttransparent">Bear witness panoramic views and the overall view of historical sites in Malacca World Heritage City at a height of 80 meters. You definitely excited to see the beauty and uniqueness of historical attractions such as St. Paul, Heroes Square Melaka Megamall, the Big Island and the Strait of Malacca. In addition, you'll see rapid development in the state of Malacca. Certainly you ride experience Taming Sari Tower will become unforgettable memories. It takes approximately 13 minutes to drive from the hotel.<p></div>
             <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 bottomend" data-scroll-reveal="enter from the bottom after 0.3s" style="background-image:url(Images/A%20Famosa.jpg); background-size:cover; margin:auto; height:300px; padding:0px; width:50%;"><p class="fonttransparent">A Famosa (Porta De Santiago) is the gate of the city fortress in Malacca. This gate is the legacy of Portuguese and a fort that was so strong in the past. The fort was first having a long wall and four major towers. One of the main four - story tower, while the other is a weapon storage room, residential quarters for the captain and officers. It takes approximately 10 minutes to drive from the hotel.<p></div>
                 <p>&nbsp;</p>
                 <p></p>

                 
               

        </div>
        </div>
    

    <div id="contactdiv">
<form method="POST" name="form20" action="<?php echo $editFormAction; ?>" id="contact">
<img src="images/close.png" width="25" height="25" class="img" id="cancel"/>
<h1 align="center" class="header-line fheading" data-scroll-reveal="enter from the bottom after 0.5s" >FEEDBACK</h1>
<div align="center">
  <p><span id="sprytextfield9">
  <input class="form-control form_control1" name="email" type="text" id="email" placeholder="Email" required="required"/>
  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span><span id="sprytextarea2">
  <textarea rows="3" name="message" required="required" class="form-control form_control1" id="message" placeholder="Feedback...."></textarea>
  <span class="fheading" id="countsprytextarea2">&nbsp;</span><span class="textareaRequiredMsg">Please enter the feedback.</span><span class="textareaMaxCharsMsg">Exceeded maximum number of characters.</span></span>
  <p></p>
  <input type="submit" class="btn btn-primary btn-lg buttonRegister buttonmarginchar" id="send" value="Submit"/>
    </p>
  <p><br/>
  </p>
</div>
<input type="hidden" name="MM_insert" value="form20" />
</form>
</div>

    <div id="aboutus-sec"   >
           <div class="overlay">
 <div class="container set-pad">
      <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line" >ABOUT US  </h1>
                     <p data-scroll-reveal="enter from the bottom after 0.3s"> The modern interior design and spacious living and dining hall together with a simple kitchen will provide you a better staying experience. 
                    It is ideal for families on vacation in Malacca or travellers in small groups or groups more than 150 guests. It is also suitable for people 
                    who need spacious accommodation for special occasions.</p>
                  <p data-scroll-reveal="enter from the bottom after 0.3s"> Within minutes of drive, you can reach most of the tourist attraction spots, shopping 
                    complexes, major business center and famous eateries that serve authentic food like the “Nyonya” 
                    dishes, chicken rice balls, “satay celup” and ancient shops hawking their heirlooms and antiques that 
                    can be found only in Malacca. Make your vacation worthwhile, Rent a house, explore the quaint Malacca 
                    and enjoy the sights of this newly awarded world heritage city.</p>
                  <h2 data-scroll-reveal="enter from the bottom after 0.3s"><div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 960px; height: 480px; overflow: hidden; visibility: hidden; background-color: #24262e;">
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 240px; width: 720px; height: 480px; overflow: hidden;">
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/01.jpg" />
                <img data-u="thumb" src="img/thumb-01.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/02.jpg" />
                <img data-u="thumb" src="img/thumb-02.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/03.jpg" />
                <img data-u="thumb" src="img/thumb-03.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/04.jpg" />
                <img data-u="thumb" src="img/thumb-04.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/05.jpg" />
                <img data-u="thumb" src="img/thumb-05.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/06.jpg" />
                <img data-u="thumb" src="img/thumb-06.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/07.jpg" />
                <img data-u="thumb" src="img/thumb-07.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/08.jpg" />
                <img data-u="thumb" src="img/thumb-08.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/09.jpg" />
                <img data-u="thumb" src="img/thumb-09.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/10.jpg" />
                <img data-u="thumb" src="img/thumb-10.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/11.jpg" />
                <img data-u="thumb" src="img/thumb-11.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/12.jpg" />
                <img data-u="thumb" src="img/thumb-12.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/13.jpg" />
                <img data-u="thumb" src="img/thumb-13.jpg" />
            </div>
            <div data-p="150.00" style="display: none;">
                <img data-u="image" src="img/14.jpg" />
                <img data-u="thumb" src="img/thumb-14.jpg" />
            </div>
        </div>
        <div data-u="thumbnavigator" class="jssort01-99-66" style="position:absolute;left:0px;top:0px;width:240px;height:480px;" data-autocenter="2">
            <div data-u="slides" style="cursor: default;">
                <div data-u="prototype" class="p">
                    <div class="w">
                        <div data-u="thumbnailtemplate" class="t"></div>
                    </div>
                    <div class="c"></div>
                </div>
            </div>
        </div>
        <span data-u="arrowleft" class="jssora05l" style="top:158px;left:248px;width:40px;height:40px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;" data-autocenter="2"></span>
        <a href="http://www.jssor.com" style="display:none">Bootstrap Carousel</a>
    </div></h2>
                 </div>

      </div>
           <div class="row set-row-pad"  data-scroll-reveal="enter from the bottom after 0.5s" ></div>
                </div>
          </div> 
       </div>
     <div class="container">
             <div class="row set-row-pad"  >
    <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 bottomend " data-scroll-reveal="enter from the bottom after 0.4s">

                    <h2 ><strong>Our Location </strong></h2>
        <hr />
                    <div>
                        <h4>Sunflower House Malacca,</h4>
                        <h4>No. 57, Jalan PJ 1,</h4>
                        <h4>Taman Pertam Jaya,</h4>
                        <h4>75050 Melaka,</h4>
                        <h4>Malaysia.</h4>
                        <h4><strong>Call:</strong>  +606-282-1500 </h4>
                   </div>


                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 bottomend" data-scroll-reveal="enter from the bottom after 0.4s">

                    <h2 ><strong>Follow Us</strong></h2>
        <hr />
                    <div >
                        <a target="_blank" href="https://www.facebook.com/Sunflowerhousemalacca/?fref=ts">  <img src="assets/img/Social/facebook.png" alt="" /> </a>
                     <a target="_blank" href="https://plus.google.com/114364031259478729789/posts/p/pub?hl=en"> <img src="assets/img/Social/google-plus.png" alt="" /></a>
                     <a target="_blank" href="https://twitter.com/SUNFLOWERHOUSEM"> <img src="assets/img/Social/twitter.png" alt="" /></a>
                    </div>
                    </div>


                </div>
                 </div>

<div id="footer">
          MOHAMED YUSSUF BIN JAHUBAR SATHIK | © 2016 SUNFLOWER HOUSE MALACCA| All Rights Reserved |  <a style="color: #fff" target="_blank"></a>
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
  
 <script>
        jQuery(document).ready(function ($) {
            
            var jssor_1_SlideshowTransitions = [
              {$Duration:1200,$Zoom:1,$Easing:{$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2},
              {$Duration:1000,$Zoom:11,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Zoom:1,$Rotate:1,$During:{$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:{$Zoom:$Jease$.$Swing,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1000,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1200,x:0.5,$Cols:2,$Zoom:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:4,$Cols:2,$Zoom:11,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:{$Left:$Jease$.$Swing,$Zoom:$Jease$.$Swing,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1000,x:-4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1200,x:-0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:{$Left:$Jease$.$Swing,$Zoom:$Jease$.$Swing,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1000,x:4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1200,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1000,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1200,x:-4,y:2,$Rows:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Row:28},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1200,x:1,y:2,$Cols:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:19},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.8}}
            ];
            
            var jssor_1_options = {
              $AutoPlay: true,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Rows: 2,
                $Cols: 6,
                $SpacingX: 14,
                $SpacingY: 12,
                $Orientation: 2,
                $Align: 156
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            

            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 960);
                    refSize = Math.max(refSize, 300);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);

        });
    </script>
 <script>
$(function() {
      $.datepicker.setDefaults({dateFormat: 'yy-mm-dd', firstDay: 1});
      $('#checkin').datepicker({minDate: +2,maxDate: "+6M", onSelect: function(selectedDate) {
            var minDate = $(this).datepicker('getDate');
            if (minDate) {
                  minDate.setDate(minDate.getDate() + 1);
            }
            $('#checkout').datepicker('option', 'minDate', minDate || 1); // Date + 1 or tomorrow by default
      }});
      $('#checkout').datepicker({minDate: +3,maxDate: "+7M", onSelect: function(selectedDate) {
            var maxDate = $(this).datepicker('getDate');
            if (maxDate) {
                  maxDate.setDate(maxDate.getDate() - 1);
            }
            $('#checkin').datepicker('option', 'maxDate', maxDate); // Date - 1
      }});
	   
      
});
   

var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email", {minChars:5, maxChars:100, validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"], minChars:3, maxChars:30});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {validateOn:["blur"], isRequired:false});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"], minChars:2, maxChars:50});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"], minChars:2, maxChars:50});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], minChars:2, maxChars:50});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer", {validateOn:["blur"], minChars:5});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur"], minChars:5, maxChars:20});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "none", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "email", {validateOn:["blur"], minChars:3, maxChars:100, useCharacterMasking:true});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur"], minChars:0, maxChars:200, counterId:"countsprytextarea2", counterType:"chars_remaining"});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["blur", "change"]});
 </script>
 
</body>
</html>
<?php
mysql_free_result($Search_Reservation1);
?>
