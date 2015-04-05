<?php

	foreach($corpseArray as $corpse){
	?>

	<section>
		<article>
			<h2>Cadavre #<?php echo $corpse['idCorpse']; ?></h2>

			<img src= <?php echo "./images/corpses/".$corpse['img']; ?> alt="corpse"/>
			<p>Un cadavre de
			<?php

			foreach($corpse['corpse_by'] as $author){

				if($author != " " || $author != ""){
					echo "<a href='".ROOT.DS."user-profile-".$author."'>";
					echo $author;
					echo "</a>";
				}
			}
			?>

			</p>
			<p> bouton like ici </p>
		</article>
	</section>
	<?php
	}



?>
