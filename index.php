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
<script src="https://use.fontawesome.com/93ecf91868.js"></script>
<link href="css/main.css" media="screen" rel="stylesheet" type="text/css">
<link href="css/index.css" media="screen" rel="stylesheet" type="text/css">
</head>

<body class="body">
<div id='navBar'> 
	<div class = "nav-bar-left">
		<div id='logo'>
			<a href='index.php'>CollaborCode</a>
		</div>
		<div id='links'>
			<ul>
				<li class='headerLink'><a  href = "#whatIs">What is CollaborCode?</a></li>
				<li class='headerLink'><a href='#ourMission'>Our Mission</a></li>
				<li class='headerLink'><a  href='#aboutPrivacy'>About Privacy</a></li>
			</ul>
		</div>
	</div>
	
	<div class = "nav-bar-right">
		<div class = "nav-button" id='joinSomeoneLink'>Join Someone</div>
		<div class = "nav-button" id='createNew'>Create New</div>
	</div>
	
	<div style = "clear:both"></div>
</div>



<div class="main">
<div id="topSpacer"></div>
<div id="meetSomeone">
<div id='meetSomeoneX'>X</div>
<span id='meetSomeoneTitle'>Supposed to meet someone here?</br></span>
<span id='meetSomeoneEnterCode'>Enter your code here:</span>
<form action="loadDoc.php" method="get" id='loadDocForm'>
<input type="text" name="file" id='fileNameText'>
<input name="submit" type="submit" id="indexSubmit">
</form>

<div id='error'></div>

</div>
<div class='indexSection' id='whatIs'>
<div id="welcome">
<span>Welcome! </span>CollaborCode lets you securely collaborate on code.</div>

<div id='filetypes'><center><span id='listTop'>Supported languages are: </span></center>
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
<span id='notice'>If you would like to see us support another language please contact us, and we will do our best to make it happen!</span>
</div>
<div id='whatIsText'>
  <p>No need to log in, no need give an email address or <span class='italic'>any </span>personal information. We strive to make your coding as easy, anonymous and convenient as possible. Share your document with others, and simultaneously work side-by-side, editing, discussing and perfecting. </p></div>

<img src="img/ScreenShot.png" width="55%"  alt="exampleOfCollaborCode" id='exampleScreenShot'/>


</div>
<div class='indexSection' id='ourMission'>
<span class='sectionTitle'>Our Mission</span>
<div class='twoColumns' id'missionText'><p>
Stuck? We've been there. Wish there was a fast and easy way to have your friends find your glitch? CollaborCode is the solution. With a built-in chat, and on-the-fly syntax highlighting, you just need to copy, paste, and share your link. That's it. Done. </p>
<p>CollaborCode does not condone illegal software development, but we <span class='italic'>do</span> support your right to your anonymity. Because we ask for no information, we can store no information. No IP logging. No emails. No names. </p>
</div>
</div>
<div class='indexSection'  id='aboutPrivacy'>
<span class='sectionTitle'>About Privacy</span>
<div class='twoColumns' id'privacyText'><p>
More and more we complacently sign away our rights in order to use a service. Companies grab the rights to our words and images in the 'small print'. Moreover, governments heavy-hand companies so they have to betray their customers' privacy. By logging no information that links you to your code, even if subpoenaed, CollaborCode cannot give any information that ties you to a piece of code – because we don't have it.</p> 
<p>You <span class='italic'>are</span> asked to provide a name to be known as while working on the document. We use this information so you have a name in the chat. Feel free to use the generic and automatically populated Anonymous name. We suggest this if you really want NO way to tie you to the code.</p>
<p>It is important to also point out here that we can only secure your anonymity on our end. If someone is sniffing on your network, for example, they may be able to see your code and link it to you. If you are not using a VPN, or your TOR exit node is compromised, your anonymity <span class='italic'>may </span> be compromised. On our end, we promise to provide you the most secure way to share and collaborate on code, but you also need to do your part.</p>
</div>
</div>







</div>
<div id='footer'>Footer info | &copy; L. Kubie</div>
</body>

<script type="text/javascript" src="js/index.js"></script>
</html>