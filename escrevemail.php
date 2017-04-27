<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($pers, $emai, $subjec, $messag, $dat, $tim, $error)
 {
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hermes 2016</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
    <!-- Page Content -->
    <div class="container">
<?php

// Ignore Warnings
error_reporting(E_ALL & ~E_NOTICE & ~8192);

// Connect to Database
require_once "inc/config.php";

// Days,Hours,Minutes Time Format
require_once "inc/time.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inbox System</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.js"></script>
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
 <font color="white"><strong>Person: *</strong><input type="text" name="person" value="<?php echo $pers; ?>" /></font><br/>
 <font color="white"><strong>Email: *</strong> <input type="text" name="email" value="<?php echo $emai; ?>" /></font><br/>
 <font color="white"><strong>Subject: *</strong> <input type="text" name="subject" value="<?php echo $subjec; ?>" /></font><br/>
 <font color="white"><strong>Message: *</strong> <input type="text" name="message" value="<?php echo $messag; ?>" /></font><br/>
 <font color="white"><strong>Date: *</strong> <input type="text" name="date" value="<?php echo $dat; ?>" /></font><br/>
 <font color="white"><strong>Time: *</strong> <input type="text" name="time" value="<?php echo $tim; ?>" /></font><br/>
      
 
 <input type="submit" name="submit" value="Submit"></font>
 </div>
 </form> 
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

</body>

</html>

<?php 
 }
 // connect to the database
 include('connect-gmail.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 $person = mysql_real_escape_string(htmlspecialchars($_POST['person']));   
 $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
 $subject = mysql_real_escape_string(htmlspecialchars($_POST['subject']));
 $message = mysql_real_escape_string(htmlspecialchars($_POST['message']));
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 $time = mysql_real_escape_string(htmlspecialchars($_POST['time']));
 // check to make sure both fields are entered
 if ($person == '' || $email == '' || $subject == '' || $message == '' || $date == '' || $time == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($person, $email, $subject, $message,$date, $time, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT messages SET person='$person', email='$email', subject='$subject', message='$message', date='$date', time='$time'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: email.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','','','','','');
 }
?>
