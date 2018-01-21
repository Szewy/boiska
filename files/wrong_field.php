<div class="header"> 
	<?php
		$months = array('', 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
		echo intval($_GET["day"])." ".$months[date("n")]." ".date("Y");
	?> 
</div>

<div id="day">
	<div class="error">Wybrane boisko nie istnieje!</div>
</div>

<a href="index.php?day=<?php echo intval($_GET["day"]);?>"> <div class="button"> Wybór boiska </div> </a>
<a href="index.php"> <div class="button"> Strona główna </div> </a>