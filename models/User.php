<?php

/**
 * Entité User alignée sur la table `users`.
 * - Propriétés : id, email, passwordHash, displayName, bio, avatarUrl, city, createdAt, updatedAt
 * - Getters/Setters cohérents
 * - Rétro-compatibilité : getName()/setName() -> displayName
 * - Gestion sécurisée du mot de passe : setPasswordHash()/verifyPassword()
 */
class User extends AbstractEntity
{
    protected int $id;
    private string $email = '';
    private ?string $passwordHash;
    private ?string $displayName;
    private ?string $bio = null;
    private ?string $avatarUrl = '';
    private ?string $city = null;
    /** Dates en objets */
    private ?\DateTimeInterface $createdAt = null;
    private ?\DateTimeInterface $updatedAt = null;

    /*
    public function __construct(array $data)
    {
        $this->id           = (int)($data['id'] ?? 0);
        $this->email        = (string)$data['email'];
        $this->passwordHash = $data['passwordHash'] ?? null;   // optionnel de l’exposer
        $this->displayName  = (string)$data['user_display_name''] ?? '';
        $this->bio          = $data['bio'] ?? null;
        $this->avatarUrl    = $data['avatarUrl'] ?? null;
        $this->city         = $data['city'] ?? null;
        $this->createdAt    = $data['createdAt'] ?? null;
        $this->updatedAt    = $data['updatedAt'] ?? null;
    }
*/


    // --- ID ---
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // --- Email ---
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = trim($email);
    }

    // --- Display name (utilisé par la vue) ---
    public function getDisplayName(): string
    {
        return $this->displayName;
    }
    public function setDisplayName(string $displayName): void
    {
        $this->displayName = trim($displayName);
    }

    // Rétro-compat : anciens appels getName()/setName()
    public function getName(): string
    {
        return $this->getDisplayName();
    }
    public function setName(string $name): void
    {
        $this->setDisplayName($name);
    }

    // --- Mot de passe (hash) ---
    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }
    public function setPasswordHash(string $hash): void
    {
        $this->passwordHash = $hash;
    }

    /**
     * Déconseillé : on ne stocke pas le mot de passe en clair.
     * Si tu reçois un mot de passe en clair, hashe-le avant de persister :
     */
    public function setPassword(string $plain): void
    {
        $this->passwordHash = password_hash($plain, PASSWORD_DEFAULT);
    }

    /**
     * Vérifie un mot de passe en clair contre le hash stocké.
     */
    public function verifyPassword(string $plain): bool
    {
        return password_verify($plain, $this->passwordHash);
    }

    // --- Profil ---
    public function getBio(): ?string
    {
        return $this->bio;
    }
    public function setBio(?string $bio): void
    {
        $this->bio = $bio !== null ? trim($bio) : null;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatarUrl;
    }
    public function setAvatarUrl(?string $avatarUrl): void
    {
        $this->avatarUrl = $avatarUrl !== null ? trim($avatarUrl) : null;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(?string $city): void
    {
        $this->city = $city !== null ? trim($city) : null;
    }

    // --- Dates ---
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    function setCreatedAt(?\DateTimeInterface $dt): void
    {
        $this->createdAt = $dt;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $dt): void
    {
        $this->updatedAt = $dt;
    }
}
