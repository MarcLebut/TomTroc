<?php

class Livre extends AbstractEntity
{
    protected int $id;
    private ?int $ownerId = null;         // correspond à books.owner_id
    private ?User $owner = null;          // relation hydratée via la jointure
    private string $title = '';
    private ?string $author = null;
    private ?string $coverUrl = null;
    private ?string $description = null;
    private string $status = 'available'; // fait partie de BookStatus::all()
    private ?DateTime $createdAt = null;
    private ?DateTime $updatedAt = null;

    // --- ID ---
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // --- FK owner_id ---
    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }
    public function setOwnerId(?int $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    // Compat (ancien nommage)
    public function getidOwner(): ?int
    {
        return $this->getOwnerId();
    }
    public function setidOwner(int $idOwner): void
    {
        $this->setOwnerId($idOwner);
    }

    // --- Relation propriétaire ---
    public function getOwner(): ?User
    {
        return $this->owner;
    }
    public function setOwner(?User $owner): void
    {
        $this->owner = $owner;
    }

    // --- Titre / Auteur / Cover / Description ---
    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): void
    {
        $this->title = trim($title);
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }
    public function setAuthor(?string $author): self
    {
        $this->author = $author !== null ? trim($author) : null;
        return $this;
    }

    public function getCoverUrl(): ?string
    {
        return $this->coverUrl;
    }
    public function setCoverUrl(?string $coverUrl): self
    {
        $this->coverUrl = $coverUrl !== null ? trim($coverUrl) : null;
        return $this;
    }

    public function getDescription(int $length = -1): string
    {
        $desc = (string) ($this->description ?? '');
        if ($length > 0 && mb_strlen($desc) > $length) {
            return mb_substr($desc, 0, $length) . '...';
        }
        return $desc;
    }
    public function setDescription(?string $description): self
    {
        $this->description = $description !== null ? trim($description) : null;
        return $this;
    }

    // --- Statut ---
    public function getStatus(): string
    {
        return $this->status;
    }
    public function setStatus(string $status): self
    {
        if (!in_array($status, BookStatus::all(), true)) {
            throw new \InvalidArgumentException("Invalid status: $status");
        }
        $this->status = $status;
        return $this;
    }
    public function getStatusLabel(): string
    {
        return BookStatus::labelOf($this->status);
    }

    // --- Dates ---
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }
    public function setCreatedAt(string|DateTime|null $createdAt, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($createdAt)) {
            $createdAt = DateTime::createFromFormat($format, $createdAt);
        }
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(string|DateTime|null $updatedAt, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($updatedAt)) {
            $updatedAt = DateTime::createFromFormat($format, $updatedAt);
        }
        $this->updatedAt = $updatedAt;
    }
}
