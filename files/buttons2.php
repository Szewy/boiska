<?php
	if($user_id == 0)
	{
		echo "<a href=\"login.php\"> <div class=\"button\"> Zaloguj się </div> </a>"; 
		echo "<a href=\"register.php\"> <div class=\"button\">  Zarejestruj się </div> </a>"; 
	}
	else
	{	
		echo "<a href=\"logout.php\"> <div class=\"button\"> Wyloguj się </div></a>"; 
	}	
?>