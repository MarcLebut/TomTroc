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

    $userId = (int) $_SESSION['idUser'];

    $userManager  = new UserManager();
    $booksManager = new LivreManager();

    $user      = $userManager->getUserById($userId);
    $livres    = $booksManager->getBooksByOwnerId($userId);
    $countBook = $booksManager->countBooksByOwner($userId);

    // ✅ prépare des chaînes prêtes à afficher (pas d’objets)
    $inscritDepuis = Utils::formatSince($user->getCreatedAt());
    $createdAtFr   = Utils::convertDateToFrenchFormat($user->getCreatedAt());

    $view = new View('Mon compte');
    $view->render('myaccount', [
        'user'          => $user,
        'inscritDepuis' => $inscritDepuis,
        'createdAtFr'   => $createdAtFr,
        'livres'        => $livres,
        'nbLivres'      => $countBook,
    ]);
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
}