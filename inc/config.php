<?php

$conn = mysql_connect("localhost", "root", "");
$select = mysql_select_db("messages");

if(!$conn || !$select){
	echo mysql_error();
}

?>