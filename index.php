<?php
	session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
        <title> Boiska sportowe </title>
    </head>
    <body>        
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
						
									echo "Zarezerwowano boisko.";
								}
								else
									echo "Rezerwacja niedostępna <br />";
							}
							else
								echo "Boisko już zajęte <br />";
						}
						else
						{
							echo "Rezerwowane boisko nie istnieje!";
						}
					}
					else
					{
						echo "Nieprawidłowa rezerwacja!";
					}					
				}
				else
					echo "Błędna akcja!";
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
						$start_h = 8;
						$end_h = 22;
						
						for($i = $start_h; $i < $end_h; $i++)
						{
							echo $i . ":00 - " . ($i+1) . ":00 "; 
							
							$day = $_GET["day"];
							$res2 = mysqli_query($mysqlConnection, "SELECT 1 FROM rezerwacje WHERE id_boiska=$id_pitch AND godzina_od = '$i:00:00' AND data='".date("Y").":".date("n").":$day'");
							$exist = mysqli_num_rows($res2);
							
							if($exist == 0)
							{
								$t = $i+1;
								$res2 = mysqli_query($mysqlConnection, "SELECT 1 FROM grafik WHERE godzina_od <= '$i:00:00' AND godzina_do >= '$t:00:00' AND data='".date("Y").":".date("n").":$day'");
								$exist = mysqli_num_rows($res2);
								
								if($exist > 0)
								{
									if($user_id != 0)
										echo "<a href=\"?action=rezerwuj&day=$day&pitch=$id_pitch&hour=$i\"> Zarezerwuj</a> <br />";
									else
											echo "Zaloguj się, aby zarezerwować boisko <br />";
								}
								else
									echo "Rezerwacja niedostępna <br />";
							}
							else
								echo "Boisko zajęte <br />";
						}
					}
					else
					{
						echo "Wybrane boisko nie istnieje!";
					}
					
				}
				else
				{
					$res = mysqli_query($mysqlConnection, "SELECT id_typu, typ FROM typ_boiska");
					$num = mysqli_num_rows($res);
					
					for($i = 0; $i < $num; $i++)
					{
						$pitch_kind = mysqli_fetch_assoc($res); 
						
						$res2 = mysqli_query($mysqlConnection, "SELECT id_boiska, powierzchnia FROM boiska WHERE id_typu=".$pitch_kind["id_typu"]. " ORDER BY powierzchnia");
						$pitch_num = mysqli_num_rows($res2);
						
						if($pitch_num > 0)
						{
							echo "<strong>".$pitch_kind["typ"]."</strong><br />";
							
							for($j = 1; $j <= $pitch_num; $j++)
							{
								$pitch = mysqli_fetch_assoc($res2);
								
								echo "<a href=\"?day=".$_GET["day"]."&pitch=".$pitch["id_boiska"]."\" >Boisko nr $j (powierzchnia: ".$pitch["powierzchnia"].") </a> <br />";
							}
							
							echo "<br />";
						}
					}
				}
			}
			else
			{
				for($i = 1; $i <= $number_days_in_month; $i++)
				{
					$id_day = date("z", mktime(0,0,0,date("n"), $i, date("Y")))+1;
					echo "<a href=\"?day=$id_day\"> $i </a>";
				}
				
			}
			
			if($user_id == 0)
			{
				echo "<br /> <a href=\"login.php\"> Zaloguj się </a>"; 
				echo "<br /> <a href=\"register.php\"> Zarejestruj się </a>"; 
			}
			else
			{
				echo "<br /> <a href=\"logout.php\"> Wyloguj się </a>"; 
			}				
           
            mysqli_close($mysqlConnection);
        ?> 
    </body>
</html>
