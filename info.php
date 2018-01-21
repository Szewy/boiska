<?php
	session_start();

	if(!isset($_SESSION['user_id']))
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
				Informacje o koncie
			</div>
			<div id="day">
				<?php
					$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
					
					mysqli_select_db($mysqlConnection, "boiska");
					mysqli_set_charset($mysqlConnection, "utf8");
					
					$res = mysqli_query($mysqlConnection, "SELECT * FROM uzytkownicy WHERE id_uzytkownika=".$_SESSION['user_id']);
					$rows = mysqli_num_rows($res);
				
					$user = mysqli_fetch_assoc($res);

					mysqli_close($mysqlConnection); 
					
					echo "Login: ".$user["login"]."<br />"; 
					echo "Imię: ".$user["imie"]."<br />"; 
					echo "Nazwisko: ".$user["nazwisko"]."<br />"; 
					
					if($user["admin"] == 1 && $user["pracownik"] == 1)
						echo "Jesteś głównym administratorem oraz pełnisz rolę pracownika kompleksu. <br />";
					else if($user["admin"] == 1)
						echo "Jesteś głównym administratorem  <br />";
					else if($user["pracownik"] == 1)
						echo "Pełnisz rolę pracownika kompleksu. <br />";
				?>
			</div>
			<a href="index.php"> <div class="button"> Strona główna </div> </a>
			<?php require_once("files/buttons2.php"); ?>
		</div>
    </body>
</html>
