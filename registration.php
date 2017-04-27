<?php     //start php tag
//include connect.php page for database connection
include('connect.php');
//if submit is not blanked i.e. it is clicked.
if(isset($_REQUEST['submit'])!='')
{
if($_REQUEST['name']=='' || $_REQUEST['password']=='' || $_REQUEST['email']==''|| $_REQUEST['repassword']=='')
{
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You did not complete all of the required fields')
        window.location.href='index.html'
        </SCRIPT>");
}
else
{
$sql="insert into hermeslogin(name,password,email) values('".$_REQUEST['name']."', '".$_REQUEST['password']."', '".$_REQUEST['email']."')";

$res=mysql_query($sql);
if($res)
{
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Voçe foi registado com sucesso.')
        window.location.href='index.html'
        </SCRIPT>");
}
else
{
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('There was a problem inserting into the server try again in 30s.')
        window.location.href='index.html'
        </SCRIPT>");
}

}
}

?>
