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
// $connection = mysqli_connect("localhost", "root", "root", "CodeSharing");
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$sql = "SELECT * FROM lrqf9g5qj2a9xm0i.currentFiles WHERE filename = '".$file."'";
$result = mysqli_query($connection, $sql);
$row_cnt = mysqli_num_rows($result);
$exists = 'false';
if($row_cnt==0){

	$exists = 'false';
	}
else{
	$exists = 'true';
	}
if($result){
	while($row = mysqli_fetch_assoc($result)){
		$text = $row['text'];
		$users = $row['currentUsers'];
		$lastEdited = $row['lastEdited'];
		}
	}



mysqli_close($connection);
?>
<div id='exists'><?php echo($exists); ?>
</div>
