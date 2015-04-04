<section>
	<article>
		<h2>
			Continuer un corps ID#
			<?php echo($idRand); ?>

		</h2>
		<p>
			<?php
				echo $elemType;
				echo "<br/>";
				foreach($elems as $element){
					echo "<div class='elemSelector'>";
					echo "<a href='/croqueunmort/corpse-continued-".$elemType."-".$element['id'.$elemType]."-".$idRand."-".$idPanel."'>";
					echo ($element['name']);
					echo "</a>";
					echo "</div>";
				}



			?>

		</p>
	</article>

</section>