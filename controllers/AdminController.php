<?php
class AdminController
{
/**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    private function checkIfUserIsConnected(): void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function displayConnectionForm(): void
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Affichage du formulaire d'inscription'.
     * @return void
     */
    public function displayLoginForm(): void
    {
        $view = new View("Inscription");
        $view->render("loginForm");
    }


    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connectUser(): void
    {
        // On récupère les données du formulaire.
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPasswordHash())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page d'administration.
        Utils::redirect("home");
    }
    
    public function showAccount(): void
    {
        if (empty($_SESSION['idUser'])) {
            Utils::redirect('home');
            exit;
        }
        $ownerId = Utils::request('id');
        $userId  = ($ownerId !== null && $ownerId !== '') ? (int) $ownerId : (int) ($_SESSION['idUser'] ?? 0);

        
      
        $userManager  = new UserManager();
        $booksManager = new LivreManager();

        $user      = $userManager->getUserById($userId);
        $livres    = $booksManager->getBooksByOwnerId($userId);
        $countBook = $booksManager->countBooksByOwner($userId);
        
        $inscritDepuis = Utils::formatSince($user->getCreatedAt());
        $createdAtFr   = Utils::convertDateToFrenchFormat($user->getCreatedAt());

        if ((!isset($_GET['id']) && empty($_GET['id']))) {
            $view = new View('Mon compte');
            $view->render('myaccount', [
                'user'          => $user,
                'inscritDepuis' => $inscritDepuis,
                'createdAtFr'   => $createdAtFr,
                'livres'        => $livres,
                'nbLivres'      => $countBook,
            ]);
        }else{
            $view = new View('compte user');
            $view->render('account', [
                'user'          => $user,
                'inscritDepuis' => $inscritDepuis,
                'createdAtFr'   => $createdAtFr,
                'livres'        => $livres,
                'nbLivres'      => $countBook,
            ]);
        }
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser(): void
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }

    /**
     * Modifie le profil.
     * @param User $UserId : le compte à modifier .
     * @return void
     *//*
    public function updateProfil(User $userId): void
    {
        checkIfUserIsConnected()

        $UserId 
        $sql = "UPDATE users SET email = :email, password_hash = :password_hash, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'email' => $user->getEmail(),
            'password_hash' => $user->getPasswordHash(),
            'id' => $user->getUserById()
        ]);
    }*/

 /*
 * Met à jour le profil d'un utilisateur.
 * Si $newPlainPassword est null/vidé, le mot de passe n'est pas modifié.
 */


}