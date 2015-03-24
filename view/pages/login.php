<h1>Login</h1>
	
	<form action="login" method="POST">
	<?php
		$this->setForm("login");
		$form = $this->vars['form'];
		foreach($form as $param){
			if($param['name']!="") echo $param['name']."<br/>";
			echo "<input type='".$param['type']."' name='".$param['name']."'";
			if(isset($param['value'])) echo "value='".$param['value']."'";
			echo "/><br/>";
		}

	?>
	</form>


<h1>Inscription</h1>
	<form action="login" method="POST">

	<?php

	$this->setForm("register");
	$form = $this->vars['form'];
	foreach($form as $param){
			if($param['name']!="") echo $param['name']."<br/>";
			echo "<input type='".$param['type']."' name='".$param['name']."'";
			if(isset($param['value'])) echo "value='".$param['value']."'";
			echo "/><br/>";
	}


	?>


	</form>
		