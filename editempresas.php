<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $nomeempresa, $contacto, $localizacao, $lastname, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <div>
 <p><strong>ID:</strong> <?php echo $id; ?></p>
 <strong>NomeEmpresa: *</strong> <input type="text" name="nomeempresa" value="<?php echo $nomeempresa; ?>"/><br/>
 <strong>Contactos: *</strong> <input type="text" name="contacto" value="<?php echo $contacto; ?>"/><br/>
 <strong>Localizacao: *</strong> <input type="text" name="localizacao" value="<?php echo $localizacao; ?>"/><br/>
 <strong>Nome: *</strong> <input type="text" name="nomepessoacontactar" value="<?php echo $nomepessoacontactar; ?>"/><br/>
 <strong>Last Name: *</strong> <input type="text" name="endemail" value="<?php echo $endemail; ?>"/><br/>
 <p>* Required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html> 
 <?php
 }



 // connect to the database
 include('connect-dbempresas.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
 $nomeempresa = mysql_real_escape_string(htmlspecialchars($_POST['nomeempresa']));
 $contacto = mysql_real_escape_string(htmlspecialchars($_POST['contacto']));
 $localizacao = mysql_real_escape_string(htmlspecialchars($_POST['localizacao']));
 $nomepessoacontactar = mysql_real_escape_string(htmlspecialchars($_POST['nomepessoacontactar']));   
 $endemail = mysql_real_escape_string(htmlspecialchars($_POST['endemail']));
 // check that firstname/lastname fields are both filled in
 if ($nomeempresa == '' || $contacto == '' || $localizacao == '' || $nomepessoacontactar == '' || $endemail == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $nomeempresa, $contacto, $localizacao, $nomepessoacontactar, $endemail, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE players SET nomeempresa='$nomeempresa', contacto='$contacto', localizacao='$localizacao', nomepessoacontactar ='$nomepessoacontactar',endemail ='$endemail' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: viewempresas.php"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
 $id = $_GET['id'];
 $result = mysql_query("SELECT * FROM players WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $nomeempresa = $row['nomeempresa'];
 $contacto = $row['contacto'];
 $localizacao = $row['localizacao'];
 $nomepessoacontactar = $row['nomepessoacontactar'];
 $endemail = $row['endemail'];
      
 
 // show form
 renderForm($id, $nomeempresa, $contacto, $localizacao, $nomepessoacontactar,$endemail, '');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>