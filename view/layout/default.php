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
		<a class="btn" href="/croqueunmort/user-login"><i class="fa fa-sign-in"></i> S'inscrire/Se connecter</a>
		<hr />
		<h1>
			<span class="title1">Croque un mort</span><br />Cuisinez vos cadavres exquis
		</h1>
	</header>
	
	<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>

	<!-- Ce code là est super dégueu en plus il marche pas mais on le fera plus beau plus tard -->
	<nav>
   		<ul>
			<li
				    <?php if ($page == 'index.php') {
							echo 'id="active-menu"';}
						?>>
               	<a href="/croqueunmort/" title="Accueil">
               		<span class="fa fa-home fa-fw"></span>
                   	<span class="menu">Accueil</span>
                </a>
           </li>
			     <li
           <?php if ($page == '/croqueunmort/pages-last.php') {
              echo 'id="active-menu"';}
            ?>>
               	<a href="/croqueunmort/pages-last" title="Derniers cadavres">
					<span class="fa fa-history fa-fw"></span>
                   	<span class="menu">Derniers cadavres</span>
                </a>
           </li>
           <li
           <?php if ($page == '/croqueunmort/pages-top') {
              echo 'id="active-menu"';}
            ?>>
               	<a href="/croqueunmort/pages-top" title="La crème">
               		<span class="fa fa-star fa-fw"></span>
                   	<span class="menu">La crème</span>
                </a>
           </li>
           <li
           <?php if ($page == 'random-corpse.php') {
              echo 'id="active-menu"';}
            ?>>
                <a href="random-corpse.php" title="Au hasard">
          <span class="fa fa-random fa-fw"></span>
                    <span class="menu">Au hasard</span>
                </a>
           </li>
           <li
           <?php if ($page == '/croqueunmort/corpse-create') {
              echo 'id="active-menu"';}
            ?>>
               	<a href="/croqueunmort/corpse-create" title="Entamer un cadavre">
					<span class="fa fa-comment fa-fw"></span>
                   	<span class="menu">Entamer un cadavre</span>
                </a>
           </li>
           <li
           <?php if ($page == '/croqueunmort/corpse-continueCorpse') {
              echo 'id="active-menu"';}
            ?>>
                <a href="/croqueunmort/corpse-continueCorpse" title="En continuer un">
                	<span class="fa fa-comments-o fa-fw"></span>
                    <span class="menu">En continuer un</span>
                </a>
           </li>
    	</ul>
  	</nav>

	<?php echo $contentLayout ?>

      <!--<h2> every user </h2>
      <?php
        //$users = $this->request('Pages', 'getUsers');
        //foreach($users as $user){
        //  echo('<a href=/croqueunmort/pages/view/'.$user->idUser.'>'.$user->username.'</a><br/>');
        //}
      ?>-->

	<footer>
		<p>© <?php echo date('Y');?> <a href="#">Croque un mort</a>, cuisinez vos cadavres exquis | <a href="#" title="Mentions légales">Mentions légales</a> | <a href="#" title="Contact">Contact</a></p>
	</footer>

</body>
</html>