<?php
	if($user_id == 0)
	{
		echo "<a href=\"login.php\"> <div class=\"button\"> Zaloguj się </div> </a>"; 
		echo "<a href=\"register.php\"> <div class=\"button\">  Zarejestruj się </div> </a>"; 
	}
	else
	{
		echo "<a href=\"info.php\"> <div class=\"button\"> Informacje o koncie </div> </a>";
		echo "<a href=\"fields.php\"> <div class=\"button\"> Zarezerwowane bioska </div> </a>";

		$res = mysqli_query($mysqlConnection, "SELECT admin, pracownik FROM uzytkownicy WHERE id_uzytkownika=".$_SESSION['user_id']);
		$user = mysqli_fetch_assoc($res);
		
		if($user["admin"] == 1)
		{
			echo "<a href=\"new_field.php\">    <div class=\"button\"> Dodaj nowe boisko </div> </a>"; 
			echo "<a href=\"new_employee.php\">  <div class=\"button\">Dodaj nowego pracownika </div> </a>"; 
			echo "<a href=\"all_reservations.php\">  <div class=\"button\">Wszystkie rezerwacje </div> </a>"; 
			echo "<a href=\"all_employee.php\">  <div class=\"button\">Grafik wszystkich pracowników </div> </a>"; 
		}
		
		if($user["pracownik"] == 1)
		{
			echo "<a href=\"new_work_date.php\"> <div class=\"button\"> Dodaj nowy termin pracy </div>  </a>"; 
			echo "<a href=\"my_work_dates.php\">  <div class=\"button\">Moje terminy pracy </div> </a>";  
		}
		
		echo "<a href=\"logout.php\"> <div class=\"button\"> Wyloguj się </div></a>"; 
	}	
?>