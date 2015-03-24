<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Croque Un Mort</title>
		<link rel="stylesheet" href="/croqueunmort/webroot/css/style.css"/>
	</head>

	<body>
		<header>
			<h1>Croque Un Mort</h1>
			<a href="/croqueunmort/">Index</a> | 
			<a href="/croqueunmort/pages-top">Le top !</a> |
			<a href="/croqueunmort/pages-last">Les derniers</a><br/>
			<a href="/croqueunmort/user-login">Login/Inscription</a><br/>
			<a href="/croqueunmort/corpse-create">Créer un nouveau cadavre</a> | 
			<a href="/croqueunmort/corpse-continueCorpse">Continuer un cadavre</a>
		</header>


		<div id="wrapper">
			<?php echo $contentLayout ?>

			<!--<h2> every user </h2>
			<?php
				$users = $this->request('Pages', 'getUsers');
				foreach($users as $user){
					echo('<a href=/croqueunmort/pages/view/'.$user->idUser.'>'.$user->username.'</a><br/>');
				}
			?>-->

		</div>

	</body>

</html>