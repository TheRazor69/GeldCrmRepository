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

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">projectosatuais
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Mainpage.html">Home</a>
                    </li>
                    <li class="active">Contact</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <?php
/* 
	VIEW.PHP
	Displays all data from 'players' table
*/

	// connect to the database
	include('connect-dbactuais.php');

	// get results from database
	$result = mysql_query("SELECT * FROM players") 
		or die(mysql_error());  
		
	// display data in table
	echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
	
	echo "<table border='1' cellpadding='10'>";
	echo "<tr> <th>ID</th> <th>empresa</th> <th>titlo</th> <th>urgencia</th> <th>importancia</th> <th>dataentrega</th> <th>estado</th> <th></th> <th></th></tr>";

	// loop through results of database query, displaying them in the table
	while($row = mysql_fetch_array( $result )) {
		
		// echo out the contents of each row into a table
		echo "<tr>";
		echo '<td>' . $row['id'] . '</td>';
		echo '<td>' . $row['empresa'] . '</td>';
		echo '<td>' . $row['titlo'] . '</td>';
        echo '<td>' . $row['urgencia'] . '</td>';
		echo '<td>' . $row['importancia'] . '</td>';
		echo '<td>' . $row['dataentrega'] . '</td>';
        echo '<td>' . $row['estado'] . '</td>';
		echo '<td><a href="editactuais.php?id=' . $row['id'] . '">Edit</a></td>';
		echo '<td><a href="deleteactuais.php?id=' . $row['id'] . '">Delete</a></td>';
		echo "</tr>"; 
	} 

	// close table>
	echo "</table>";
?>
<p><a href="newactuais.php">Add a new record</a></p>

        

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Hermes 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

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