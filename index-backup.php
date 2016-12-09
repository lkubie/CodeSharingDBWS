<!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
                
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" charset="UTF-8" content="text/html" />
<title>Welcome to CollaborCode</title>
<script src="js/jquery.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<script src="https://use.fontawesome.com/93ecf91868.js"></script>
<link href="css/main.css" media="screen" rel="stylesheet" type="text/css">
<link href="css/index.css" media="screen" rel="stylesheet" type="text/css">
</head>
<body class="body">
<div id='navBar'> 
<div id='logo'><a href='index.php'>CollaborCode</a></div><div id='links'><span class='joinSomeoneLinkLink'><a href = "#whatIs">What is CollaborCode?</a></span>   |   <span class='joinSomeoneLinkLink'><a href='#ourMission'>Our Mission</a></span>   |   <span class='joinSomeoneLinkLink'><a href='#aboutPrivacy'>About Privacy</a></span></div><div id='joinSomeoneLink'>Join Someone</div><div id='createNewButton'>Create New</div>


</div>

<div class="main">
<div id="topSpacer"></div>
<div id='twhatIs'>
<div id="welcome">
<span>Welcome! </span>CollaborCode lets you securly collaborate on code.</div>
<div id='whatIsText'><p>No need to log in, no need give an email address or <span class='italic'>any </span>personal information. We strive to make your coding as easy, anonomyous and convenient as possible.</p></div>
<center>
<img src="img/ScreenShot.png" width="70%"  alt="exampleOfCollaborCode" id='exampleScreenShot'/></center>
</div>

<div id='leftContainer'>
<div id="createNew">Create a new document to share</div>

<div id="meetSomeone">Supposed to meet someone here?</br>
Enter your code here:
<form action="loadDoc.php" method="get" id='loadDocForm'>
<input type="text" name="file" id='fileNameText'>
<input name="submit" type="submit" id="indexSubmit">
</form>
<div id='error'></div>
</div>

</div>

<div id='filetypes'><span id='listTop'>Supported languages are: </span>
<ul class="fa-ul">
<li><i class="fa-li fa fa-code"></i>AppleScript</li> 
<li><i class="fa-li fa fa-code"></i>ASP.NET</li>
<li><i class="fa-li fa fa-code"></i>C</li>
<li><i class="fa-li fa fa-code"></i>C#</li>
<li><i class="fa-li fa fa-code"></i>C++</li>
<li><i class="fa-li fa fa-code"></i>CSS</li>
<li><i class="fa-li fa fa-code"></i>HTML</li>
<li><i class="fa-li fa fa-code"></i>HTTP</li>
<li><i class="fa-li fa fa-code"></i>Java</li>
<li><i class="fa-li fa fa-code"></i>JavaScript</li>
<li><i class="fa-li fa fa-code"></i>JSON</li>
<li><i class="fa-li fa fa-code"></i>LaTeX</li>
<li><i class="fa-li fa fa-code"></i>Pearl</li>
<li><i class="fa-li fa fa-code"></i>PHP</li>
<li><i class="fa-li fa fa-code"></i>PowerShell</li>
<li><i class="fa-li fa fa-code"></i>Python</li>
<li><i class="fa-li fa fa-code"></i>Ruby</li> 
</ul>
<span id='notice'>If you would like to see us support another langage please contact us, and we will do our best to make it happen!</span>

</div>

</div>
<div id='footer'>Footer info</div>
</body>

<script type="text/javascript" src="js/index.js"></script>
</html>