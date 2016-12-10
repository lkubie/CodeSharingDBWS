<?php


if (isset($_POST['file'])){
	$file = $_POST['file'];
	}
else{
	$file = 'test3';
	}
$dbhost = "sulnwdk5uwjw1r2k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$dbuser = "k22qr254pzknzhib";
$dbpass = "rwzwygqrxexbnl6x";
$dbname = "lrqf9g5qj2a9xm0i";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306);
// $dbhost = "sulnwdk5uwjw1r2k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$dbuser = "k22qr254pzknzhib";
$dbpass = "rwzwygqrxexbnl6x";
$dbname = "lrqf9g5qj2a9xm0i";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306);
// $connection = mysqli_connect("localhost", "root", "root", "CodeSharing");
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
date_default_timezone_set("UTC"); 
$timestamp = date('Y-m-d G:i:s');
$sql = "INSERT INTO lrqf9g5qj2a9xm0i.currentFiles (fileName, lastEdited, text) VALUES ('".$file."', '".$timestamp."', '//Work on your code here!')";
$result = mysqli_query($connection, $sql);
$row_cnt = mysqli_num_rows($result);
$exists = 'false';

if($result){
	$status = 'ok';
	
	}
else{
	$status = 'error';
	}



mysqli_close($link);
?>
<div id='result'><?php echo($status); ?>
</div>
