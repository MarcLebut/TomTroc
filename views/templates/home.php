<?php
/**
 * Template pour afficher la page d'accueil.
 */
?>


<div class="container-fluid">
    <div class="row">
        <section id="bienvenue" class="col-12 justify-content-center">
            <div class="col-7 mt-5 m-auto ">
                <div class="row justify-content-center ">
                    <div id="textBienvenue" class="col-5 align-content-center">
                        <div class=" ">

                            <h1 class="card-title">Rejoignez nos lecteurs pationnés</h1>
                        </br>
                        <p class="card-text">Donnez une nouvelle vie à vos livres en les échangant ave c d'autre
                                                                                        amoureux de la lecture. Nous croyons en la magie du partage de connaissance et
                                                                                        d'histoire à
                                                                                        travers les livres.</p>
                    </br>
                    <a href="#" class="btn btn-success p-3">Découvrir</a>
                </div>
            </div>
            <div class="col-7 ">
                <div class="col-10 justify-content-center">
                    <img src="asset\images\homeImage.png" class="img-fluid " alt="Image d'illustration">
                </div>
            </div>

        </div>
    </div>

</section>
<section id="derniersLivres" class="col-12 ">
    <div class="row justify-content-center">
        <h1 class="text-center m-5">Les derniers livres ajoutés</h1>
        <div class="col-10">
            <div
                class="d-flex justify-content-between">
                <?php foreach ($livres as $livre): ?>
                    <div class="card card-illu d-flex flex-column text-center" style="width:12rem; height:18rem;">
                        <a href="index.php?action=detailbook&id=<?= $livre->getId() ?>">
                            <div class="ratio ratio-1x1 flex-grow-1">                   
                                <?php
                                $cover = $livre->getCoverUrl();
                                ?>
                                <img src="<?= htmlspecialchars($cover, ENT_QUOTES, 'UTF-8') ?>" alt="Couverture :
                                <?= htmlspecialchars($livre->getTitle(), ENT_QUOTES, 'UTF-8') ?>" class="img-fill">
                            </div>
                        </a>

                        <!-- Zone texte : collée en bas -->
                        <div class="card-body mt-auto p-2">
                            <h5 class="card-title mb-1"><?= $livre->getTitle() ?></h5>
                            <p class="card-text mb-0"><?= $livre->getAuthor() ?></p>
                            <p class="card-text mb-0">Vendu par :
                                <?= $livre->getOwner()->getDisplayName() ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center m-2">
                <a href="index.php?action=allbooks" class="btn btn-success p-2 m-3  align-items-center ">Voir tous les livres</a>
            </div>
        </div>
    </div>
</section>
<section id="commentCaMarche" class="col-12 d-flex">
    <div class="row justify-conten d-flex">
        <h1 class="text-center mb-3">Comment ça marche</h1>
        <p class="text-center">Echanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour
                                            commencer :</p>
        <div class="col-12 d-flex justify-content-center mt-3">
            <div class="d-flex col-10 justify-content-between">

                <div class="card card-illu d-flex flex-column text-center " style="width:16rem; height:12rem;">
                    <div class="card-body mt-auto p-2 d-flex justify-content-center ">
                        <p class="card-text mb-0  align-middle">Inscrivez-vous gratuitement sur 
                                                    notre plateforme.</p>
                    </div>
                </div>

                <div class="card card-illu d-flex flex-column text-center" style="width:16rem; height:12rem;">
                    <div class="card-body mt-auto p-2">
                        <p class="card-text mb-0">Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
                    </div>
                </div>

                <div class="card card-illu d-flex flex-column text-center" style="width:16rem; height:12rem;">
                    <div class="card-body mt-auto p-2">
                        <p class="card-text mb-0">Parcourez les livres disponibles chez d'autres membres.</p>
                    </div>
                </div>

                <div class="card card-illu d-flex flex-column text-center" style="width:16rem; height:12rem;">
                    <div class="card-body mt-auto p-2">
                        <p class="card-text mb-0">Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="text-center m-2 mt-3">
            <a href="index.php?action=allbooks" class="btn btn-success p-2 m-3  align-items-center ">Voir tous les livres</a>
        </div>
    </div>
</section>
<section id="backgroundSection"></section>
<section id="nosValeurs" class="d-flex justify-content-center">
    <div class="col-3  position-relative">
        <h1 class="pt-4 pb-4">Nos valeurs</h1>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont
                                            ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs.
                                            Nous
                                            croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations
                                            enrichissantes.
                        
                                            Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et
                                            partagé.
                        
                                            Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se
                                            connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent
                                            patiemment
                                            sur les étagères.
        </p>
        <span>Signature</span>
        <div class=" ">
            <img src="asset/images/coeur.png" alt="" class="mt-4 img-fluid position-absolute top-70 start-100 translate-middle ">
        </div>
    </div>


</section></div></div></div>

