// JavaScript Document
$(document).ready(function() {
	var currentClass = 'language-markup';
	var newClassName = $('#languageDropdown').val();
	var newClass = 'language-' + newClassName;
	var fileName = $('#fileNameSpan').text();
	$('#theCodeCode').removeClass(currentClass);
	$('#theCodeCode').addClass(newClass);
	currentClass = newClass;
	$('#languageDropdown').on('change', function() {
		$('#theCodeCode').removeClass(currentClass);
		newClassName = $(this).val();
		newClass = 'language-' + newClassName;
		$('#theCodeCode').addClass(newClass);
		currentClass = newClass;
		Prism.highlightAll();
		var cookieUser = $.cookie('user'+fileName); // => "the_value"
		//console.log(cookieUser);
		if(cookieUser != undefined){//if the cookie user is set
		$.post('saveSyntaxUser.php', {
			user: cookieUser,
			syntax: newClassName}, function(data){
				//console.log(data);
				});
		
		}
		else{
			$.post('saveSyntax.php', {
			file: fileName,
			syntax: newClassName}, function(data){
				//console.log(data);
				});
				}
		});
	});
