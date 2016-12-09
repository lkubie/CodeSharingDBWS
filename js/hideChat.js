
$(document).ready(function() {
	
	$('#hideChat').on('click', function(){
		 $('#sidebar').hide('slide',{direction:'right'},500, function(){
			 $('#currentCodeBox').width('88%');
			$('#showChat').show();
			 });
		
	
		
	});
	$('#showChat').on('click', function(){
		$('#showChat').hide();
		$('#currentCodeBox').width('60%');
		$('#sidebar').show('slide',{direction:'right'},500);
		
	});
});

