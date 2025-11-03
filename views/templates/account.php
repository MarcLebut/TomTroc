<div class="container-fluid justify-content-center d-flex h-100" style="background-color:#FAF9F7">    
    
    <div class="row col-10 mt-4 d-flex justify-content-evenly">
        <section class="col-2 p-4 mb-4 justify-content-center flex-wrap p-5  rounded-1 " style="background-color:#FFFFFF">
           
            <div class="col-12 align-items-center d-flex flex-column">
                <img src="<?= $user->getAvatarUrl(); ?>" alt="" srcset="" class="" style="width:180px;heigth:180px;">
            </div>
          
            <div class="col-12 align-items-center  d-flex flex-column">
               <h2 class="mt-5"><?= $user->getDisplayName(); ?></h2> 
                <span>Membre depuis 
                    <?= htmlspecialchars($inscritDepuis, ENT_QUOTES, 'UTF-8'); ?>
                </span>
                <span>Bibliotèque</span>
                <span><?= $nbLivres; ?> livres</span>
            </div>
        </section>
        <section style="background-color:#FFFFFF"class="p-3 col-9 mb-3">
            <table class="table adminArticle">
                <thead>
                    <tr class="texte-align-center">
                        <th class="text-center" scope="col">PHOTO</th>
                        <th class="text-center" scope="col">TITRE</th>
                        <th class="text-center" scope="col">AUTEUR</th>
                        <th class="text-center" scope="col">DESCRIPTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livres as $livre):
                        ?>
                        <tr class="articleLine">
                            <a href="index.php?action=detailbook&id=<?= $livre->getId() ?>"> 
                            <td style="width:100px;"><img src="<?= $livre->getCoverUrl(); ?>" alt="" srcset="" class="align-middle" style="width:100px;heigth:100px;"></td>
                            </a>
                            <td class="text-center align-middle"><?= $livre->getTitle(); ?></td>
                            <td class="text-center align-middle" style="heigth:350px;"><?= $livre->getAuthor(); ?></td>
                            <td class="text-center align-middle"><span>description</span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
