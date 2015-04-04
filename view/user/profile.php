  <section>
    <h2 class="title1"><i class="fa fa-child"></i> <?php echo($profile['username']); ?></h2>
    <article>
      
      <div class="profile">
        <div class="avatar">
          <img src="<?php echo ($profile['avatar']); ?>" alt="Avatar de <?php echo($user->username); ?>" />
        </div>
        <div>
          <i class="fa fa-child fa-5x"></i>
          <h3 class="title2"><?php echo($profile['username']); ?></h3>
          <p>Inscrit depuis le <?php echo($profile['since']); ?></p>
        </div>
      </div>

      <div class="rows">        
        <div class="row-3">
          <i class="fa fa-check-circle fa-5x"></i>
          <h3 class="title2">
            <?php
              echo($profile['nbFinished']);
              if ($profile['nbFinished'] <= 1) echo " cadavre fini";
              else echo " cadavres achevés";
            ?>
          </h3>
        </div>

        <div class="row-3">
          <i class="fa fa-spinner fa-5x"></i>
          <h3 class="title2">
            <?php
              echo($profile['nbOnGoing']);
              if ($profile['nbOnGoing'] <= 1) echo " cadavre en cours";
              else echo " cadavres en cours";
            ?>
          </h3>
        </div>

        <div class="row-3">
          <i class="fa fa-star fa-5x"></i>
          <h3 class="title2">
            <?php
              echo($profile['nbFavorite']);
              if ($profile['nbFavorite'] <= 1) echo " cadavre favori";
              else echo " cadavres favoris";
            ?>
          </h3>
        </div>
      </div>

    </article>
  </section>

  <?php if($profile['favoriteCorpse'] != 0){ ?>
  <section>
    <h2 class="title1"><i class="fa fa-heart"></i> Son cadavre préféré de chez préféré</h2>
    <article>
      <h3 class="title2">
        Cadavre #<?php echo($favoriteCorpse['idCorpse']); ?> - <?php echo($favoriteCorpse['story']); ?>
      </h3>
      
      <img src="<?php echo($favoriteCorpse['panel1']); ?>" alt="Case 1" /> 
      <img src="<?php echo($favoriteCorpse['panel2']); ?>" alt="Case 2" /> 
      <img src="<?php echo($favoriteCorpse['panel3']); ?>" alt="Case 3" /> 

    </article>
  </section>
  <?php } ?>