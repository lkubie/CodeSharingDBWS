$(document).ready(function() {
	var newText = '';
	var content = '';
	var changes = false;
	var fileName = $('#fileNameSpan').text();
	function saveChanges() {
			if (changes) {
				$('#status').html('Status: <span class="notReady">saving...</span>');
				//get the data to save
				content = $("#theCode").text();
				if (content.match(/^[\r\n]/)) { //if it starts with a weird line break then replace it.
					newText = content.replace(/[\r\n]/, "", 1);
				} else {
					newText = content;
				}
				if (newText.match(/[\r\n]$/)){
					newText = content.replace(/[\r\n]$/, "", 1);
				}
				//update DB here
				
				$.post("saveCode.php", {file:fileName, text: newText}, function(data){
					//console.log(data);
					});
				$('#status').html('Status: <span class="ready">ready</span>');
				changes = false;
			}
		} //end saveChangesFunction
	$("#currentCodeBox").on('input', function() {
		$('#status').html('Status: <span class="notReady">saving...</span>');
		changes = true;
	});
	setInterval(saveChanges, 2000);
	//I'm also putting the code to automatically copy the code to your clipboard here.
	$("#fileNameSpan").on('click', function() {
		new Clipboard('#fileNameSpan');//copy to clipbard
		$('#copied').fadeIn('fast').delay(3000).fadeOut('slow');
		
		
		//keep this in case the clipboard breaks
		/*var clipboard = new Clipboard('#fileNameSpan');
		clipboard.on('success', function(e) {
			console.info('Action:', e.action);
			console.info('Text:', e.text);
			console.info('Trigger:', e.trigger);
			e.clearSelection();
		});
		clipboard.on('error', function(e) {
			console.error('Action:', e.action);
			console.error('Trigger:', e.trigger);
		});
		//code to copy the file name to clipboard*/
	});
});