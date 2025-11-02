<div class="container-fluid">
    <div class="row">

        <section id="imgDetail" class="col-6 ">
            <div
                class="ratio ratio-1x1 ">
                <?php
                $cover = $livre->getCoverUrl();
                ?>
                <img src="<?= htmlspecialchars($cover, ENT_QUOTES, 'UTF-8') ?>" alt="Couverture :
                                                        <?= htmlspecialchars($livre->getTitle(), ENT_QUOTES, 'UTF-8') ?>" class="img-fill">
            </div>
        </section>
        <section class="col-6" style="background-color:#FAF9F7">
            <div class="container">
                <div id="textBienvenue" class="align-content-center ">
                    <div class="mt-5 ">
                        <h1 class="card-title"><?= htmlspecialchars($livre->getTitle(), ENT_QUOTES, 'UTF-8') ?></h1>
                        <p class="card-text mb-0">Par :
                            <?= htmlspecialchars($livre->getAuthor() ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </br>
                    <p class="card-text mb-0 col-8">Description :</br>
                        <?= htmlspecialchars($livre->getDescription() ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </p>

                </div>
            </br>
            <div class="col-12 justify-content-center   ">
                <div class="row flex-wrap d-flex ">
                    
                    <span>Proprietaire</span>
                    <div class="col-12 d-flex">
                        <div
                            id="detailUserVU" class="col-3 rounded rounded- " style="background-color:#FFFFFF">
                            <?php $Avatar = $livre->getOwner()->getAvatarUrl(); ?>
                            <img src="<?= htmlspecialchars($Avatar, ENT_QUOTES, 'UTF-8') ?>" alt="" class="img-fill">
                            <span
                                class="card-text mb-0"><?= htmlspecialchars($livre->getOwner()->getDisplayName() ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </div>
                    </div>
                    </br>
                    <div class="col-12 d-flex mt-4 align-content-end justify-content-center">
                        <a href="#" class="btn btn-success p-4 col-8 rounded-2 rounded">Envoyer un message</a>
                        
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>

