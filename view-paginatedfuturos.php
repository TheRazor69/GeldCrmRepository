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
<?php
/* 
	VIEW-PAGINATED.PHP
	Displays all data from 'players' table
	This is a modified version of view.php that includes pagination
*/

	// connect to the database
	include('connect-dbfuturos.php');
	
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
	
	echo "<p><a href='ProjectosFuturos.php'>View All</a> | <b>View Page:</b> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
		echo "<a href='view-paginated.php?page=$i'>$i</a> ";
	}
	echo "</p>";
	// display data in table
	echo "<table border='1' cellpadding='10'>";
	echo "<tr> <th>ID</th> <th>empresa</th> <th>titlo</th> <th>categoria</th> <th>dataentrega</th> <th>valor</th> <th></th> <th></th></tr>";
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
        echo '<td>' . mysql_result($result, $i, 'categoria') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'dataentrega') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'valor') . '</td>';
		echo '<td><a href="editfuturos.php?id=' . mysql_result($result, $i, 'id') . '">Edit</a></td>';
		echo '<td><a href="deletefuturos.php?id=' . mysql_result($result, $i, 'id') . '">Delete</a></td>';
		echo "</tr>";
        
	}
	// close table>
	echo "</table>"; 
	
	// pagination
	
?>
<p><a href="newfuturos.php">Add a new record</a></p>

</body>
</html>