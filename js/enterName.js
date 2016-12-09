// JavaScript Document
$(document).ready(function() {
	var conn = new WebSocket('ws://localhost:8080');
	//var conn = new WebSocket('ws://75a9933c.ngrok.io'); 
	var name = '';
	var fileName = $('#fileNameSpan').text();
	//if cookie is set then set the appropiate values for that user unless it can't find that user.
	var cookieUser = $.cookie('user'+fileName); // => "the_value"
	//console.log(cookieUser);
	var dataObject;
	if(cookieUser != undefined){//if the cookie user is set
		//console.log('cookie user is set');
		$('#enterName').toggle();
		$('#overlay').toggle();
		name = cookieUser.replace(fileName, '');
		var str = "Now working as: " + name;
		$('#usersName').html(str);
		$('#editName').html('Change?');
		//DO AJAX CALL TO GET DESIRED SYNTAX HILIGHTING INFO!
		}
	
	
	function toggleOverlay(){
		if($('#overlay').css('display','block')){
			
			$('#enterName').css('display','none');
			$('#overlay').css('display','none');
		} else {
			$('#enterName').css('display','block');
			$('#overlay').css('display','block');
		}
	}
	$('#editName').on('click', function(){
		var fileName = $('#fileNameSpan').text();
		var name = $('#usersNameName').text();
		var cookieUserNew = $.cookie('user'+fileName); // => "the_value"
		var fullUserName = fileName + name;
		if(cookieUserNew == undefined){//if the cookie user is NOT set
			//DO AN AJAX TO DELETE THIS PERSON FROM THE DB!
			
			
			$.post('removeUser.php', {user: fullUserName});
			dataObject = {
						type : 'user', //I have this so I can seperate code, user and chat
						add: 0,
						username: name
					};
					conn.send(JSON.stringify(dataObject));
		}
		else{//if the user has a cookie, but is leaving...
			$.post('logoutUser.php', {user: fullUserName});
			}
		$('#enterName').toggle();
		$('#overlay').toggle();
		$.removeCookie('user'+fileName);
		});
	$('#submitName').on('click', function(e){
		e.preventDefault();
		var wantCookie;
		var desireCookie;
		if($('#cookieBox').is(":checked")){
			wantCookie = true;
			desireCookie = 'true';
			}
		else{
			wantCookie = false;
			desireCookie = 'false';
			}
		name = $('#userNameInput').val();
		var fullUserName = fileName + name;
		//set cookie if checkbox is set
		//ajax here and below only happens if that name is not in use
		console.log(desireCookie);
		$.post('checkName.php', {userName : fullUserName, cookie : desireCookie}, function(data){
			//data is if username exists
			if(data == 'false'){//if it does not exist
				if(wantCookie){
					$.cookie('user'+fileName, fullUserName, {expires: 30});
					}
				//put yourself on the 'working on' list
				var currentUserListHTML = $('#currentUserList').html();
				var newUserListHTML = currentUserListHTML + '<br>' + name;
				$('#currentUserList').html(newUserListHTML);
				//put the fact that you entered into your chat... not sure I want this, but...
				var oldChatHTML = $('#chatText').html();
				var newChatString = '';
				var dt = new Date();
				var utcDate = dt.toUTCString();
				newChatString = "<i>" + name + " has entered (" + utcDate + ")</i><br>";
				$('#chatText').html(oldChatHTML + newChatString);
				
				
				
				var str = "Now working as: <span id='usersNameName'>" + name + "</span>";
				$('#usersName').html(str);
				$('#editName').html('Change?');
				toggleOverlay();
				
				dataObject = {
					type : 'user', //I have this so I can seperate code, user and chat
					add: 1,
					username: name
				};
				conn.send(JSON.stringify(dataObject));
				dataObject = {
				type : 'chat', //I have this so I can seperate code and chat
				enter: 'TRUE',
				text: '',
				user: name
				};
				conn.send(JSON.stringify(dataObject));
				
				}
			else{
				$('#formError').html('sorry! That name is in use. Please choose another');
				//add an error saying that someone is using that name
				}
			});
		
		});
	
	$(window).on('beforeunload', function(){
		
		var cookieUserNew = $.cookie('user'+fileName); // => "the_value"
		var fullUserName = fileName + name;
		if(cookieUserNew == undefined){//if the cookie user is NOT set
			//DO AN AJAX TO DELETE THIS PERSON FROM THE DB!
			
			
			$.post('removeUser.php', {user: fullUserName});
			dataObject = {
						type : 'user', //I have this so I can seperate code, user and chat
						add: 0,
						username: name
					};
					conn.send(JSON.stringify(dataObject));
		}
		else{//if the user has a cookie, but is leaving...
			$.post('logoutUser.php', {user: fullUserName});
			}
			
		//remove name from 'current users' in DB ONLY if they dont have a cookie.
		});
	
});