<!doctype html>
<!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
                
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="img/CC.ico">
<meta http-equiv="Content-Type" charset="UTF-8" content="text/html" />
<title>Work on your Code Together!</title>
<script src="js/jquery.js"></script>

<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
<link href="css/main.css" media="screen" rel="stylesheet" type="text/css">
<link href="css/loadDoc.css" media="screen" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/prism_css/default.css">


<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="carhartl-jquery-cookie-92b7715/jquery.cookie.js"></script>
<script src="js/save.js"></script>
<script src="js/clipboard.js-master/dist/clipboard.min.js"></script>
<script src="https://use.fontawesome.com/93ecf91868.js"></script>
<script src="js/websocketScripts.js"></script>
<script src="js/hideChat.js"></script>

     

<?php 

if (isset($_GET['file'])){
	$file = $_GET['file'];
	}
else{
	$file = 'test';
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

$sql = "SELECT * FROM ".$dbname.".currentFiles WHERE filename = '".$file."'";
$result = mysqli_query($connection, $sql);
if($result){
	while($row = mysqli_fetch_assoc($result)){
		$text = $row['text'];
		$users = $row['currentUsers'];
		$lastEdited = $row['lastEdited'];
		$color = $row['color'];
		$syntax = $row['syntax'];
		}
	}
//OVERRIDE COLOR AND SYNTAX IF USER HAS COOKIE!

if(isset($_COOKIE['user'.$file])){
	$fullUserName = $_COOKIE['user'.$file];
	$userPrefQuery = "SELECT * FROM ".$dbname.".users WHERE userID = '".$fullUserName."'";
	$userResult = mysqli_query($connection, $userPrefQuery);
	if($userResult){
	while($row = mysqli_fetch_assoc($userResult)){
		$color = $row['color'];
		$syntax = $row['syntax'];
		}
	}
}


$findAllLoggedInUsers = "SELECT * FROM ".$dbname.".users WHERE `userID` LIKE '" . $file . "%' AND `loggedIn` = 'TRUE'";
$loggedInUsers = mysqli_query($connection, $findAllLoggedInUsers);
$loggedInUserHTML='';
if($loggedInUsers){
	$numUsers = mysqli_num_rows($loggedInUsers);
	$i = 1;
	while($row = mysqli_fetch_assoc($loggedInUsers)){
		$loggedInUserName = str_replace($file, "", $row['userID']);
		if($i < $numUsers ){	
			$loggedInUserHTML=$loggedInUserHTML . $loggedInUserName . '<br>';
		}
		else{
			$loggedInUserHTML=$loggedInUserHTML . $loggedInUserName;//don't put a <br> on the last one
		}
		$i++;
	}
}


$findUsers = "SELECT * FROM ".$dbname.".users WHERE `userID` LIKE '".$file."Anonymous%'";
$userAnons = mysqli_query($connection, $findUsers);
$testArray = $userAnons;
if($userAnons){
	$i = 1;
	while($row = mysqli_fetch_assoc($userAnons)){
		if ($row['userID'] == $file.'Anonymous'.$i){
			$i= $i + 1;
		}
		else{
			break;
			}
		
		}
	}

mysqli_close($connection);
?>

</head>

<body>
<div id='noMobileOverlay'><u>Sorry!</u> <br>We do not currently support mobile devices. <br>If you're not on a mobile device, then make your browser larger, silly!</div>
<div id='overlay'></div>
<div id='enterName'>Please Enter Your Name. <span id='nameNote'>NOTE: this will be temporarily stored in our database.</span>
<form method="post">
<?php echo("<input type='text'  value='Anonymous".$i."' name='userName' id='userNameInput'>") ?><input type="submit" id='submitName'>
<br />
<div id='bottomOfNameInput'>
<input type='checkbox' name='cookie' id='cookieBox'> Remember you on this computer? <span id='nameNote'>NOTE: this will give you a cookie.</span></div>
<div id='formError'></div>
</form>
</div>
<div id="wrapper">


<div id='navBar'> 
	<div class = "nav-bar-left">
		<div id='logo'>
			<a href='index.php'>CollaborCode</a>
		</div>
		<div id='headerFileInfo'>
			<span id=''>Now working on: <span  id = 'fileNameSpan' data-clipboard-target="#fileNameSpan"><?php echo($file);?></span></span><div id='copied'>COPIED</div><br>
           <div id='usersName'></div><div id='editName'></div>
            </div>
            
   
	
	</div>
	
	<div class = "nav-bar-right">
		<div class = "nav-button" id='joinSomeoneLink'>Join Someone</div>
		<div class = "nav-button" id='createNew'>Create New</div>
	</div>
	
	<div style = "clear:both"></div>
</div>


<div id='bottomOfPage'>
<div id="topSpacer"></div>
<div id="meetSomeone">
<div id='meetSomeoneX'>X</div>
<span id='meetSomeoneTitle'>Supposed to meet someone here?</br>
Enter your code here:</span>
<form action="loadDoc.php" method="get" id='loadDocForm'>
<input type="text" name="file" id='fileNameText'>
<input name="submit" type="submit" id="indexSubmit">
</form>

<div id='error'></div>

</div>

<div id='topRow'>
<div id="coloring">
<?php 
//error_log("The selected Color is (line 186):" . $color);
$colorArray = array("default"=>"Default", "coy"=>"Coy", "dark"=>"Dark", "funky"=>"Funky", "light"=>"Light", "okaidia"=>"Okaidia", "twilight"=>"Twilight");
echo("Color options: <select id='theme'>");
foreach($colorArray as $name => $displayName) {
	if($name == $color){
		echo("<option value=".$name." selected>".$displayName."</option>");
		}
	else{echo("<option value=".$name.">".$displayName."</option>");}
	}
?>

  
</select></div>
<div id ="language">
<?php 

echo("Programming Language: <select id ='languageDropdown'>");
$syntaxArray = array("applescript"=>"AppleScript", "aspnet"=>"ASP.NET", "c"=>"C", "csharp"=>"C#", "cpp"=>"C++", "clike"=>"C-Like", "css"=>"CSS", "html"=>"HTML", "java"=>"java", "javascript"=>"JavaScript", "json"=>"JSON", "latex"=>"LaTeX", "markup"=>"Markup", "pearl"=>"Pearl", "php"=>"PHP", "powershell"=>"PowerShell", "python"=>"Python", "ruby"=>"Ruby");
foreach($syntaxArray as $name => $displayName) {
	if($name == $syntax){
		echo("<option value=".$name." selected>".$displayName."</option>");
		}
	else{echo("<option value=".$name.">".$displayName."</option>");}
	}

?>

</select></div>
<div id="status">Status: <span class='ready'>ready</span></div>
</div>

<div id='mainContainer'>
<div id='showChat'>SHOW CHAT</div>
<div id="currentCodeBox" >
<pre id="theCode" class='line-numbers'>
<code contenteditable="true" id="theCodeCode" class='language-markup'><?php 
// Print the body of the result by indexing into the result object.
echo htmlspecialchars($text); 
?></code></pre></div>
<div id="sidebar"><div id='hideChat'>HIDE CHAT</div><div id='currentUserSidebar'><span id='currentUsersTitle'>Current Users:</span><div id='currentUserList'><?php echo($loggedInUserHTML); ?></div></div><div id='chatContainer'><div id='chatText'></div><div id='chatInputWrapper'><div id='chatTextInput' contenteditable="true"></div><div id='chatSubmit'>ENTER</div><div style="clear:both"></div></div></div>
</div>
</div>
<div id="test" style="clear:both"></div>
</div>
<script type="text/javascript" src="js/index.js"></script>
<script src="js/changeColor.js"></script>
<script src="js/enterName.js"></script>
<script src="js/changeLanguage.js"></script>
<script src="js/resizePage.js"></script>
<script src="js/prism.js"></script>
<div id='footer'>Footer info | &copy; L. Kubie</div>
</body>

</html>