// JavaScript Document
$(document).ready(function() {
	//run highlighting on page load
	Prism.highlightAll();

	function saveCaretPosition(context) {
		var selection = window.getSelection();
		var range = selection.getRangeAt(0);
		range.setStart(context, 0);
		var len = range.toString().length;
		return function restore() {
			var pos = getTextNodeAtPosition(context, len);
			//console.log('position:');
			//console.log(pos.position);
			selection.removeAllRanges();
			var range = new Range();
			range.setStart(pos.node, pos.position);
			selection.addRange(range);
		}
	}

	function getTextNodeAtPosition(root, index) {
			var lastNode = null;
			var treeWalker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, function next(elem) {
				if (index > elem.textContent.length) {
					index -= elem.textContent.length;
					lastNode = elem;
					return NodeFilter.FILTER_REJECT
				}
				return NodeFilter.FILTER_ACCEPT;
			});
			var c = treeWalker.nextNode();
			return {
				node: c ? c : root,
				position: c ? index : 0
			};
		}
		//http://stackoverflow.com/questions/1064089/inserting-a-text-where-cursor-is-using-javascript-jquery

	function insertTextAtCursor(text) {
			var sel, range, html;
			if (window.getSelection) {
				sel = window.getSelection();
				if (sel.getRangeAt && sel.rangeCount) {
					range = sel.getRangeAt(0);
					range.deleteContents();
					var newNode=document.createTextNode(text);
					range.insertNode(newNode);
					//!!!!!add line to put the cursor after that new text
					var startRangeNode = range.startContainer.nextSibling;
					var startOffset = 1;
					range.setStart(startRangeNode, startOffset);
					range.collapse(true);
					//console.log(range);
					sel.removeAllRanges();
					sel.addRange(range);
				}
			} else if (document.selection && document.selection.createRange) {
				document.selection.createRange().text = text;
			}
		}
	//create some vars I need
	var range = document.createRange();
	var currentTheme = 'default';
	var newTheme = $('#theme').val();
	var oldThemeCSSFile = "css/prism_css/" + currentTheme + ".css";
	var newThemeCSSFile = "css/prism_css/" + newTheme + ".css";
	$('link[href="' + oldThemeCSSFile + '"]').attr('href', newThemeCSSFile);
	currentTheme =  $('#theme').val();
	Prism.highlightAll();
	//note: location syntaxHighlighter/styles/shThemeDefault.css
	//If I chose a different theme then change the css for the theme.
	$('#theme').on('change', function() {
		var fileName = $('#fileNameSpan').text();
		var newTheme = $(this).val();
		var oldThemeCSSFile = "css/prism_css/" + currentTheme + ".css";
		var newThemeCSSFile = "css/prism_css/" + newTheme + ".css";
		$('link[href="' + oldThemeCSSFile + '"]').attr('href', newThemeCSSFile);
		currentTheme = $(this).val();
		Prism.highlightAll();
		var cookieUser = $.cookie('user'+fileName); // => "the_value"
		if(cookieUser != undefined){//if the cookie user is set save the change to the user
		$.post('saveColorUser.php', {
				user: cookieUser,
				color: currentTheme});
		
		}
		else{	$.post('saveColor.php', {//otherwise save it to the general text
				file: fileName,
				color: currentTheme});}
		});


	$('#theCode').keydown(function(e) {
		if (e.keyCode === 9) {
			e.preventDefault(); //don't let it tab to loose focus! and don't let enter break shit
			insertTextAtCursor('\t');
		}
		else if(e.keyCode === 13){
			e.preventDefault();
			insertTextAtCursor('\n\r');
			}
	});
	$('#theCode').keyup(function(e) { 
	
		var specialKeyCodes = [32,190,187,219,57,221,48,186,222,220,221, 9, 8 , 13];
		
		if (jQuery.inArray(e.keyCode,specialKeyCodes) !== -1) { //only update syntax of space, enter or special char
			
			var restore = saveCaretPosition(this);
			Prism.highlightAll();
			restore();
		}
		//console.log("KeyCode is: "+e.keyCode);
		});
});