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
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset1 = sprintf("SELECT * FROM reservation WHERE Guest_Email = %s ORDER BY Reservation_ID DESC", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $MyHomeStay_System) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_MyHomeStay_System, $MyHomeStay_System);
$query_Recordset2 = sprintf("SELECT * FROM guest WHERE Guest_Email = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $MyHomeStay_System) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ABOUT US</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="Style/homepage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
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
            width : 99px;
            height: 66px;
        }
        
    </style>
    <style type="text/css">
    #NAMESLIP {
	position: fixed;
	width: auto;
	height: 40px;
	padding:5px;
	padding-left:15px;
	padding-right:10px;
	z-index: 5;
	right: 0px;
	top: 85px;
	background-color:#168A8F;
	font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
	color:#fff;
	-webkit-border-top-left-radius: 20px;
	-webkit-border-bottom-left-radius: 20px;
	-moz-border-radius-topleft: 20px;
	-moz-border-radius-bottomleft: 20px;
	border-top-left-radius: 20px;
	border-bottom-left-radius: 20px;
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
<a class="navbar-brand" href="G_HomepageUnverify.php"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
</div>
<div class="navbar-collapse collapse move-me">
<ul class="nav navbar-nav navbar-right">
<li ><a href="G_HomepageUnverify.php">HOME</a></li>
					<li><a href="G_Profile2.php">PROFILE</a></li>
               		<li><a href="G_About2.php">ABOUT US</a></li>
<li><a onclick="return confirm('Press OK to logout.')" href="<?php echo $logoutAction ?>">LOGOUT</a></li>


</ul>
</div>
</div>
</div>
<div id="NAMESLIP"><p>Hi, <?php echo $row_Recordset2['Guest_Name']; ?><p></div>
<div class="row" ></div>
</div>.
<div id="homestay-sec" class="container set-pad" >
             
                   <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line" >ABOUT US  </h1>
                     <p data-scroll-reveal="enter from the bottom after 0.5s"> The modern interior design and spacious living and dining hall together with a simple kitchen will provide you a better staying experience. 
                    It is ideal for families on vacation in Malacca or travellers in small groups or groups more than 150 guests. It is also suitable for people 
                    who need spacious accommodation for special occasions.</p>
                  <p data-scroll-reveal="enter from the bottom after 0.7s"> Within minutes of drive, you can reach most of the tourist attraction spots, shopping 
                    complexes, major business center and famous eateries that serve authentic food like the “Nyonya” 
                    dishes, chicken rice balls, “satay celup” and ancient shops hawking their heirlooms and antiques that 
                    can be found only in Malacca. Make your vacation worthwhile, Rent a house, explore the quaint Malacca 
                    and enjoy the sights of this newly awarded world heritage city.</p>
                  <h2 data-scroll-reveal="enter from the bottom after 0.9s"><div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 960px; height: 480px; overflow: hidden; visibility: hidden; background-color: #24262e;">
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
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                 </div>

             </div>


           <div class="row" ></div>
             </div>
  

<div id="footer">
         MOHAMED YUSSUF BIN JAHUBAR SATHIK | © 2016 SUNFLOWER HOUSE MALACCA| All Rights Reserved |  <a style="color: #fff" target="_blank"></a>
   </div>
    
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/scrollReveal.js"></script>
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jssor.slider.mini.js"></script>
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
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
