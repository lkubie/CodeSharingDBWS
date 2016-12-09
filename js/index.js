// JavaScript Document
$(document).ready(function(){
	
	$('.headerLink').on('click', 'a', function(event){
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top - 80
    }, 500);
});
	
	
	
	function makeid()
	{
    var text = [];
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < 30; i++ ){
		var numPossible = possible.length - 1; //minus one to get from length to index
		var randomIndex = Math.floor(Math.random() * numPossible );
		//console.log(possible[randomIndex]);
        text[i] = possible[randomIndex];	
		}
    return text.join("");
	}
	
	var fileCode = makeid();
	
	function checkForFileEnter(fileName){
		var exists;
		$.post(
			'DBBackend.php',
			{file: fileName},
			function(data, status){
				//alert("Data: " + data + "\nStatus: " + status);
				//now parse the data?
				var fullResponce = $(data);
				var boolString = fullResponce[0]['textContent'];
				if(boolString == 'false'){
					console.log('Does not Exists');
					$('#error').text('Sorry! That file does not exist!');
					
					}
				else if(boolString == 'true'){
					window.location.href="loadDoc.php?file=" + fileName;
					
					}
			}
			);
						
		}
	function addNewFiletoDB(fileName){
		var toCreate = fileName;
		$.post('addNew.php', {file: toCreate}, function(toCreate){
			window.location.href="loadDoc.php?file=" + fileName;
			});
		}		
	function checkForFileCreate(fileName){
			var exists;
			$.post(
				'DBBackend.php',
				{file: fileName},
				function(data){
					var fullResponce = $(data);
					var boolString = fullResponce[0]['textContent'];
					if(boolString == 'false'){
						addNewFiletoDB(fileName);
						//console.log('Does not Exist. I would make a new entry now! and then take you there!');
						}
					else if(boolString == 'true'){
						var newName = makeid();
						checkForFileEnter(newName);
						
						}
				}
				);
							
			}
		$('#createNew').on('click', function(event){
			var createdFileName = makeid();
			checkForFileCreate(createdFileName);
		});
		
		
		$('#indexSubmit').on('click', function(event){
			event.preventDefault();
			var desidredFileCode = $(this).siblings('#fileNameText').val();
			checkForFileEnter(desidredFileCode);
		});
	
		$('#joinSomeoneLink').on('click', function(){
			
			$('#meetSomeone').slideDown();
			
		});
		$('#meetSomeoneX').on('click', function(){
			if($('#error').is(':visible')){
				$('#error').hide();
				}
			$('#meetSomeone').slideUp();
		});
});