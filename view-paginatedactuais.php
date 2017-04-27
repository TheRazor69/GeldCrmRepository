<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
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
<?php
/* 
	VIEW-PAGINATED.PHP
	Displays all data from 'players' table
	This is a modified version of view.php that includes pagination
*/

	// connect to the database
	include('connect-db.php');
	
	// number of results to show per page
	$per_page = 3;
	
	// figure out the total pages in the database
	$result = mysql_query("SELECT * FROM players");
	$total_results = mysql_num_rows($result);
	$total_pages = ceil($total_results / $per_page);

	// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
	if (isset($_GET['page']) && is_numeric($_GET['page']))
	{
		$show_page = $_GET['page'];
		
		// make sure the $show_page value is valid
		if ($show_page > 0 && $show_page <= $total_pages)
		{
			$start = ($show_page -1) * $per_page;
			$end = $start + $per_page; 
		}
		else
		{
			// error - show first set of results
			$start = 0;
			$end = $per_page; 
		}		
	}
	else
	{
		// if page isn't set, show first set of results
		$start = 0;
		$end = $per_page; 
	}
	
	// display pagination
	
	echo "<p><a href='ProjectosAtuais.php'>View All</a> | <b>View Page:</b> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
		echo "<a href='view-paginated.php?page=$i'>$i</a> ";
	}
	echo "</p>";
		
	// display data in table
	echo "<table border='1' cellpadding='10'>";
	echo "<tr> <th>ID</th> <th>empresa</th> <th>titlo</th> <th>urgencia</th> <th>importancia</th> <th>dataentrega</th> <th>estado</th> <th></th> <th></th></tr>";

	// loop through results of database query, displaying them in the table	
	for ($i = $start; $i < $end; $i++)
	{
		// make sure that PHP doesn't try to show results that don't exist
		if ($i == $total_results) { break; }
	
		// echo out the contents of each row into a table
		echo "<tr>";
		echo '<td>' . mysql_result($result, $i, 'id') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'empresa') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'titlo') . '</td>';
        echo '<td>' . mysql_result($result, $i, 'urgencia') . '</td>';
        echo '<td>' . mysql_result($result, $i, 'importancia') . '</td>';
        echo '<td>' . mysql_result($result, $i, 'dataentrega') . '</td>';
        echo '<td>' . mysql_result($result, $i, 'estado') . '</td>';
		echo '<td><a href="edit.php?id=' . mysql_result($result, $i, 'id') . '">Edit</a></td>';
		echo '<td><a href="delete.php?id=' . mysql_result($result, $i, 'id') . '">Delete</a></td>';
		echo "</tr>"; 
	}
	// close table>
	echo "</table>"; 
	
	// pagination
	
?>
<p><a href="new.php">Add a new record</a></p>
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
</body>
</html>