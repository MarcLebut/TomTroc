<?php
class UserController
{
 public function addUser(): void
{
    // 1) Exiger POST (optionnel mais recommandé)
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?action=loginForm');
        exit;
    }

    // 2) Lire les champs
    $email        = trim((string) Utils::request('email'));
    $passwordRaw  = (string) Utils::request('password'); // <-- le champ du formulaire
    $displayName  = trim((string) Utils::request('display_name'));
    $bio          = trim((string) Utils::request('bio'));
    $avatarUrl    = trim((string) Utils::request('avatar_url'));
    $city         = trim((string) Utils::request('city'));

    // 3) Hash du mot de passe
    $passwordHash = password_hash($passwordRaw, PASSWORD_DEFAULT);

    // 4) Construire un TABLEAU ASSOCIATIF pour create()
    $postData = [
        'email'         => $email,
        'password_hash' => $passwordHash,
        'display_name'  => $displayName,
        'bio'           => $bio ?: null,
        'avatar_url'    => $avatarUrl ?: null,
        'city'          => $city ?: null,
    ];

    // 5) Appel manager
    $userManager = new UserManager();
    $user = $userManager->create($postData); // <-- retourne un objet User

    // 6) Affichage (ou PRG : redirection vers la page de login)
    $view = new View("Inscription");
    $view->render("loginForm", [
        'user'   => $user,
        'notice' => "Compte créé. Vous pouvez vous connecter.",
    ]);

    Utils::redirect('connectionForm');
}



}