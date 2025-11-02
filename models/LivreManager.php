<?php

/**
 * Classe qui gère les livres.
 */
class LivreManager extends AbstractEntityManager
{
    /**
     * Incrémente le compteur de vues d’un livre.
     * @param int $livreId
     * @return void
     */
    public function incrementViews(int $livreId): void
    {
        $sql = "UPDATE livre SET views = views + 1 WHERE id = :id";
        $this->db->query($sql, ['id' => $livreId]);
    }

    /**
     * Récupère tous les livres.
     * @return array<livre> : un tableau d'objets livre.
     */
    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM books";
        $result = $this->db->query($sql);

        $livres = [];
        while ($row = $result->fetch()) {
            // Hydratation de base (titre, contenu, date, etc.)
            $livre = new Livre($row);
            $livres[] = $livre;
        }

        return $livres;
    }

    /**
     * Récupère un livre par son id.
     * @param int $id : l'id de l'livre.
     * @return livre|null : un objet livre ou null si l'livre n'existe pas.
     */
    public function getBookById(int $id): ?Livre
    {
        $sql = "SELECT * FROM books WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $livre = $result->fetch();
        if ($livre) {
            return new Livre($livre);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un livre.
     * On sait si l'livre est un nouvel livre car son id sera -1.
     * @param Livre $livre : l'livre à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdatelivre(Livre $livre): void
    {
        if ($livre->getId() == -1) {
            $this->addlivre($livre);
        } else {
            $this->updatelivre($livre);
        }
    }

    /**
     * Ajoute un livre.
     * @param livre $livre : l'livre à ajouter.
     * @return void
     */
    public function addlivre(Livre $livre): void
    {
        $sql = "INSERT INTO books (idOwner, title, author, cover_url, description, status, created_at) VALUES (:idOwner, :title, :author, :cover_url, :description, :status, created_at = NOW())";
        $this->db->query($sql, [
            'idOwner' => $livre->getIdOwner(),
            'title' => $livre->getTitle(),
            'author' => $livre->getAuthor(),
            'cover_url' => $livre->getCoverUrl(),
            'description' => $livre->getDescription(),
            'status' => $livre->getStatus(),
            'created_at' => $livre->getCreatedAt()
        ]);
    }

    /**
     * Modifie un livre.
     * @param livre $livre : l'livre à modifier.
     * @return void
     */
    public function updatelivre(Livre $livre): void
    {
        $sql = "UPDATE books SET title = :title, description = :description, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $livre->getTitle(),
            'description' => $livre->getDescription(),
            'id' => $livre->getId()
        ]);
    }

    /**
     * Supprime un livre.
     * @param int $id : l'id de l'livre à supprimer.
     * @return void
     */
    public function deletelivre(int $id): void
    {
        $sql = "DELETE FROM ooks WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     * Retourne tous les livres avec (éventuellement) leur propriétaire.
     * - Jointure LEFT pour ne pas casser si owner_id = NULL
     * - Hydrate un User uniquement si présent
     * - Utilise FETCH_ASSOC pour éviter les doublons numériques
     */
    public function getAllBooksWithOwner($number = null): array
        {
            $sql = "
            SELECT 
                b.id         AS book_id,
                b.title      AS book_title,
                b.author     AS book_author,
                b.cover_url  AS book_cover_url,
                b.status     AS book_status,
                b.owner_id   AS owner_id,
                b.created_at AS book_created_at,

                u.id           AS user_id,
                u.display_name AS user_display_name,
                u.email        AS user_email
            FROM books AS b
            LEFT JOIN users AS u ON u.id = b.owner_id
            ORDER BY b.created_at ASC
        ";
        if ($number !== null) {
            $sql .= " LIMIT " . $number;
        }
        $result = $this->db->query($sql);
        if (!$result) {
            return []; 
        }

        $livres = [];

        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            // 1) Hydrater le livre
            $livre = new Livre([
                'id' => (int) $row['book_id'],
                'title' => $row['book_title'],
                'author' => $row['book_author'],
                'coverUrl' => $row['book_cover_url'] ?? null,   // <-- FIX
                'status' => $row['book_status'],
                'owner_id' => isset($row['owner_id']) ? (int) $row['owner_id'] : null,
                'created_at' => $row['book_created_at'],
            ]);
            // 2) Hydrater l'owner uniquement s'il existe (LEFT JOIN => peut être NULL)
            $owner = null;
            if (!empty($row['user_id'])) {
                $owner = new User([
                    'id' => (int) $row['user_id'],
                    'display_name' => $row['user_display_name'],
                    'email' => $row['user_email'],
                ]);
            }
            // 3) Lier les deux si l'API de Livre le permet
            if (method_exists($livre, 'setOwner')) {
                // Attends un ?User dans la signature: setOwner(?User $owner)
                $livre->setOwner($owner);
            }
            $livres[] = $livre;
        }
        return $livres;
    }

    /**
     * Retourne un livre (ou null) avec son propriétaire éventuel.
     * - LEFT JOIN pour supporter owner_id = NULL (FK ON DELETE SET NULL)
     * - Alias SQL clairs (book_* / user_*) pour éviter les collisions
     * - Hydratation en camelCase (Livre/User)
     */
    public function getByIdWithOwner(int $bookId): ?Livre
    {
        $sql = "
        SELECT 
            b.id         AS book_id,
            b.title      AS book_title,
            b.author     AS book_author,
            b.cover_url  AS book_cover_url,
            b.status     AS book_status,
            b.owner_id   AS owner_id,
            b.created_at AS book_created_at,
            b.description AS book_description,

            u.id           AS user_id,
            u.display_name AS user_display_name,
            u.email        AS user_email,
            u.city         AS user_city,
            u.avatar_url   AS user_avatar_url,
            u.bio          AS user_bio
        FROM books AS b
        LEFT JOIN users AS u ON u.id = b.owner_id
        WHERE b.id = :id
        LIMIT 1
    ";

        $result = $this->db->query($sql, ['id' => $bookId]);
        if (!$result) {
            return null; // échec requête : on renvoie null
        }

        $row = $result->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            return null; // pas de livre pour cet id
        }

        // 1) Livre
        $livre = new Livre([
            'id' => (int) $row['book_id'],
            'title' => $row['book_title'],
            'author' => $row['book_author'],
            'coverUrl' => $row['book_cover_url'] ?? null,
            'status' => $row['book_status'],
            'ownerId' => $row['owner_id'] !== null ? (int) $row['owner_id'] : null,
            'createdAt' => $row['book_created_at'] ?? null,
            'description' => $row['book_description'] ?? null,
        ]);

        // 2) Owner (nullable)
        $owner = null;
        if (!empty($row['user_id'])) {
            $owner = new User([
                'id' => (int) $row['user_id'],
                'displayName' => $row['user_display_name'] ?? '',
                'email' => $row['user_email'] ?? '',
                'city' => $row['user_city'] ?? null,
                'bio' => $row['user_bio'] ?? '',
                'avatarUrl' => $row['user_avatar_url'] ?? null,

            ]);
        }

        if (method_exists($livre, 'setOwner')) {
            $livre->setOwner($owner);
        }

        return $livre;
    }

    /**
     * Compte les livres d'un utilisateur'.
     * @param int $OwnerId
     * @return int
     */
    public function countBooksByOwner(int $OwnerId): int
    {
        $sql = 'SELECT COUNT(*) FROM books WHERE owner_id = :id';
        $result = $this->db->query($sql, ['id' => $OwnerId]);

        return (int) $result->fetchColumn();
    }

    /**
     * Récupère tous les livres d'un utilisataur.
     * @return array<livre> : un tableau d'objets livre.
     */
    public function getBooksByOwnerId(int $OwnerId): array
    {
        $sql = "SELECT * FROM books WHERE owner_id = :id";
        $result = $this->db->query($sql, ['id' => $OwnerId]);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC); // ← récupérer toutes les lignes

        $livres = [];
        foreach ($rows as $row) {
            $livres[] = new Livre($row);
        }

        return $livres;
    }

}