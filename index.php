<?php

require_once 'config/_config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'home':
            $articleController = new LivreController();
            $articleController->showHome();
            break;

        // Vue :  "tous les livres"
        case 'allbooks':
            $articleController = new LivreController();
            $articleController->showBooks();
            break;

        // Vue :  "un livres en detail"
        case 'detailbook': 
            $livreController = new LivreController();
            $livreController->showBook();
            break;

        case 'addUser':
            $articleController = new UserController();
            $articleController->addUser();
            break;
            
        // page d'inscription
        case 'loginForm':
            $adminController = new AdminController ();
            $adminController->displayLoginForm();
            break;


        // Section admin & connexion. 
        case 'admin': 
            $adminController = new AdminController();
            $adminController->index();
            break;

        case 'connectionForm':
            $adminController = new AdminController();
            $adminController->displayConnectionForm();
            break;

        case 'connectUser': 
            $adminController = new AdminController();
            $adminController->connectUser();
            break;

        case 'disconnectUser':
            $adminController = new AdminController();
            $adminController->disconnectUser();
            break;

        case 'showUpdateArticleForm':
            $adminController = new AdminController();
            $adminController->showUpdateArticleForm();
            break;

        case 'updateBook': 
            $adminController = new AdminController();
            $adminController->updateBook();
            break;

        case 'deleteArticle':
            $adminController = new AdminController();
            $adminController->deleteArticle();
            break;
        case 'deleteComment':
            $adminController = new AdminController();
            $adminController->deleteComment();
            break;
        case 'dashboard':
            $adminController = new AdminController();
            $adminController->index();
            break;
        
        case 'myaccount':
            $adminController = new AdminController();
            $adminController->showAccount();
            break;

        case 'account':
            $adminController = new AdminController();
            $adminController->showAccount();
            break;


        case 'updateProfil':
            $adminController = new AdminController();
            $adminController->updateProfil();
            break;
        default:
        throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
