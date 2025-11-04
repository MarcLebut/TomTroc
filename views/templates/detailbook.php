<div class="container-fluid">
    <div class="row">

        <section id="imgDetail" class="col-5 ">
            <div
                class="ratio ratio-1x1 ">
                <?php
                $cover = $livre->getCoverUrl();
                ?>
                <img src="<?= htmlspecialchars($cover, ENT_QUOTES, 'UTF-8') ?>" alt="Couverture :
                                                        <?= htmlspecialchars($livre->getTitle(), ENT_QUOTES, 'UTF-8') ?>" class="img-fill">
            </div>
        </section>
        <section class="col-7 " style="background-color:#FAF9F7">
            <div class=" d-flex flex-colunm flex-wrap justify-content-center align-content-center col-8">
                
                <div class="mt-5 col-10 mb-2">
                    <h1 class="card-title"><?= htmlspecialchars($livre->getTitle(), ENT_QUOTES, 'UTF-8') ?></h1>
                    <p class="card-text mb-0"><span>Par </span>
                        <?= htmlspecialchars($livre->getAuthor() ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
                <p class="card-text mb-3 col-10">Description :
                    <br>
                    <?= htmlspecialchars($livre->getDescription() ?? '', ENT_QUOTES, 'UTF-8') ?>
                </p>
                
                <p class="col-10"><span>Proprietaire</span></p>
                <div class="col-10 d-flex">
                    <div id="detailUserVU" class="col-3  px-3" style="background-color:#FFFFFF">
                        <?php $Avatar = $livre->getOwner()->getAvatarUrl(); ?>
                        <img src="<?= htmlspecialchars($Avatar, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($livre->getTitle(), ENT_QUOTES, 'UTF-8') ?>" class="img-fill" style="width:60px;">
                        <span
                            class="card-text mb-0"><?= htmlspecialchars($livre->getOwner()->getDisplayName() ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </div>
                </div>
            
                <div class="col-10 d-flex mt-4 align-content-end justify-content-center">
                    <a href="#" class="btn btn-success p-4 col-12 rounded-2 rounded">Envoyer un message</a>
                    
                </div>
                
            </div>
        </section>
    </div>
</div>

