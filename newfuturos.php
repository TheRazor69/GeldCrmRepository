<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($empre, $tit, $cate, $data, $val, $error)
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
 <strong>empresa: *</strong> <input type="text" name="empresa" value="<?php echo $empre; ?>" /><br/>
 <strong>titlo: *</strong> <input type="text" name="titlo" value="<?php echo $tit; ?>" /><br/>
 <strong>categoria: *</strong> <input type="text" name="categoria" value="<?php echo $cate; ?>" /><br/>
 <strong>dataentrega: *</strong> <input type="text" name="dataentrega" value="<?php echo $data; ?>" /><br/>
 <strong>valor: *</strong> <input type="text" name="valor" value="<?php echo $val; ?>" /><br/>
 
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
 $empresa = mysql_real_escape_string(htmlspecialchars($_POST['empresa']));
 $titlo = mysql_real_escape_string(htmlspecialchars($_POST['titlo']));
 $categoria = mysql_real_escape_string(htmlspecialchars($_POST['categoria']));
 $dataentrega = mysql_real_escape_string(htmlspecialchars($_POST['dataentrega']));
 $valor = mysql_real_escape_string(htmlspecialchars($_POST['valor']));
 // check to make sure both fields are entered
 if ($empresa == '' || $titlo == '' || $categoria == '' || $dataentrega == '' || $valor == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($empresa, $titlo, $categoria, $dataentrega, $valor, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT players SET empresa='$empresa', titlo='$titlo', categoria='$categoria', dataentrega='$dataentrega', valor='$valor'")
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