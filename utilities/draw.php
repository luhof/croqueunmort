<?php

	//header('Content-type: image/png');
	if(!isset($_SESSION)){
		session_start();
	}
			

	function createImg($id){

		$fullImg = imagecreatetruecolor(660, 215);
		imagealphablending($fullImg , false); // updated to FALSE
		imagesavealpha($fullImg , true);

		$folder = ROOT.DS."webroot".DS."images/corpses/";
		$img = imagecreatefrompng($folder."default.png");

		imagecopy($fullImg, $img, 0, 0, 0, 0, 660, 215);

		imagepng($fullImg, $folder."corpse_".$id.".png");
		imagedestroy($fullImg);
		imagedestroy($img);
	}

	function addBackground($idCorpse, $background){

		$baseImg = ROOT.DS."webroot".DS."images/corpses/corpse_".$idCorpse.".png";
		$backgroundFolder = ROOT.DS."assets".DS."images".DS."backgrounds".DS;

		$fullImg = imagecreatetruecolor(660, 215);
		imagealphablending($fullImg , false); // updated to FALSE
		imagesavealpha($fullImg , true);

		$img = imagecreatefrompng($baseImg);
		$background = imagecreatefrompng($backgroundFolder.$background);


		imagecopy($fullImg, $img, 0, 0, 0, 0, 660, 215);
		/*add the same background for every image*/
		/*with an offset of $i*220 because every panel is 220px width*/
		for($i=0; $i<3; $i++){
			imagecopy($fullImg, $background, $i*220, 0, 0, 0, 220, 215);
		}


		imagepng($fullImg, $baseImg);

		imagedestroy($fullImg);
		imagedestroy($img);
		imagedestroy($background);
	}

	function addCharacter($idCorpse, $step, $character){
		$baseImg = ROOT.DS."webroot".DS."images/corpses/corpse_".$idCorpse.".png";
		$charactersFolder = ROOT.DS."assets".DS."images".DS."characters".DS;

		$fullImg = imagecreatetruecolor(660, 215);
		imagealphablending($fullImg , false); // updated to FALSE
		imagesavealpha($fullImg , true);

		$img = imagecreatefrompng($baseImg);
		$character = imagecreatefrompng($charactersFolder.$character);

		imagecopy($fullImg, $img, 0, 0, 0, 0, 660, 215);
		imagecopy($fullImg, $character, $step*220, 0, 0, 0, 220, 215);
		//imagecopymerge($img, $character, $step*220, 0, 0, 0, 220, 215, 100);
		//($img, $character, $step*220, 0, 0, 0, 220, 215);

		imagepng($fullImg, $baseImg);
		imagedestroy($img);
		imagedestroy($character);
	}


	/****
	* REPETER POUR addcharacters, addaction, addobject 
	* ou trouver un moyen de tout mettre dans une fonction ? ;)
	******/


	

?>











?>