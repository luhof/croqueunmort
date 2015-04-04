<section>
	<article>
		<h2>Créer un corps</h2>
		Choisissez votre <?php echo $elemType; ?> !
		<?php
		
		foreach($elems as $element){
			echo "<div class='elemSelector'>";
			echo "<a href='/croqueunmort/corpse-created-".$elemType."-".$element['id'.$elemType]."'>";
			echo ($element['name']);
			echo "</a>";
			echo "</div>";
		}
		?>
	</article>
</section>