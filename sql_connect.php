<?php
$servername = "http://geldcrm.gear.host";
$username = "geldcrmdb";
$password = "GeldCrm123456789!";
mysql_connect($servername, $username, $password) or die("my life is a failure");
mysql_select_db("hermeslogin") or die("Database does not exists.");
?>
