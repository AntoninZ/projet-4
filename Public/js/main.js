
// Main navigation on post (frontend)

var test = 0;

function toggleSummary(){
	event.preventDefault();	if(test === 0){
	$('#summary').animate({'right': '0%'}, 'slow');
	test = 1;
	}
	else{
		$('#summary').animate({'right': '-100%'}, 'slow');
		console.log('deux');
		console.log($('#summary').css('margin-right'));
		test = 0
	}
	
}

function slide(up, down){
	$(up).slideUp();
	$(down).slideDown();
}

function notification(){
	setTimeout(function(){
		$('#notification').fadeOut('slow')
	}, 3000);
	
}


$(document).ready(notification());