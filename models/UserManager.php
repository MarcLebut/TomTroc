<?php

/** 
 * Classe UserManager pour gérer les requêtes liées aux utilisateurs et à l'authentification.
 */

class UserManager extends AbstractEntityManager
{

    /** Mappe une ligne SQL -> objet User (dates en objets) */
private function mapRowToUser(array $row): User
{
    $user = new User([
        'id'           => (int) ($row['id'] ?? 0),
        'email'        => $row['email'] ?? '',
        'passwordHash' => $row['password_hash'] ?? '',
        'displayName'  => $row['display_name'] ?? null,
        'bio'          => $row['bio'] ?? null,
        'avatarUrl'    => $row['avatar_url'] ?? null,
        'city'         => $row['city'] ?? null,
    ]);

    // Dates -> objets (ou null si vide)
    $created = !empty($row['created_at']) ? new \DateTimeImmutable($row['created_at']) : null;
    $updated = !empty($row['updated_at']) ? new \DateTimeImmutable($row['updated_at']) : null;

    $user->setCreatedAt($created);
    $user->setUpdatedAt($updated);

    return $user;
}

    /** Retourne un utilisateur par id (ou null) */
    public function getUserById(int $id): ?User
    {
        $sql = "SELECT id, email, password_hash, display_name, bio, avatar_url, city, created_at
                FROM users
                WHERE id = :id
                LIMIT 1";
        $result = $this->db->query($sql, ['id' => $id]);
        $row = $result?->fetch(\PDO::FETCH_ASSOC);
        return $row ? $this->mapRowToUser($row) : null;
    }

    /** Retourne un utilisateur par email (ou null) */
    public function getUserByEmail(string $email): ?User
    {
        $sql = "SELECT id, email, password_hash, display_name, bio, avatar_url, city
                FROM users
                WHERE email = :email
                LIMIT 1";
        $result = $this->db->query($sql, ['email' => $email]);
        $row = $result?->fetch(\PDO::FETCH_ASSOC);
        return $row ? $this->mapRowToUser($row) : null;
    }

    /** Retourne un utilisateur par display_name (ou null) */
    public function getUserByDisplayName(string $displayName): ?User
    {
        $sql = "SELECT id, email, password_hash, display_name, bio, avatar_url, city
                FROM users
                WHERE display_name = :display_name
                LIMIT 1";
        $result = $this->db->query($sql, ['display_name' => $displayName]);
        $row = $result?->fetch(\PDO::FETCH_ASSOC);
        return $row ? $this->mapRowToUser($row) : null;
    }

    /** Création d’un utilisateur : retourne l'objet User inséré */
    public function create(array $data): User
    {
        $sql = "INSERT INTO users (email, password_hash, display_name, bio, avatar_url, city)
            VALUES (:email, :password_hash, :display_name, :bio, :avatar_url, :city)";

        $params = [
            'email' => $data['email'],
            'password_hash' => $data['password_hash'],   // hash déjà calculé
            'display_name' => $data['display_name'],
            'bio' => $data['bio'] ?? null,
            'avatar_url' => $data['avatar_url'] ?? null,
            'city' => $data['city'] ?? null
        ];

        $this->db->query($sql, $params);

        $id = (int) $this->db->getPdo()->lastInsertId();


        // Retour via le constructeur qui attend un tableau (camelCase dans l’objet)
        return new User([
            'id' => $id,
            'email' => $data['email'],
            'passwordHash' => $data['password_hash'],    // cohérent avec mapRowToUser()
            'displayName' => $data['display_name'],
            'bio' => $data['bio'] ?? null,
            'avatarUrl' => $data['avatar_url'] ?? null,
            'city' => $data['city'] ?? null,
            // 'createdAt'  => ..., // si tu relis depuis la BDD
            // 'updatedAt'  => ...,
        ]);
    }



    /** Mise à jour d’un utilisateur */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE users
                SET email = :email,
                    password_hash = :password_hash,
                    display_name = :display_name,
                    bio = :bio,
                    avatar_url = :avatar_url,
                    city = :city
                WHERE id = :id";
        $params = [
            'id' => $id,
            'email' => $data['email'],
            'password_hash' => $data['passwordHash'] ?? $data['password_hash'] ?? '',
            'display_name' => $data['displayName'] ?? $data['display_name'] ?? '',
            'bio' => $data['bio'] ?? null,
            'avatar_url' => $data['avatarUrl'] ?? $data['avatar_url'] ?? null,
            'city' => $data['city'] ?? null,
        ];
        $result = $this->db->query($sql, $params);
        return $result->rowCount() > 0;
    }

    /** Suppression */
    public function delete(int $id): bool
    {
        $result = $this->db->query("DELETE FROM users WHERE id = :id", ['id' => $id]);
        return $result->rowCount() > 0;
    }
}
