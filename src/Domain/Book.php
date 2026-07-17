<?php

namespace App\Domain;

class Book
{
    private ?string $id;
    private string $title;
    private string $author;
    private string $isbn;
    private bool $available;

    public function __construct(?string $id, string $title, string $author, string $isbn, bool $available = true)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->available = $available;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'available' => $this->available,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? '',
            $data['author'] ?? '',
            $data['isbn'] ?? '',
            (bool) ($data['available'] ?? true)
        );
    }
}
