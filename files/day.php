<div class="header"> 
	<?php
		$months = array('', 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
		echo intval($_GET["day"])." ".$months[date("n")]." ".date("Y");
	?> 
</div>

<div id="day">
	<?php
		$res = mysqli_query($mysqlConnection, "SELECT id_typu, typ FROM typ_boiska");
		$num = mysqli_num_rows($res);
		
		echo "<div class=\"row\">";
		
		for($i = 0; $i < $num; $i++)
		{
			$pitch_kind = mysqli_fetch_assoc($res); 
			
			$res2 = mysqli_query($mysqlConnection, "SELECT id_boiska, powierzchnia FROM boiska WHERE id_typu=".$pitch_kind["id_typu"]. " ORDER BY id_boiska");
			$pitch_num = mysqli_num_rows($res2);
			
			
			if($pitch_num > 0)
			{
				echo "<div class=\"field_type\">";
				
				echo "<strong>".$pitch_kind["typ"]."</strong><br /> <ul>";
				
				for($j = 1; $j <= $pitch_num; $j++)
				{
					$pitch = mysqli_fetch_assoc($res2);
					
					echo "<a href=\"?day=".$_GET["day"]."&pitch=".$pitch["id_boiska"]."\" > <li> Boisko nr ".$pitch["id_boiska"]." (powierzchnia: ".$pitch["powierzchnia"]."m<sup>2</sup>) </li></a>";
				}
				
				echo "</ul></div>";
			}
		}
		
		echo "</div>";
	?>
</div>

<a href="index.php"> <div class="button"> Strona główna </div> </a>