  <section>
    <h2 class="title1"><i class="fa fa-sign-in"></i> S'inscrire/Se connecter</h2>
    <article>

      <div class="rows">
      	<?php
      		if(isset($this->vars['error'])){
  		?>
  		<p class="error"> <?php echo $this->vars['error']; ?></p>
  		<?php
      		}
      	?>

		<?php
      		if(isset($this->vars['success'])){
  		?>
  		<p class="success"> <?php echo $this->vars['success']; ?></p>
  		<?php
      		}
      	?>

        <div class="row-2">
          	<h3 class="title2">Connexion</h3>
          	<form action="user-signin" method="POST">
			<?php
				$this->setForm("login");
				$form = $this->vars['form'];
				foreach($form as $param)
				{
					if ($param['name'] != "" && $param['type'] != "hidden")
						echo $param['label']."<br/>";
					echo "<input type='".$param['type']."' name='".$param['name']."'";
					
					if (isset($param['value']))
						echo "value='".$param['value']."'";
					echo "/><br/>";
				}
			?>
			</form>

        </div>

        <div class="row-2">
        	<h3 class="title2">Inscription</h3>
        	
        	<form action="user-register" method="POST">
			<?php
				$this->setForm("register");
				$form = $this->vars['form'];
				foreach($form as $param)
				{
					if ($param['name'] != "" && $param['type'] != "hidden")
						echo $param['label']."<br/>";
					echo "<input type='".$param['type']."' name='".$param['name']."'";
					
					if (isset($param['value']))
						echo "value='".$param['value']."'";
					echo "/><br/>";
				}
			?>
			</form>
			
        </div>
      </div>

    </article>
  </section>		
