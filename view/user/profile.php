  <section>
    <h2 class="title1"><i class="fa fa-child"></i> <?php echo($user->username); ?></h2>
    <article>
      
      <div class="profile">
        <div class="avatar">
          <img src="<?php echo ($profile['avatar']); ?>" alt="Avatar de <?php echo($user->username); ?>" />
        </div>
        <div>
          <i class="fa fa-child fa-5x"></i>
          <h3 class="title2"><?php echo($user->username); ?></h3>
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

  <section>
    <h2 class="title1"><i class="fa fa-heart"></i> Son cadavre préféré de chez préféré</h2>
    <article>
      <h3 class="title2">
        Cadavre #<?php echo($profile['nbFinished']['idCorpse']); ?> - <?php echo($profile['nbFinished']['story']); ?>
      </h3>
      

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