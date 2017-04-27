<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($nomeemp, $contac, $local, $nomepessoacon, $email, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>New Record</title>
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
 <div>
 <strong>Nomeempresa: *</strong> <input type="text" name="nomeempresa" value="<?php echo $nomeemp; ?>" /><br/>
 <strong>Contacto: *</strong> <input type="text" name="contacto" value="<?php echo $contac; ?>" /><br/>
 <strong>Localizacao: *</strong> <input type="text" name="localizacao" value="<?php echo $local; ?>" /><br/>
 <strong>Nomepessoacontactar: *</strong> <input type="text" name="nomepessoacontactar" value="<?php echo $nomepessoacon; ?>" /><br/>
 <strong>Email: *</strong> <input type="text" name="endemail" value="<?php echo $email; ?>" /><br/>
 <p>* required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html>
 <?php 
 }
 // connect to the database
 include('connect-db.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 $nomeempresa = mysql_real_escape_string(htmlspecialchars($_POST['nomeempresa']));
 $contacto = mysql_real_escape_string(htmlspecialchars($_POST['contacto']));
 $localizacao = mysql_real_escape_string(htmlspecialchars($_POST['localizacao']));
 $nomepessoacontactar = mysql_real_escape_string(htmlspecialchars($_POST['nomepessoacontactar']));
 $endemail = mysql_real_escape_string(htmlspecialchars($_POST['endemail']));
 
 // check to make sure both fields are entered
 if ($nomeempresa == '' || $contacto == '' || $localizacao == '' || $nomepessoacontactar == '' || $endemail == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($nomeempresa,$contacto,$localizacao,$nomepessoacontactar,$endemail, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT players SET nomeempresa='$nomeempresa', contacto='$contacto', localizacao='$localizacao', nomepessoacontactar='$nomepessoacontactar', endemail='$endemail'")
 or die(mysql_error()); 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','','','','');
 }
?>