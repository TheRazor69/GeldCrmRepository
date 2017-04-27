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

   <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Mainpage.html">Menu principal</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contactos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="contactos.php">Gerir</a>
                            </li>
                        </ul>
                    </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Empresas<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="Adicionaempresa.php">Gestao de empresas</a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Projetos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="ProjectosAtuais.php">Projectos actuais</a>
                            </li>
                            <li>
                                <a href="ProjectosFuturos.php">Projectos Futuros</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Orçamentos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="testedeupload.html">Anexar Orçamento</a>
                            </li>
                            <li>
                                <a href="Consulta.php">Consulta</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Email <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="escrevemail.php">Email enviar</a>
                            </li>
                            <li>
                                <a href="email.php">Email Pessoal</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Outras Paginas <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="about.html">Sobre nos</a>
                            </li>
                            <li>
                                <a href="sidebar.html">Sidebar Page</a>
                            </li>
                            <li>
                                <a href="faq.html">FAQ</a>
                            </li>
                            <li>
                                <a href="404.html">404</a>
                            </li>
                            <li>
                                <a href="pricing.html">Pricing Table</a>
                            </li>
                            <li>
                                <a href="services.html">serviços</a>
                            </li>
                            <li>
                                <a href="contact.html">contact</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

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

<script type="text/javascript">

$("body").prepend('<div id="loading"><img src="img/loading.gif" alt="Loading.." title="Loading.." /></div>');

$(window).load(function(){
	$("#inbox, #msg").fadeIn("slow");
	$("#loading").fadeOut("slow");
});

</script>

<?php
	if(isset($_GET['msg'])){

		$id = $_GET['msg'];
		mysql_query("UPDATE messages SET open = '1' WHERE id = '$id'");
		$msg = mysql_query("SELECT * FROM messages WHERE id = '$id'");
		$row = mysql_fetch_assoc($msg);
			$person = $row['person'];
			$email = $row['email'];
			$date = $row['date'];
			$time = time_passed($row['time']);
			$message = $row['message'];
?>

<div id="msg">

<a href="email.php">← Back to Inbox</a>

<table>
	<tr>
		<td>person : <strong><?php echo $person; ?></strong></td>
		<td>Email : <strong><?php echo $email; ?></strong></td>
		<td>Date : <strong><?php echo $date; ?></strong></td>
		<td>Time : <strong><?php echo $time; ?></strong></td>
	</tr>
</table>

<pre><?php echo $message; ?></pre>

<a class="remove btn danger" href="?remove=<?php echo $id; ?>">Delete this message</a>

</div>

<script type="text/javascript">

$('.remove').click(function(){
	var agree=confirm("Are you sure you?");
	if (agree) {
		return true;
	}else {
		return false;
	}
});

</script>

<?php

exit();

} else if(isset($_GET['remove'])){
	$id = $_GET['remove'];
	$remove = mysql_query("DELETE FROM messages WHERE id = '$id'");
	if($remove){
		echo '<script>window.location = "./"</script>';
	}else {
		die("Please Refresh the page.");
	}
	exit();
} else {
?>
<div id="inbox">
	<table>

		<tr>

			<th width="10%">#</th>
			<th>Person</th>
			<th>Email</th>
			<th>Subject</th>
			<th>Sent</th>
			<th>Seen</th>

		</tr>

			<?php

				$limit = 5;
				$p = $_GET['p'];

				$get_total = mysql_num_rows(mysql_query("SELECT * FROM messages"));
				$total = ceil($get_total/$limit);

				if(!isset($p)){
					$offset = 0;
				}else if($p == '1'){
					$offset = 0;
				}else if($p <= '0'){
					$offset = 0;
					echo '<script>window.location = "./";</script>';
				}else {
					$offset = ($p - 1) * $limit;
				}

				$inbox = mysql_query("SELECT * FROM messages LIMIT $offset,$limit");
				$rows = mysql_num_rows($inbox);
				while($row = mysql_fetch_assoc($inbox)){
					$id = $row['id'];
					$person = $row['person'];
					$email = $row['email'];

					if(strlen($row['subject']) >= 50){
						$subject = substr($row['subject'],0,50)."..";
					}else {
						$subject = $row['subject'];
					}

					$message = $row['message'];
					$date = $row['date'];
					$time = time_passed($row['time']);
					if($row['open'] == '1'){
						$open = '<img src="img/open.png" alt="Opened" title="Opened" />';
					}else {
						$open = '<img src="img/not_open.png" alt="Opened" title="Opened" />';
					}

					echo '<tr class="border_bottom">';
						echo '<td><a href="?msg='.$id.'">'.$id.'</a></td>';
						echo '<td><a href="?msg='.$id.'">'.$person.'</a></td>';
						echo '<td><a href="?msg='.$id.'">'.$email.'</a></td>';
						echo '<td><a href="?msg='.$id.'">'.$subject.'</a></td>';
						echo '<td><a href="?msg='.$id.'">'.$date.' - '.$time.'</a></td>';
						echo '<td><a href="?msg='.$id.'">'.$open.'</a></td>';
					echo '</tr>';

				}

				if($rows <= 0){
					echo '<tr><td width="100%">There\'s no messages at this moment, check back later!</td></tr>';
				}

			?>
	</table>

	<?php if($get_total > $limit){ ?>

		<div id="pages">

			<?php
				for($i=1; $i<$total; $i++){
					echo ($i == $p) ? '<a class="btn active">'.$i.'</a>' : '<a class="btn" href="?p='.$i.'">'.$i.'</a>';
				}
			?>

		</div>

	<?php } ?>

</div>

<?php } ?>
       <hr>

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



