<?php
    $jsondata = "php://input";
    $phpjsonstring = file_get_contents( $jsondata ); // Get content of posted JSON String

    $data = json_decode( $phpjsonstring, true ); // Decoding content of posted JSON String

    $text1 = $data["df_text1"];
    $text2 = $data["df_text2"];
    // Now you could use these variables in your sql query


DEFINE ('DBUSER', 'qrcodelocator'); 
DEFINE ('DBPW', 'Jg27EB?r3O7~'); 
DEFINE ('DBHOST', 'mysql4.gear.host'); 
DEFINE ('DBNAME', 'qrcodelocator'); 

$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    die("Database connection failed: " . mysqli_error($dbc));
    exit();
}

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    die("Database selection failed: " . mysqli_error($dbc));
    exit(); 
}


$query = "INSERT INTO qrcodetable (Latitude, Longitude, Speed, Timestamp) VALUES ('$$text1', '$text2', '123', '123')";

$result = mysqli_query($dbc, $query) or trigger_error("Query MySQL Error: " . mysqli_error($dbc)); 

mysqli_close($dbc); 






?>