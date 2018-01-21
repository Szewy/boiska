<div class="header"> 
	<?php
		$months = array('', 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
		echo intval($_GET["day"])." ".$months[date("n")]." ".date("Y")." boisko nr ".$_GET["pitch"];
	?> 
</div>

<div id="day">
	<div class="error"> <?php echo $msg; ?> </div>
</div>

<a href="index.php?day=<?php echo intval($_GET["day"]);?>&pitch=<?php echo intval($_GET["pitch"]);?>" > <div class="button"> Zarezerwuj inną godzinę </div> </a>
<a href="index.php?day=<?php echo intval($_GET["day"]);?>"> <div class="button"> Zarezerwuj inne boisko </div> </a>
<a href="index.php"> <div class="button"> Strona główna </div> </a>