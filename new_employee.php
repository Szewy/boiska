<?php
	session_start();
	
	if(!isset($_SESSION['user_id']))
		header("location: login.php");
	
	$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
	
	mysqli_select_db($mysqlConnection, "boiska");
	mysqli_set_charset($mysqlConnection, "utf8");
	
	$res = mysqli_query($mysqlConnection, "SELECT admin FROM uzytkownicy WHERE id_uzytkownika=".$_SESSION['user_id']);
	$rows = mysqli_num_rows($res);

	$user = mysqli_fetch_assoc($res);

	mysqli_close($mysqlConnection);
	
	if($user["admin"] == 0)
		header("location: login.php");
	
	$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<link rel="stylesheet" href="css/styles.css">
		
        <title> Boiska sportowe </title>
    </head>
    <body>  
		<div id="center">
			<div class="header"> 
				Zatrudnij nowego pracownika
			</div>
		
			<div id="day">	
				<?php
					$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
					
					mysqli_select_db($mysqlConnection, "boiska");
					mysqli_set_charset($mysqlConnection, "utf8");
					
					
					if(isset($_GET["id"]) && !empty($_GET["id"]))
					{	
						$res = mysqli_query($mysqlConnection, "SELECT id_uzytkownika FROM uzytkownicy WHERE pracownik=0 AND id_uzytkownika=".$_GET["id"]);
						$rows = mysqli_num_rows($res);
						
						if($rows == 0)
						{
							echo "Błędne id użytkownika do zatrudnienia <br/>";
						}
						else
						{
							$res = mysqli_query($mysqlConnection, "UPDATE uzytkownicy SET pracownik = 1 WHERE id_uzytkownika=".$_GET["id"]);
							echo "Nowy pracownik zatrudniony <br/>";
						}
					}	
					
					$res = mysqli_query($mysqlConnection, "SELECT id_uzytkownika, imie, nazwisko FROM uzytkownicy WHERE pracownik=0" );
					$rows = mysqli_num_rows($res);
					
					if($rows == 0)
					{
						echo "Brak użytkowników do zatrudnienia <br/>";
					}
					
					for($i = 0; $i < $rows; $i++)
					{
						$user = mysqli_fetch_assoc($res);
					
						echo $user["imie"]." ".$user["nazwisko"]." <a href=\"new_employee.php?id=".$user["id_uzytkownika"]."\"  class=\"employ\" >zatrudnij</a> <br />";
					}
					
					mysqli_close($mysqlConnection);  
				?>
			</div>
			
			<a href="index.php"> <div class="button"> Strona główna </div> </a>
			
			<?php require_once("files/buttons2.php"); ?>
		</div>
    </body>
</html>
