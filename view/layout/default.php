<?php
	if(!isset($_SESSION)){
		session_start();
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="UTF-8"/>
	<title>Croque Un Mort</title>


	<!-- Compatibilité tout écran -->
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

	<!-- Appels CSS -->
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link type="text/css" rel="stylesheet" href="css/lightSlider.css" />
	<link href="css/responsive.css" rel="stylesheet" type="text/css" />

	<!-- Optimisation HTML5 pour IE < 9 -->
	<!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
	<![endif]-->
    
</head>



<body>

	<header>
		<div class="right">
		<?php if(!isset($_SESSION['idUser']) && !isset($_SESSION['username'])){ ?>

			<a class="btn" href="/croqueunmort/user-login"><i class="fa fa-sign-in"></i> S'inscrire/Se connecter</a>
		
		<?php }
		  else{ ?>

			<p>Bienvenue, <a href="<?php echo SERVER.'/user-profile-'.$_SESSION['idUser']; ?>"><?php echo $_SESSION['username']; ?></a> ! </p>
			<a class="btn" href="/croqueunmort/user-disconnect"><i class="fa fa-sign-out"></i> Se déconnecter</a>

		<?php } ?>
		</div>
		
    	<h1>
			<span class="title1">Croque un mort</span><br />Cuisinez vos cadavres exquis
		</h1>

		<hr />
	</header>
	
	<?php $pageName = basename($_SERVER['REQUEST_URI']); ?>

	<nav>
   	<ul>
      <li <?php if ($pageName == 'croqueunmort') { echo 'class="active-menu"'; } ?>>
        <a href="/croqueunmort/" title="Accueil">
          <i class="fa fa-home fa-fw"></i>
          <span class="menu">Accueil</span>
        </a>
      </li>
      <li <?php if ($pageName == 'view-last') { echo 'class="active-menu"'; } ?>>
        <a href="/croqueunmort/view-last" title="Derniers cadavres">
					<i class="fa fa-history fa-fw"></i>
          <span class="menu">Derniers cadavres</span>
        </a>
      </li>
      <li <?php if ($pageName == 'view-top') { echo 'class="active-menu"'; } ?>>
        <a href="/croqueunmort/view-best" title="La crème">
          <i class="fa fa-star fa-fw"></i>
          <span class="menu">La crème</span>
        </a>
      </li>
      <li <?php if ($pageName == 'view-random') { echo 'class="active-menu"'; } ?>>
        <a href="view-random" title="Au hasard">
          <i class="fa fa-random fa-fw"></i>
          <span class="menu">Au hasard</span>
        </a>
      </li>
      <li <?php if ($pageName == 'corpse-create') { echo 'class="active-menu"'; } ?>>
        <a href="/croqueunmort/corpse-create" title="Entamer un cadavre">
					<i class="fa fa-comment fa-fw"></i>
          <span class="menu">Entamer un cadavre</span>
        </a>
      </li>
      <li <?php if ($pageName == 'corpse-continuecorpse') { echo 'class="active-menu"'; } ?>>
        <a href="/croqueunmort/corpse-continuecorpse" title="En continuer un">
          <i class="fa fa-comments-o fa-fw"></i>
          <span class="menu">En continuer un</span>
        </a>
      </li>
    </ul>
  </nav>


	<?php echo $contentLayout ?>


	<footer>
		<p>© <?php echo date('Y');?> <a href="#">Croque un mort</a>, cuisinez vos cadavres exquis | <a href="#" title="Mentions légales">Mentions légales</a> | <a href="#" title="Contact">Contact</a></p>
	</footer>

</body>
</html>