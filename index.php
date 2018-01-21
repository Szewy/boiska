<?php
	session_start();
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
			<?php
				$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
				
				mysqli_select_db($mysqlConnection, "boiska");
				mysqli_set_charset($mysqlConnection, "utf8");
				
				$number_days_in_month = cal_days_in_month(CAL_GREGORIAN, date("n"), date("Y")); 
				
				if(isset($_SESSION['user_id']))
					$user_id = $_SESSION['user_id'];
				else
					$user_id = 0;
				
				if($user_id != 0 && isset($_GET["action"]) and !empty($_GET["action"]))
				{
					if($_GET["action"] == "rezerwuj")
					{
						if(isset($_GET["day"]) and !empty($_GET["day"]) and intval($_GET["day"]) >= 1 and intval($_GET["day"]) <= $number_days_in_month and
						   isset($_GET["pitch"]) and !empty($_GET["pitch"]) and intval($_GET["pitch"]) >= 1 and 
						   isset($_GET["hour"]) and !empty($_GET["hour"]) and intval($_GET["hour"]) >= 8 and intval($_GET["hour"]) < 22)
						{
							$day = intval($_GET["day"]);
							$id_pitch = intval($_GET["pitch"]);
							$hour = intval($_GET["hour"]);
							$hour_end = $hour+1;
							
							$id_pitch = intval($_GET["pitch"]);
						
							$res = mysqli_query($mysqlConnection, "SELECT 1 FROM boiska WHERE id_boiska=$id_pitch");
							$exist = mysqli_num_rows($res);
						
							if($exist == 1)
							{
								$res = mysqli_query($mysqlConnection, "SELECT 1 FROM rezerwacje WHERE id_boiska=$id_pitch AND godzina_od = '$hour:00:00' AND data='".date("Y").":".date("n").":$day'");
								$exist = mysqli_num_rows($res);
								
								if($exist == 0)
								{
									$res2 = mysqli_query($mysqlConnection, "SELECT 1 FROM grafik WHERE godzina_od <= '$hour:00:00' AND godzina_do >= '$hour_end:00:00' AND data='".date("Y").":".date("n").":$day'");
									$exist = mysqli_num_rows($res2);
									
									if($exist > 0)
									{
										$res = mysqli_query($mysqlConnection, "INSERT INTO `rezerwacje` (`id_rezerwacji`, `id_uzytkownika`, `id_boiska`, `data`, `godzina_od`, `godzina_do`) VALUES (NULL, $user_id, $id_pitch, '2018-01-$day', '$hour:00:00', '$hour_end:00:00')");
							
										$msg = "Zarezerwowano boisko.";
										require_once("files/msg.php");
									}
									else
									{
										$msg = "Rezerwacja niedostępna!";
										require_once("files/error_msg.php");
									}
								}
								else
								{
									$msg = "Boisko już zajęte!";
									require_once("files/error_msg.php");
								}
							}
							else
							{
								$msg = "Rezerwowane boisko nie istnieje!";
								require_once("files/error_msg.php");
							}
						}
						else
						{
							$msg = "Nieprawidłowa rezerwacja!";
							require_once("files/error_msg.php");
						}
					}
					else
					{
						$msg = "Błędna akcja!";
						require_once("files/error_msg.php");
					}
					
					require_once("files/buttons2.php");
				}
				else if(isset($_GET["day"]) and !empty($_GET["day"]) and intval($_GET["day"]) >= 1 and intval($_GET["day"]) <= $number_days_in_month)
				{
					if(isset($_GET["pitch"]) and !empty($_GET["pitch"]))
					{
						$id_pitch = intval($_GET["pitch"]);
						
						$res2 = mysqli_query($mysqlConnection, "SELECT 1 FROM boiska WHERE id_boiska=$id_pitch");
						$exist = mysqli_num_rows($res2);
							
						if($exist == 1)
						{
							require_once("files/field.php");
							require_once("files/buttons2.php");
						}
						else
						{
							require_once("files/wrong_field.php");
							require_once("files/buttons2.php");
						}						
					}
					else
					{
						require_once("files/day.php");
						require_once("files/buttons2.php");
					}
				}
				else
				{
					require_once("files/main.php");
					require_once("files/buttons.php");
				}
			   
				mysqli_close($mysqlConnection);
			?>
		</div>		
    </body>
</html>
