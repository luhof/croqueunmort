<section>
	<article>
		<h2>Cadavre #<?php echo $idCorpse; ?></h2>

		<img src= <?php echo $img; ?> alt="corpse"/>
		<p>Un cadavre de
		<?php

		foreach($corpse_by as $author){

				echo "<a href='".SERVER.DS."user-profile-".$author['id']."'>";
				echo $author['name'];
				echo "</a>";
				echo " - ";
			
				
		}

			
		?>

		</p>

		<p> bouton like ici </p>
		
	</article>
</section>