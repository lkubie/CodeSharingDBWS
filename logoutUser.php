<?php


if (isset($_POST['user'])){
	$name = $_POST['user'];
	}

$dbhost = "sulnwdk5uwjw1r2k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
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

$sql = "UPDATE `lrqf9g5qj2a9xm0i`.`users` SET loggedIn = 'FALSE' WHERE `userID`='".$name."'";
$result = mysqli_query($connection, $sql);

mysqli_close($connection);
?>
<?php echo($sql); ?>