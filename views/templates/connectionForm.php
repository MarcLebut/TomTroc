<?php
/**
 * Template pour afficher le formulaire de connexion.
 */
?>


<div class="container-fluid">
    <div class="row ">
        <section class="col-6">
            <h2 class="text-center mt-5">Connexion</h2>
            <div class="col-7 justify-content-center m-auto ">

                <form action="index.php?action=connectUser" method="post" class="foldedCorner">
                    <div class="mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="Password" required>
                    </div>
                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success col-12">Se connecter</button>
                    </div>
                </form>

                <p>Pas de compte ? <span> <a href="index.php?action=loginForm">inscrivez-vous</a>  </span></p>

            </div>
        </section>
        <section class="col-6">
            <img src="asset\images\livre_illustration.jpg" class="img-fluid rounded mx-auto d-block col" alt="Image d'illustration">
        </section>
        
    </div>
    
</div>