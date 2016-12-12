<?php


if (isset($_POST['user'])){
	$name = $_POST['user'];
	}

//Localhost
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "CodeSharing";
$port = 3308;
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $port);
// $connection = mysqli_connect("localhost", "root", "root", "CodeSharing");
if (!$connection) {
	//AWS for Heroku
	$dbhost = "sulnwdk5uwjw1r2k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
	$dbuser = "k22qr254pzknzhib";
	$dbpass = "rwzwygqrxexbnl6x";
	$dbname = "lrqf9g5qj2a9xm0i";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $port);
	$port = 3306;
	if (!$connection) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
}

$sql = "DELETE FROM `".$dbname."`.`users` WHERE `userID`='".$name."'";
$result = mysqli_query($connection, $sql);

mysqli_close($connection);
?>
<?php echo($sql); ?>