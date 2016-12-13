// JavaScript Document
$(document).ready(function() {
	//allCodeNodes returns a treewalker with all the nodes in #TheCodeCode
	function allCodeNodes() {
		var theCodeNode = document.getElementById('theCodeCode');
		var treeWalker = document.createTreeWalker(theCodeNode, NodeFilter.SHOW_TEXT, null, null);
		return treeWalker;
	}
	//total Carret Offset returns an integer that is the total offset from the begining of the code
	function totalCaretOffset(treeWalker, caretNode, caretOffsetInNode) {
		var currentNode = treeWalker.firstChild;
		currentNode = treeWalker.currentNode;
		currentNode = treeWalker.nextNode();
		var charCount = 0;
		var i=0;
		while (i < 30000) {//I need to fix this sloppy workaround. 
			if (currentNode !== caretNode) {
				
				if(currentNode !== null){
					//console.log(currentNode);
					charCount += currentNode.textContent.length;
				}
				currentNode = treeWalker.nextNode();
				i++;
			} else {
				//console.log('matchingNodes!');
				//console.log(currentNode);
				//console.log(caretNode);
				charCount += caretOffsetInNode;
				return charCount;
			}
		}
	}
	function newCaretPosition(totalOffset, addedOffset, treeWalker){
		var placementOffset = totalOffset + addedOffset;
		var currentNode = treeWalker.firstChild;
		currentNode = treeWalker.currentNode;
		currentNode = treeWalker.nextNode();
		var charCount = placementOffset;
		var replaceNodeInfo = [];
		replaceNodeInfo['offset'] = 0;
		replaceNodeInfo['node'] = currentNode;
		//console.log(charCount);
		while (true) {
			if (charCount > currentNode.textContent.length) {
				charCount -= currentNode.textContent.length;
				//console.log(charCount);
				currentNode = treeWalker.nextNode();
			} else {
				//console.log('at zero');
				replaceNodeInfo.offset = charCount;
				replaceNodeInfo.node = currentNode;
				return replaceNodeInfo;
			}
		}
	}
	function resotreNewCaretPosition(newCaretArray){
		var newNode = newCaretArray.node;
		var newOffset = newCaretArray.offset;
		var range = document.createRange();
		var sel = window.getSelection();
		range.setStart(newNode, newOffset);
		range.collapse(true);
		sel.removeAllRanges();
		sel.addRange(range);
		}
	
//functions offset and getTextNodeAtPosition get the offset within the current caret node.
	function offset(context) {
		var selection = window.getSelection();
		var range = selection.getRangeAt(0);
		range.setStart(context, 0);
		var len = range.toString().length;
		var pos = getTextNodeAtPosition(context, len);
		return pos.position;
	}

	function getTextNodeAtPosition(root, index) {
		var lastNode = null;
		var treeWalker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, function next(elem) {
			if (index > elem.textContent.length) {
				index -= elem.textContent.length;
				lastNode = elem;
				return NodeFilter.FILTER_REJECT;
			}
			return NodeFilter.FILTER_ACCEPT;
		});
		var c = treeWalker.nextNode();
		return {
			node: c ? c : root,
			position: c ? index : 0
		};
	}
//isDecendant returns a bool for weather a node is in another node
	function isDescendant(parent, child) {
		var node = child.parentNode;
		while (node !== null) {
			if (node === parent) {
				return true;
			}
			node = node.parentNode;
		}
		return false;
	}
	var chatText='';
	var sendingUser = $('#usersName').text();
	var localNode;
	var localOffset;
	var incomingCursor;
	var dataObject = {};
	var incomingData = {};
	var incomingText = '';
	var content = '';
	var updatedText = '';
	var parentNode = document.getElementById('theCode');
	var localLength;
	var incomingLength = 0;
	var lengthDiffrence = 0;
	var incomingKeystroke;
	//var conn = new WebSocket('ws://localhost:8080');
	var conn = new WebSocket('wss://salty-dusk-53545.herokuapp.com:8080');
	//var conn = new WebSocket('ws://75a9933c.ngrok.io'); 
	conn.onopen = function(e) {
		console.log("Connection established!");
		/*var eventArray = $.map(e, function(value, index) {
			return [value];
		});
		console.log(eventArray);*/
	};
	conn.onmessage = function(e) {
		var currentUserListHTML;
		var newUserListHTML;
		var thisUserHTML;
		incomingData = JSON.parse(e.data);
		
		if(incomingData.type === 'user'){
			//console.log('trying to add user');
			if(incomingData.add == 1){
				currentUserListHTML = $('#currentUserList').html();
				var allArrayUserList = currentUserListHTML.split("<br>");
				allArrayUserList.push(incomingData.username);
				allArrayUserList.sort(function (a, b){return a.toLowerCase().localeCompare(b.toLowerCase());}); //sort list alphabetically and ignore case
				var arrayLength = allArrayUserList.length -1;
				var finalUserListHTML = '';
				for (var i = 0; i <= arrayLength; i++){
					if (i ===arrayLength){
					finalUserListHTML += allArrayUserList[i];//don't add a br at the end.
					}
					else{finalUserListHTML += allArrayUserList[i] + "<br>";}
				}
				//console.log(finalUserListHTML);
				$('#currentUserList').html(finalUserListHTML); 
		
		
		
		
			}
			else if(incomingData.add == 0){
				currentUserListHTML = $('#currentUserList').html();
				thisUserHTML = '<br> ' + incomingData.username;
				//console.log('trying to remove the name ' + incomingData.username);
				newUserListHTML = currentUserListHTML.replace(thisUserHTML, "", 1);
				$('#currentUserList').html(newUserListHTML);
			}
		}
		else if (incomingData.type ==='chat'){
			var oldChatHTML = $('#chatText').html();
			var sendingUser = incomingData.user;
			//console.log(sendingUser);
			var newChatString = '';
			var dt = new Date();
			var utcDate = dt.toUTCString();
			if (incomingData.enter === 'FALSE'){
				var incomingChatText = incomingData.text;
				newChatString = "<b>" + sendingUser + "</b>: " + incomingChatText +" (" + utcDate + ")<br>";
				$('#chatText').html(oldChatHTML + newChatString);
			}
			else if (incomingData.enter === 'TRUE'){
				newChatString = "<i>" + sendingUser + " has entered (" + utcDate + ")</i><br>";
				$('#chatText').html(oldChatHTML + newChatString);
			}
		}
		else if(incomingData.type === 'code'){//I have this so I can seperate code and chat
			localNode = document.getSelection().anchorNode;
			var localText = $("#theCode").text();
			localLength = localText.length;
			incomingKeystroke = incomingData.key;//not sure I need this but here it is...
			incomingCursor = incomingData.cursor;
			incomingText = incomingData.text;
			incomingLength = incomingText.length + 1;//not sure why I need a +1 but I do....
			//console.log('incoming Length: ' + incomingLength);
			//console.log('local length: ' + localLength);
			lengthDiffrence = incomingLength - localLength;
			if (incomingText.match(/^[\r\n]/)) { //if it starts with a weird line break then replace it.
				incomingText = incomingText.replace(/[\r\n]/, "", 1);
			} 
			
			if (localNode !== null && isDescendant(parentNode, localNode)) {
				localOffset = offset(parentNode);
				var currentDoms = allCodeNodes();
				var totalOffset = totalCaretOffset(currentDoms, localNode, localOffset);
				//console.log('total Offset' + totalOffset);
				//console.log('incoming offset' + incomingCursor);
				$("#theCodeCode").html(incomingText);
				currentDoms = allCodeNodes();
				Prism.highlightAll();
				var caretArray;
				if(totalOffset > incomingCursor){
					caretArray = newCaretPosition(totalOffset, lengthDiffrence, currentDoms);
				} else {
					caretArray = newCaretPosition(totalOffset, 0, currentDoms);
				}
				//console.log(caretArray);
				//console.log('difftence = ' + lengthDiffrence);
				//console.log('totalOffset = ' + totalOffset);
				//console.log('reaminingDiffrence = ' + caretArray.offset);
				resotreNewCaretPosition(caretArray);
			} else {
				$("#theCodeCode").html(incomingText);
				Prism.highlightAll();
			}
		}
	};
	$('#theCode').keyup(function(e) {
		
		var noSendingKeyCodes = [16, 17, 18, 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 91, 93, 112, 113,114,115,116,117,118,119,120,121,122,123,144,145,182,183];
		//console.log(jQuery.inArray(e.keyCode,noSendingKeyCodes));
		if (jQuery.inArray(e.keyCode,noSendingKeyCodes) === -1) {
			//console.log('sending...');
			var sendingOffset = 0;
			var sendingDoms;
			content = $("#theCode").text();
			if (content.match(/^[\r\n]/)) { //if it starts with a weird line break then replace it.
				updatedText = content.replace(/[\r\n]/, "", 1);
			} else {
				updatedText = content;
			}
			//console.log(updatedText);
			if (content.match(/[\r\n]$/)) {
				//console.log('line at the end');
				updatedText = content.replace(/[\r\n]$/, "", 1);
			}
			localNode = document.getSelection().anchorNode;
			if (localNode !== null) { //if the cursor is somewhere 
				if (isDescendant(parentNode, localNode)) { //and if it is in the content editable div
					sendingDoms = allCodeNodes();
					localOffset = offset(localNode);
					sendingOffset = totalCaretOffset(sendingDoms, localNode, localOffset);
				}
			}
			dataObject = {
				type : 'code', //I have this so I can seperate code and chat
				key: e.keyCode,
				cursor: sendingOffset,
				text: updatedText,
				length: updatedText.length
			};
			conn.send(JSON.stringify(dataObject));
		}
	});
	function sendChat(){
		chatText = $('#chatTextInput').text();
		sendingUser = $('#usersNameName').text();
		dataObject = {
				type : 'chat', //I have this so I can seperate code and chat
				enter: 'FALSE',
				text: chatText,
				user: sendingUser
			};
			conn.send(JSON.stringify(dataObject));
			
			
			var oldChatHTML = $('#chatText').html();
			//console.log(sendingUser);
			var newChatString = '';
			var dt = new Date();
			var utcDate = dt.toUTCString();
			newChatString = "<b>" + sendingUser + "</b>: " + chatText +" (" + utcDate + ")<br>";
			$('#chatText').html(oldChatHTML + newChatString);
			$('#chatTextInput').text('');
		}
	
	
	
	$('#chatSubmit').on('click', function(){
		sendChat();
	});
	$('#chatTextInput').keydown(function(e) {
		if(e.keyCode === 13){
			e.preventDefault();
			sendChat();
			}
		
		});
	
	
	
});