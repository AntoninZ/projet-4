
// Main navigation on post (frontend)

var test = 0;

function toggleSummary(){
	event.preventDefault();	if(test === 0){
	$('#summary').animate({'right': '0%'}, 'slow');
	test = 1;
	}
	else{
		$('#summary').animate({'right': '-100%'}, 'slow');
		test = 0
	}
	
}

// Slide up & down the logins forms
function slide(up, down){
	$(up).slideUp();
	$(down).slideDown();
}

// In Admin panel, notification fadeOut after 3 sec
function notification(){
	setTimeout(function(){
		$('#notification').fadeOut('slow')
	}, 3000);
	
}

// Scroll Top Button on post

function buttonTop(){
	$("html, body").animate({ scrollTop: 0 }, 1000);
}


// Agreement cookie

function agreeCookie(){	
	if(localStorage.getItem("agreement") === 'true')
	{
		$('#cookieAgree').css({'display' : 'none'});
	}
	else
	{
		$('#btnCookie').click(function(){
			localStorage.setItem('agreement', 'true');
			$('#cookieAgree').css({'display' : 'none'});
		});
	}
}

$(document).ready(notification());
$(document).ready(agreeCookie());