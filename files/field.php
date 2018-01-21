<div class="header"> 
	<?php
		$months = array('', 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
		echo intval($_GET["day"])." ".$months[date("n")]." ".date("Y")." boisko nr ".$_GET["pitch"];
	?> 
</div>

<div id="day">
	<?php
		$start_h = 8;
		$end_h = 22;
		
		echo "<ul id=\"hours\">";
		
		for($i = $start_h; $i < $end_h; $i++)
		{
			echo "<li>";
			
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
						echo "Zaloguj się, aby zarezerwować boisko";
				}
				else
					echo "Rezerwacja niedostępna";
			}
			else
				echo "Boisko zajęte";
			
			echo "</li>";
		}
		
		echo "</ul>"
	?>
</div>

<a href="index.php?day=<?php echo intval($_GET["day"]);?>"> <div class="button"> Wybór boiska </div> </a>
<a href="index.php"> <div class="button"> Strona główna </div> </a>