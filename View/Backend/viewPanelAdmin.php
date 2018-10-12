<?php
if(isset($_SESSION) && $_SESSION['role'] == '0')
{
	// Panel d'administration
?>
	

	
<?php 
}
else{
	// Erreur : pas d acces a la page
?>	


<?php } ?>
