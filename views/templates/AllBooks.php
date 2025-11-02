<div class="container">
  <div class="row">
    <div class="row d-flex justify-content-evenly mt-5 mb-5">
      <div class="col-7">
        <h1 class="me-auto">Nos livres à l'échange</h1>
      </div>
      <div class="col-5 align-content-end">
        <input class="mt-3 d-flex ms-auto p-2 form-control" type="text" id="recherche" placeholder="Rechercher un livre...">
      </div>
    </div>

    <div
      class="d-flex justify-content-between flex-wrap">


      <?php
      if (empty($livres)):
        ?>
        <p class="text-muted">Aucun livre disponible pour le moment.</p>
      <?php
      else:
        ?>
        <?php
        foreach ($livres as $livre):
          ?>
          
          <div class="card card-illu d-flex flex-column text-center mb-3" style="width:12rem; height:18rem;">
            <!-- Image -->
            <a href="index.php?action=detailbook&id=<?= $livre->getId() ?>">
              <div
                class="ratio ratio-1x1 flex-grow-1">

                <?php
                $cover = $livre->getCoverUrl();
                ?>
                <img src="<?= htmlspecialchars($cover, ENT_QUOTES, 'UTF-8') ?>" alt="Couverture :
                              <?= htmlspecialchars($livre->getTitle(), ENT_QUOTES, 'UTF-8') ?>" class="img-fill">
              </div>
            </a>

            <!-- Texte -->
            <div class="card-body mt-auto p-2" style="width:12rem; height:8rem;">
              <h5 class="card-title mb-1"><?= htmlspecialchars($livre->getTitle(), ENT_QUOTES, 'UTF-8') ?></h5>
              <p class="card-text mb-0"><?= htmlspecialchars($livre->getAuthor() ?? 'Auteur inconnu', ENT_QUOTES, 'UTF-8') ?></p>

              <p class="mb-0">Propriétaire :
                <?= htmlspecialchars($livre->getOwner()?->getDisplayName() ?? 'Inconnu', ENT_QUOTES, 'UTF-8') ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>  
  </div>  
</div>

