<?php
$acessgranted = false;
require ('sql_connect.php');
if (isset($_POST['submit'])){
$username=mysql_escape_string($_POST['name']);
$password=mysql_escape_string($_POST['password']);
if (!$_POST['name'] | !$_POST['password'])
 {
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You did not complete all of the required fields')
        window.location.href='index.html'
        </SCRIPT>");
exit();
     }
$sql= mysql_query("SELECT * FROM `hermeslogin` WHERE `name` = '$username' AND `password` = '$password'");
if(mysql_num_rows($sql) > 0)
{
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Login Succesfully!.')
        window.location.href='Mainpage.html'
        </SCRIPT>");
echo 
exit();
}
else{
echo (
    "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Wrong username password combination.Please re-enter.')
        window.location.href='index.html'
        </SCRIPT>");
exit();
}
}
else{
}
?>
