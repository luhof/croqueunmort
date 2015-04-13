  <section>
    <h2 class="title1"><i class="fa fa-edit"></i> Editer mon profil</h2>
    <article>

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

      <div class="rows">

        <div class="row-2 center">
          <img class="avtr" src="<?php echo ($profile['avatar']); ?>" alt="Avatar de <?php echo($_SESSION['username']); ?>" /><br />
          <i class="fa fa-child fa-5x"></i>
          <h3 class="title2"><?php echo($_SESSION['username']); ?></h3>
          <p>E-mail actuel : <?php echo($profile['email']); ?></p>
        </div>

        <div class="row-2">
      	
        	<form action="user-edit" method="POST" enctype="multipart/form-data">
			<?php
				$this->setForm("edit");
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
