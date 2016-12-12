// JavaScript Document
$(document).ready(function(){
	
	function setDivSizes(){
		var headerHeight = $('#navBar').innerHeight();
		$('#topSpacer').css('height', headerHeight);
	}
	setDivSizes();
	$(window).resize(function() {	
		setDivSizes();
	});
});