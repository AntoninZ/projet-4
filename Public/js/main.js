

var test = 0;

function toggleSummary(){
	event.preventDefault();	if(test === 0){
	$('#summary').animate({'margin-right': '0%'}, 'slow');
	console.log('ok');
	test = 1;
	}
	else{
		$('#summary').animate({'margin-right': '-20%'}, 'slow');
		console.log('deux');
		console.log($('#summary').css('margin-right'));
		test = 0
	}
	
}

