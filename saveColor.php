<?php


if (isset($_POST['file'])){
	$file = $_POST['file'];
	$color = $_POST['color'];
	}
else{
	$file = 'test3';
	$color = 'default';
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
    error_log( "Error: Unable to connect to MySQL." . PHP_EOL);
    error_log( "Debugging errno: " . mysqli_connect_errno() . PHP_EOL);
    error_log( "Debugging error: " . mysqli_connect_error() . PHP_EOL);
    exit;
}

$sql = "UPDATE `".$dbname."`.`currentFiles` SET `color`='".$color."' WHERE `fileName`='".$file."';";
//error_log($sql);
$result = mysqli_query($connection, $sql);
//$row_cnt = mysqli_num_rows($result);

$exists = 'false';
//if($row_cnt==0){
if(!$result){
	$exists = 'false';
	}
else{
	$exists = 'true';
	}



mysqli_close($connection);
?>
<div id='exists'><?php echo($exists); ?>
</div>
