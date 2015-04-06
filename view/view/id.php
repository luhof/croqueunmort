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

		<p> bouton like ici </p>
		
	</article>
</section>