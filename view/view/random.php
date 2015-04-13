<section>
	<article>
		<h2>Cadavre #<?php echo $idCorpse; ?></h2>

		<img src= <?php echo $img; ?> alt="corpse"/>
		<p>Un cadavre de
		<?php

		foreach($corpse_by as $author){

					if($author['name']!="anonyme"){
						echo "<a href='".SERVER.DS."user-profile-".$author['id']."'>";
						echo $author['name'];
						echo "</a>";
						echo " - ";	
					}
					else echo "anonyme - ";
			
				
		}

			
		?>

		</p>

		<?php

				echo "<p>".$likesCount." Likes <a href='".SERVER.'/corpse-addLike-'.$idCorpse."'>Like !</p>";

		?>
		
	</article>
</section>