<?php

if(isset($this->vars['error'])){
	echo "<div class='error'>";
	echo $this->vars['error'];
	echo "</div>";
	?>

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
	<?php
}

else{
	echo "<div class='success'>";
	echo "OK !!";
	echo "</div>";
}

?>