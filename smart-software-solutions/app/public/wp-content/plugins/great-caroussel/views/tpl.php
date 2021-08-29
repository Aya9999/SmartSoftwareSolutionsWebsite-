	<div id="caroussel-<?php echo $caroussel->id ?>" class="great_caroussel" style="width: 100%;">
		<div class="rotator" rel="<?php echo sizeof($contents) ?>" style="transform: rotate(0deg)">

	<?php

		foreach($contents as $i => $content)
		{
			echo '<div class="content">'.$content->content.'</div>';
		}

	?>

		</div>
		<a href="#" class="prev"><img src="<?php echo plugins_url( 'images/back.png', dirname(__FILE__) ) ?>" /></a>
		<a href="#" class="next"><img src="<?php echo plugins_url( 'images/forward.png', dirname(__FILE__) ) ?>" /></a>
	</div>
	
</body>
</html>