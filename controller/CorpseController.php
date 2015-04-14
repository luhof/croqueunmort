<?php

	if(!isset($_SESSION)){
		session_start();
	}

	class CorpseController extends Controller{


		function create(){
			if(!isset($_SESSION['idUser']) && !isset($_SESSION['username'])){
				header('location: '.SERVER.DS.'user-login');
			}
			$arrayOfElems = array(
				'Character',
				'Object',
				'Action',
				'Place'
				);

			$this->updatePanel($arrayOfElems, 1);

		}

		function updatePanel($arrayOfElems, $currPanel){
			$this->loadModel('Corpse');
			//select which element to add (here random)
			

			//now it's random because why not yo
			$elemType = $arrayOfElems[rand(0,count($arrayOfElems)-1)];

			//select corresponding stuff (3 random)
			$elems 	= $this->Corpse->getRandItemId($elemType, 3);
			//get more info on each element

			foreach($elems as &$element){
				$element = $element['id'.$elemType];
				$element = $this->Corpse->getElemInfosById($elemType, $element);
			}

			$this->set('elemType', 	$elemType);
			$this->set('elems', $elems);
			$this->set('idPanel', $currPanel);
		}



		function created(){
			$params = $this->request->params;

			//for more security : check if action and id exist !
			if(count($params)!= 2 || empty($params[0]) || empty($params[1])){
				$this->error("Petit malin va ;)");
			}

			$elemType	= $params[0];
			$id 		= $params[1];

			$this->loadModel('Corpse');

			try{
				$this->Corpse->insertNewCorpse();
				$lastId = $this->Corpse->db->lastInsertId();

				$this->Corpse->setCorpseUrl($lastId);
				$this->Corpse->insertNewPanel($lastId, 1);


				if($elemType=='Place'){
					$this->Corpse->setCorpsePlace($lastId, $id);
				}
				else{
					$this->Corpse->setPanelValue($elemType, $id, $lastId);
				}

				if(isset($_SESSION['username'])){
					$user = $_SESSION['username'];
				}
				else $user = "anonyme";

				$this->Corpse->addUserToCorpseBy($user, $lastId);
				$this->set('idCorpse', $lastId);
			
			}

			catch(Exception $e){
				echo "erreur : ".$e->getMessage()."<br/>";
				exit();
			}
			
		}

		function continuecorpse(){
			
			if(isset($this->request->params[0])){
				$params = $this->request->params;
				$randId = $params[0];
			}

			//find a random corpse
			$this->loadModel('Corpse');

			if(!isset($randId)){
				$randId = $this->Corpse->getRandCorpseId(false);
				$randId = $randId['idCorpse'];
			}
			
			$this->set('idRand', $randId);
			

			if($randId == false){
				$this->error("Plus de cadavre à continuer !");
			}
			
			//set which step
			$panels = $this->Corpse->getPanelsByCorpseId($randId);

			$panelsNum = count($panels);
			$currPanel = $panels[$panelsNum-1];

			$fields = array();

			if($currPanel['idCharacter']==NULL) array_push($fields, 'Character');
			if($currPanel['idAction']==NULL)	array_push($fields, 'Action');
			if($currPanel['idObject']==NULL)	array_push($fields, 'Object');

			if(!$this->Corpse->issetPlaceFromCorpse($randId)){
				array_push($fields, 'Place');
			}

			$this->updatePanel($fields, $currPanel['idCase']);

		}

		function continued(){
			
			$this->loadModel('Corpse');

			if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
				$user = $_SESSION['username'];
			}
			else{
				$user = "anonyme";
			}

			$params = $this->request->params;
			if(count($params)!= 4 || empty($params[0]) || empty($params[1]) || empty($params[2]) || empty($params[3])){
				$this->eUnauthorized("Petit malin va ;)");
			}

			$elemType	= $params[0];
			$idElem 	= $params[1];
			$idCorpse	= $params[2];
			$idPanel	= $params[3];

			if($elemType!='Place'){
				$this->Corpse->setPanelValue($elemType, $idElem, $idPanel);
			}
			else{
				$this->Corpse->setCorpsePlace($idCorpse, $idElem);
			}

			$this->Corpse->addUserToCorpseBy($user, $idCorpse);

			$finished = $this->isPanelFinished($idPanel, $idCorpse);

			if($finished==true){
				
				$this->Corpse->setPanelAsFinished($idPanel);

				$panels = $this->Corpse->getPanelsByCorpseId($idCorpse);


				if(count($panels)==3){
					foreach($panels as $panel){
						if($panel['finished']==false) $finished = false;
					}
				}
				else{
					$finished = false;
					$this->Corpse->insertNewPanel($idCorpse, (count($panels))+1);
				}
				
				if($finished == true){
					$this->Corpse->setCorpseAsFinished($idCorpse);
					$this->drawCorpse($idCorpse);
				}



			}

			header('location: '.SERVER.DS.'corpse-continuecorpse');
			exit();



		}

		function isPanelFinished($idPanel, $idCorpse){
			$this->loadModel('Corpse');
			$panel = $this->Corpse->getPanelById($idPanel);

			if($panel['idAction']!=NULL && $panel['idCharacter']!=NULL && $panel['idObject']!=NULL){
				
				if($panel['step']==1){
					
					$issetPlace = $this->Corpse->issetPlaceFromCorpse($idCorpse);
					if($issetPlace == false) return false;

				}
				return true;
			}

			return false;

		}


		function drawCorpse($idCorpse){
			require_once ROOT.DS."utilities".DS."draw.php";
			$this->loadModel('Corpse');
			$this->loadModel('Items');
			/*On met TOUTES LES INFOS dans Panel*/
			$panels = $this->Corpse->getPanelsByCorpseId($idCorpse);
			$corpse = $this->Corpse->getCorpseInfo($idCorpse);
			$idPlace = $corpse['idPlace'];

			$background = $this->Items->getPlaceUrlById($idPlace);
			createImg($idCorpse);
			addBackground($idCorpse, $background);
			$panelsId = array();

			foreach($panels as $panel)
				array_push($panelsId, $panel['idCase']);

			$elemsId = array();
			foreach($panelsId as $idPanel)
				$elems = array_push($elemsId,$this->Items->getElemsIdByPanel($idPanel));

			foreach($elemsId as &$elem){
				$elem['idCharacter'] = $this->Items->getElemNameById("Character", $elem['idCharacter']);
				$elem['idObject'] = $this->Items->getElemNameById("Object", $elem['idObject']);
				$elem['idAction'] = $this->Items->getElemNameById("Action", $elem['idAction']);
			}

			for($i=0; $i<3; $i++){
				//addCharacter($idCorpse, $i, "charlie.png");
				addElement($idCorpse, $i, "characters", $elemsId[$i]['idCharacter']['url']);
				addElement($idCorpse, $i, "objects", $elemsId[$i]['idObject']['url']);
				addElement($idCorpse, $i, "actions", $elemsId[$i]['idAction']['url']);
				//addobject
			}
			

			//$this->render("index");
			header('location: '.SERVER.DS.'view-id-'.$idCorpse);
			exit();


		}

		function addLike($idCorpse){

			if(!isset($_SESSION['idUser']) || !isset($_SESSION['username'])){
				header('location: '.SERVER.DS.'user-login');
				exit();
			}

			$idUser = $_SESSION['idUser'];
			$params = $this->request->params;

			if(count($params)!= 1 || empty($params[0])){
				$this->error("Petit malin va ;)");
			}
			
			$idCorpse = $params[0];

			$this->loadModel('Corpse');
			
			$hasLiked = $this->Corpse->hasUserLikedPost($idUser, $idCorpse);
			
			if(!$hasLiked){
				//echo "add like ".$idUser." - ".$idCorpse;
				$this->Corpse->addLike($idUser, $idCorpse);
				header('location: '.SERVER.DS.'view-id-'.$idCorpse);
			}

			else{
				//echo "rm like ".$idUser." - ".$idCorpse;
				$this->Corpse->rmLike($idUser, $idCorpse);
				header('location: '.SERVER.DS.'view-id-'.$idCorpse);
				//echo "he has liked yet ";
			}





			exit();

			

		}


	}

?>