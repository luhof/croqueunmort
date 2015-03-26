<h1>Login</h1>
	
	<form action="user-login" method="POST">
	<?php
		$this->setForm(2);
		$form = $this->vars['form'];
		foreach($form as $param){
			if($param['name']!=""&&$param['type']!="hidden") echo $param['name']."<br/>";
			echo "<input type='".$param['type']."' name='".$param['name']."'";
			if(isset($param['value'])) echo "value='".$param['value']."'";
			echo "/><br/>";
		}

	?>
	</form>


<h1>Inscription</h1>
	<form action="user-register" method="POST">

	<?php

	$this->setForm(1);
	$form = $this->vars['form'];
	foreach($form as $param){
			if($param['name']!=""&&$param['type']!="hidden") echo $param['name']."<br/>";
			echo "<input type='".$param['type']."' name='".$param['name']."'";
			if(isset($param['value'])) echo "value='".$param['value']."'";
			echo "/><br/>";
	}


	?>


	</form>
		