<?php


if (isset($_POST['userName'])){
	$name = $_POST['userName'];
	$cookie = $_POST['cookie'];
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

$sql = "SELECT * FROM `lrqf9g5qj2a9xm0i`.`users` WHERE `userID`='".$name."';";
$result = mysqli_query($connection, $sql);
$row_cnt = mysqli_num_rows($result);
$exists = '';
if($row_cnt==0){
	$exists = 'false';
	$insertQuery = "INSERT INTO lrqf9g5qj2a9xm0i.users (`userID`, `cookie`, `loggedIn`, color)  VALUES ('".$name."','".$cookie."','TRUE', NULL)";
	error_log($insertQuery);
	$resultInsert = mysqli_query($connection, $insertQuery);
	}
else{
	$exists = 'true';
	}
mysqli_close($connection);
?>
<?php echo($exists); ?>