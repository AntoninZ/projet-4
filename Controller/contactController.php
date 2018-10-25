<?php 

function sendMail(){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	
	$messageSend = '<p>Nom/Prénom : ' . $name . '</p><p> Email : ' . $email . '</p><p> Message : </p><p>' . $message . '</p>';
	
	mail('antonin.zimmer@gmail.com', 'E-developpeur : nouveau message', $messageSend);
	
}