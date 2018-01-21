
<div class="header"> 
	<?php
		$months = array('', 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
		echo $months[date("n")]." ".date("Y");
	?>
</div>

<div>
	<ul class="weekdays">
		<li>Pon.</li>
		<li>Wt.</li>
		<li>Śr.</li>
		<li>Czw.</li>
		<li>Pt.</li>
		<li>Sob.</li>
		<li>Niedz.</li>
	</ul>
</div>

<ul class="days"> 

	<?php
		$first_day_in_month = date('N',mktime(0, 0, 0, date('m'), 1));
		
		for($i = 1; $i < $first_day_in_month; $i++)
			echo "<li></li>\n";
			
		for($i = 1; $i <= $number_days_in_month; $i++)
		{
			$id_day = date("z", mktime(0,0,0,date("n"), $i, date("Y")))+1;
			echo "<a href=\"?day=$id_day\"> <li> $i </li> </a>";
		}
	?>
</ul>