<?php

namespace App\Data;

use App\Domain\Book;

class BookRepository
{
    private string $storagePath;

    public function __construct(string $storagePath)
    {
        $this->storagePath = $storagePath;
    }

    public function create(Book $book): Book
    {
        $books = $this->loadBooks();
        $book->setAvailable(true);
        $bookId = $book->getId();

        if ($bookId === null || $bookId === '') {
            $bookId = $this->generateId();
        }

        $bookData = $book->toArray();
        $bookData['id'] = $bookId;
        $books[$bookId] = $bookData;
        $this->saveBooks($books);

        return Book::fromArray($bookData);
    }

    public function update(Book $book): Book
    {
        $books = $this->loadBooks();
        $bookId = $book->getId();

        if ($bookId === null || !isset($books[$bookId])) {
            throw new \InvalidArgumentException('Book not found');
        }

        $books[$bookId] = $book->toArray();
        $this->saveBooks($books);

        return Book::fromArray($books[$bookId]);
    }

    public function delete(string $id): void
    {
        $books = $this->loadBooks();
        unset($books[$id]);
        $this->saveBooks($books);
    }

    public function findById(string $id): ?Book
    {
        $books = $this->loadBooks();
        if (!isset($books[$id])) {
            return null;
        }

        return Book::fromArray($books[$id]);
    }

    public function findAll(): array
    {
        $books = $this->loadBooks();
        return array_map(static fn(array $data): Book => Book::fromArray($data), array_values($books));
    }

    private function loadBooks(): array
    {
        if (!file_exists($this->storagePath)) {
            return [];
        }

        $content = file_get_contents($this->storagePath);
        if ($content === false || trim($content) === '') {
            return [];
        }

        $decoded = json_decode($content, true);
        if (!is_array($decoded)) {
            return [];
        }

        return $decoded;
    }

    private function saveBooks(array $books): void
    {
        $directory = dirname($this->storagePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents($this->storagePath, json_encode($books, JSON_PRETTY_PRINT));
    }

    private function generateId(): string
    {
        return 'book-' . uniqid();
    }
}
