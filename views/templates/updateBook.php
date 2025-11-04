<?php
/** 
 * Template du formulaire d'update/creation d'un livre. 
 */
?>
<div class="container-fluid">
    <div class="row">
        <section id="imgDetail" class="col-5 ">
            <div class="ratio ratio-1x1 ">
                <img src="<?= htmlspecialchars($livre->getCoverUrl(), ENT_QUOTES, 'UTF-8') ?>" alt="Couverture :
                <?= htmlspecialchars($livre->getTitle(), ENT_QUOTES, 'UTF-8') ?>" class="img-fill">
            </div>    
            <a href="index.php?action=#&id=#">Modifier la photo</a>
        </section>
        <section class="col-7" style="background-color:#FAF9F7">
  <form action="index.php?action=updateBookBtn&id=<?= (int)$livre->getId(); ?>" method="POST">
    <div class="d-flex flex-column flex-wrap justify-content-center align-content-center col-8">

      <input type="hidden" name="id" value="<?= (int)$livre->getId(); ?>">

      <div class="mt-5 col-10 mb-2">
        <label class="form-label" for="title">Titre</label>
        <input class="form-control" type="text" name="title" id="title"
               value="<?= htmlspecialchars($livre->getTitle() ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
      </div>

      <div class="mt-5 col-10 mb-2">
        <label class="form-label" for="author">Auteur</label>
        <input class="form-control" type="text" name="author" id="author"
               value="<?= htmlspecialchars($livre->getAuthor() ?? '', ENT_QUOTES, 'UTF-8') ?>">
      </div>

      <div class="mt-5 col-10 mb-2">
        <label class="form-label" for="description">Commentaire</label>
        <textarea rows="8" class="form-control" name="description" id="description"
                  placeholder="Entrez la description du livre..."><?= htmlspecialchars($livre->getDescription() ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
      </div>

      <div class="mt-5 col-10 mb-2">
        <label class="form-label" for="status">Disponibilité</label>
        <select id="status" name="status" class="form-select" required>
          <option value="available"   <?= $livre->getStatus() === 'available'   ? 'selected' : '' ?>>Disponible</option>
          <option value="reserved"    <?= $livre->getStatus() === 'reserved'    ? 'selected' : '' ?>>Réservé</option>
          <option value="unavailable" <?= $livre->getStatus() === 'unavailable' ? 'selected' : '' ?>>Indisponible</option>
          <option value="lent"        <?= $livre->getStatus() === 'lent'        ? 'selected' : '' ?>>Prêté</option>
        </select>
      </div>

      <div class="col-10 d-flex mt-4 justify-content-center">
        <button type="submit" class="btn btn-success p-4 col-12 rounded-2">Modifier</button>
      </div>
    </div>
  </form>
</section>

    </div>
</div>

