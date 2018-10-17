
// Main navigation on post (frontend)

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

function signUp(){
	$('#signUpLink').click(function(){
		$('#signUp').css('display' , 'block');
	});
	
	$('#closeSignUp').click(function(){
		$('#signUp').css('display', 'none')
	});
};


signUp();