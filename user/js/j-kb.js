$(document).ready(function() {
	
	// set the height of the hightest kb to all
	$('.kb_cont').each(function(){  
	
	var highestBox = 0;
	$('.kb', this).each(function(){
	
		if($(this).height() > highestBox) 
		   highestBox = $(this).height(); 
		});  
	
	$('.kb',this).height(highestBox);
	
	});
	
});