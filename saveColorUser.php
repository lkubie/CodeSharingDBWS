<?php


if (isset($_POST['user'])){
	$user = $_POST['user'];
	$color = $_POST['color'];
	}
else{
	$user = 'test3';
	$color = 'default';
	}
/*
//Localhost
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "CodeSharing";
$port = 3308;
*/
//AWS for Heroku
$dbhost = "sulnwdk5uwjw1r2k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$dbuser = "k22qr254pzknzhib";
$dbpass = "rwzwygqrxexbnl6x";
$dbname = "lrqf9g5qj2a9xm0i";
$port = 3306;
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $port);
// $connection = mysqli_connect("localhost", "root", "root", "CodeSharing");
if (!$connection) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;	
}


$sql = "UPDATE `".$dbname."`.`users` SET `color`='".$color."' WHERE `userID`='".$user."';";
$result = mysqli_query($connection, $sql);
//$row_cnt = mysqli_num_rows($result);
$exists = 'false';
if($result){

	$exists = 'false';
	}
else{
	$exists = 'true';
	}



mysqli_close($connection);
?>
<div id='exists'><?php echo($exists); ?>
</div>
