<section>
	<article>
		<h2>Créer un corps</h2>
		Choisissez votre <?php echo $elemType; ?> !
		<?php
		
		foreach($elems as $element){
			echo "<div class='elemSelector'>";
			echo($element['name']);
			echo "</div>";
		}
		?>
	</article>
</section>