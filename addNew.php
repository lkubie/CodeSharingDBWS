<?php


if (isset($_POST['file'])){
	$file = $_POST['file'];
	}
else{
	$file = 'test3';
	}
//AWS for Heroku
$dbhost = "sulnwdk5uwjw1r2k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$dbuser = "k22qr254pzknzhib";
$dbpass = "rwzwygqrxexbnl6x";
$dbname = "lrqf9g5qj2a9xm0i";
$port = 3306;
/*
//Localhost
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "CodeSharing";
$port = 3308;*/

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $port);
// $connection = mysqli_connect("localhost", "root", "root", "CodeSharing");
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
date_default_timezone_set("UTC"); 
$timestamp = date('Y-m-d G:i:s');
$sql = "INSERT INTO ".$dbname.".currentFiles (fileName, lastEdited, text) VALUES ('".$file."', '".$timestamp."', '//Work on your code here!')";
$result = mysqli_query($connection, $sql);
//$row_cnt = mysqli_num_rows($result);
$exists = 'false';

if($result){
	$status = 'ok';
	
	}
else{
	$status = 'error';
	}



mysqli_close($connection);
?>
<div id='result'><?php echo($status); ?>
</div>
