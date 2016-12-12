$(document).ready(function() {
	
	var fileName = $('#fileNameSpan').text();
	var range = document.createRange();
	var sel = window.getSelection(); //set the selection
	var selNode;
	var caretOffset;
	
	//now do this over and over
	function getContents() {
			if(sel.rangeCount > 0){
			range = sel.getRangeAt(0);
			//range.deleteContents();
			var updatedContent = '';
			selNode = range.startContainer; //this is grabbing the wrong thing after one iteration
			//console.log(selNode);
			caretOffset = range.startOffset;//set the current offset
			}
			if(selNode == null){
				//console.log('selNode is null');
			}
			$.get("getCode.php", {file: fileName}, function(data){
				updatedContent = data;
				$('#theCodeCode').html(updatedContent);
				Prism.highlightAll();
				});
			if(selNode == null){
				//if my cursor isnt anywhere then don't try to put it somehwere
				}
			else{
				range.setStart(selNode, caretOffset);
				range.collapse(true);
				//console.log(range);
				sel.removeAllRanges();
				sel.addRange(range);
				//console.log('result range:');
				//console.log(range);
				}
				//console.log(range);
		}
		
			//setInterval(getContents, 2000);//toggle these two lines
			//getContents();//to make the horrible stop
	
		
});