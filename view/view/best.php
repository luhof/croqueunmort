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

				echo "<p>".$corpse['likesCount']." Likes <a href='".SERVER.'/corpse-addLike-'.$corpse['idCorpse']."'>Like !</p>";

			?>
		</article>
	</section>
	<?php
	}



?>
