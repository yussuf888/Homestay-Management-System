<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_MyHomeStay_System = "localhost";
$database_MyHomeStay_System = "myhomestay";
$username_MyHomeStay_System = "root";
$password_MyHomeStay_System = "";
$MyHomeStay_System = mysql_pconnect($hostname_MyHomeStay_System, $username_MyHomeStay_System, $password_MyHomeStay_System) or trigger_error(mysql_error(),E_USER_ERROR); 
?>