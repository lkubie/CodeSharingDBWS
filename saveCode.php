<?php


if (isset($_POST['file'])){
	$file = $_POST['file'];
	$text = $_POST['text'];
	}
else{
	$file = 'test3';
	$text = 'default';
	}
 $connection = mysqli_connect("localhost", "root", "root", "CodeSharing");
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$escapedText = mysqli_real_escape_string ( $connection , $text );
$sql = "UPDATE `CodeSharing`.`currentFiles` SET `text`='".$escapedText."' WHERE `fileName`='".$file."';";
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
<div id='text'><?php echo("File name is: " . $file . " and text is: " . $text); ?></div>