<?php


if (isset($_POST['user'])){
	$name = $_POST['user'];
	}

$connection = mysqli_connect("localhost", "root", "root", "CodeSharing");
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$sql = "DELETE FROM `CodeSharing`.`users` WHERE `userID`='".$name."'";
$result = mysqli_query($connection, $sql);

mysqli_close($connection);
?>
<?php echo($sql); ?>