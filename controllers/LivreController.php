
<?php
class LivreController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        $livresManager = new LivreManager();
        $livres = $livresManager->getAllBooksWithOwner(4);

        $view = new View("Accueil");
        $view->render("home", [
            'livres' => $livres,
        ]);
    }


    public function showBooks(): void
{
    $livreManager = new LivreManager();

    $livres = $livreManager->getAllBooksWithOwner();
    
    $view= new View("Livres");
    $view->render("allBooks", [
        'livres' => $livres,
    ]);
}

public function showBook(): void
{
    $Id = Utils::request('id');

    $livreManager = new LivreManager();
    $livre = $livreManager->getByIdWithOwner($Id); // <- méthode proposée

    // Rends un template de détail (recommandé)
    $view = new View("Livre") ;
    $view -> render("detailbook", [
        'livre' => $livre,
    ]);
}

public function updateBookbtn():void{
    $id          = (int) (Utils::request('id') ?? 0);
    $title       = trim((string) (Utils::request('title') ?? ''));
    $description = trim((string) (Utils::request('description') ?? ''));
    $status      = trim((string) (Utils::request('status') ?? ''));
    
    $livreManager = new LivreManager();
    $livre = $livreManager->getBookById($id);

    // Mets à jour l'objet puis enregistre
    $livre->setTitle($title);
    $livre->setDescription($description);
    $livre->setStatus($status);


    $livreManager->updateLivre($livre);

    // Redirige vers la page détail (ou autre)
    Utils::redirect('updateBook', ['id' => $id]);

}
}
