<?php
if (isset($_POST['user'])){
	$user = $_POST['user'];
	$syntax = $_POST['syntax'];
	}
else{
	$syntax = 'markup';
	$user = 'test3';
	}
 $connection = mysqli_connect("localhost", "root", "root", "CodeSharing");
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$sql = "UPDATE `CodeSharing`.`users` SET `syntax`='".$syntax."' WHERE `userID`='".$user."';";
$result = mysqli_query($connection, $sql);
$row_cnt = mysqli_num_rows($result);
$exists = 'false';
if($row_cnt==0){

	$exists = 'false';
	}
else{
	$exists = 'true';
	}




mysqli_close($link);
?>
<div id='exists'><?php echo($exists); ?>
</div>
<div id='text'><?php echo("file is: " . $file . " and syntax is: " . $syntax); ?></div>