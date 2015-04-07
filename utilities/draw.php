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

	function addElement($idCorpse, $step, $elemType, $elemName){
		$baseImg = ROOT.DS."webroot".DS."images/corpses/corpse_".$idCorpse.".png";
		$elemFolder = ROOT.DS."assets".DS."images".DS.$elemType.DS;

		$fullImg = imagecreatetruecolor(660, 215);
		imagealphablending($fullImg , false); // updated to FALSE
		imagesavealpha($fullImg , true);

		$img = imagecreatefrompng($baseImg);
		$elem = imagecreatefrompng($elemFolder.$elemName);

		imagecopy($fullImg, $img, 0, 0, 0, 0, 660, 215);
		imagecopy($fullImg, $elem, $step*220, 0, 0, 0, 220, 215);
		//imagecopymerge($img, $character, $step*220, 0, 0, 0, 220, 215, 100);
		//($img, $character, $step*220, 0, 0, 0, 220, 215);

		imagepng($fullImg, $baseImg);
		imagedestroy($img);
		imagedestroy($elem);
	}




	

?>