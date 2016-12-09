<?php


if (isset($_GET['file'])){
	$file = $_GET['file'];
	}
else{
	$file = 'test3';
	
	}
 $connection = mysqli_connect("localhost", "root", "root", "CodeSharing");
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$escapedText = mysqli_real_escape_string ( $connection , $text );
$sql = "SELECT * FROM CodeSharing.currentFiles WHERE filename = '".$file."'";
$result = mysqli_query($connection, $sql);
$row_cnt = mysqli_num_rows($result);
$exists = 'false';

if($result){
	while($row = mysqli_fetch_assoc($result)){
		$text = $row['text'];
		$users = $row['currentUsers'];
		$lastEdited = $row['lastEdited'];
		$color = $row['color'];
		$syntax = $row['syntax'];
		}
	}



mysqli_close($link);
?>
<?php echo($text); ?>

