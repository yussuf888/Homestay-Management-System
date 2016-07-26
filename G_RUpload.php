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
<title>PAYMENT SLIP</title>
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

<a class="navbar-brand" href=""><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
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
                 <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line" >BANK SLIP
                 </h1>
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
$var1=$_SESSION["id_Reservation"];        
$qry="UPDATE reservation SET PaymentProof_Slip='$image' WHERE Reservation_ID ='".$var1."'";
        $result=mysql_query($qry, $con);
        if($result)
        {
          echo "<br/><p data-scroll-reveal='enter from the bottom after 0.5s'>Successfully upload. Your payment will be confirm within 24 hours.</p>";
        }
        else
        {
          echo "<br/>Not uploaded.";
        }
		
      }
	  }
      ?>
                 <table data-scroll-reveal="enter from the bottom after 0.5s" width="747" height="190" border="0">
                             <tr>
                               <td colspan="2" class="roomtype"><div align="left"><form method="post" enctype="multipart/form-data" class="file-input-wrapper">
                  <div align="center">
                    <input type="file" name="PaymentProof_Slip" class="filestyle"  data-buttonName="btn-primary">

                    <br/>
                    <input type="submit" name="sumit" value="Upload" class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table2" />
                    </div>
               </form>
               </div><div align="left"></div><div align="left"></div><div align="left"></div></td>
                             </tr>
                 </table>
                 <tr>
                   <td>&nbsp;</td>
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
