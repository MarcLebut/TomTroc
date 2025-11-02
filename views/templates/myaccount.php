<div class="container-fluid justify-content-center d-flex" style="background-color:#FAF9F7">
    <div class="row col-10 mt-4 d-flex justify-content-evenly">
        <section class="col-5 mb-4 justify-content-center flex-wrap p-5  rounded-1 " style="background-color:#FFFFFF">
            <div class="col-12 align-items-center d-flex flex-column">
                <img src="<?= $user->getAvatarUrl(); ?>" alt="" srcset="" class="" style="width:180px;heigth:180px;">

                <a href="#" class="">modifier</a>
            </div>
            <div class="col-12 align-items-center  d-flex flex-column">

               <h2 class="mt-5"><?= $user->getDisplayName(); ?></h2> 
                
                <span>Membre depuis 
                    <?= htmlspecialchars($inscritDepuis, ENT_QUOTES, 'UTF-8'); ?>
                </span>
                
                <span>Biblioteque</span>
                <span>
                    <?= $nbLivres; ?>
                    livres</span>


            </div>

        </section>
        <section class="col-5 mb-4 p-5  rounded-1 " style="background-color:#FFFFFF">
            <form>
                <fieldset enable>
                    <legend>Vos information personelles</legend>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" id="email" class="form-control" placeholder="<?=$user->getEmail()?>">
                    </div>
                    <div class="mb-3  ">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="texte" id="password" class="form-control" placeholder="•••••••••••••">
                        
                    </div>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">pseudo</label>
                        <input type="text" id="pseudo" class="form-control" placeholder="<?=$user->getDisplayName()?>">
                    </div>

                    <button type="submit" class="btn btn-success p-3">Enregistrer</button>
                </fieldset>
            </form>
        </section>
        <section style="background-color:#FFFFFF"class="p-3 col-11 mb-3">
            <table class="table">
                <thead>
                    <tr class="texte-align-center">
                        <th class="text-center" scope="col">PHOTO</th>
                        <th class="text-center" scope="col">TITRE</th>
                        <th class="text-center" scope="col">AUTEUR</th>
                        <th class="text-center" scope="col">DESCRIPTION</th>
                        <th class="text-center" scope="col">DISPONIBILITE</th>
                        <th class="text-center" scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livres as $livre):
                        ?>
                        <tr>
                            <td style="width:100px;"><img src="<?= $livre->getCoverUrl(); ?>" alt="" srcset="" class="align-middle" style="width:100px;heigth:100px;"></td>
                            <td class="text-center align-middle"><?= $livre->getTitle(); ?></td>
                            <td class="text-center align-middle" style="heigth:350px;"><?= $livre->getAuthor(); ?></td>
                            <td class="text-center align-middle">
                                <span>description</span>
                            </td>
                            <td
                                class="text-center align-middle">
                                <?php $isAvailable = $livre->getStatus() === 'available'; ?>
                                <span
                                    class="badge <?= $isAvailable ? 'bg-success' : 'bg-danger'; ?>"><?= $livre->getStatus() ?>
                                </span>
                            </td>
                            <td class="text-center align-middle">
                                <a href="" class="me-3">
                                    <span>éditer</span>
                                </a>
                                <a href="">
                                    <span style="color:red;">Supprimer</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </section>

    </div>
</div>

