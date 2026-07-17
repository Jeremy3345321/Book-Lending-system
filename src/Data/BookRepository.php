<?php

namespace App\Data;

use App\Domain\Book;
use PDO;

class BookRepository
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        if ($pdo === null) {
            $this->pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=book_lending;charset=utf8mb4', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } else {
            $this->pdo = $pdo;
        }
    }

    public function create(Book $book): Book
    {
        $bookId = $book->getId();
        if ($bookId === null || $bookId === '') {
            $bookId = 'book-' . uniqid();
        }

        $statement = $this->pdo->prepare(
            'INSERT INTO books (id, title, author, isbn, availability_status, created_at) VALUES (:id, :title, :author, :isbn, :availability_status, :created_at)'
        );

        $statement->execute([
            ':id' => $bookId,
            ':title' => $book->getTitle(),
            ':author' => $book->getAuthor(),
            ':isbn' => $book->getIsbn(),
            ':availability_status' => $book->isAvailable() ? 'available' : 'unavailable',
            ':created_at' => (new \DateTimeImmutable('now'))->format('Y-m-d H:i:s'),
        ]);

        return $this->findById($bookId) ?? $book;
    }

    public function update(Book $book): Book
    {
        $bookId = $book->getId();
        if ($bookId === null || $bookId === '') {
            throw new \InvalidArgumentException('Book not found');
        }

        $statement = $this->pdo->prepare(
            'UPDATE books SET title = :title, author = :author, isbn = :isbn, availability_status = :availability_status WHERE id = :id'
        );

        $statement->execute([
            ':title' => $book->getTitle(),
            ':author' => $book->getAuthor(),
            ':isbn' => $book->getIsbn(),
            ':availability_status' => $book->isAvailable() ? 'available' : 'unavailable',
            ':id' => $bookId,
        ]);

        if ($statement->rowCount() === 0) {
            throw new \InvalidArgumentException('Book not found');
        }

        return $this->findById($bookId) ?? $book;
    }

    public function delete(string $id): void
    {
        $statement = $this->pdo->prepare('DELETE FROM books WHERE id = :id');
        $statement->execute([':id' => $id]);
    }

    public function findById(string $id): ?Book
    {
        $statement = $this->pdo->prepare('SELECT * FROM books WHERE id = :id');
        $statement->execute([':id' => $id]);
        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return Book::fromArray([
            'id' => $row['id'],
            'title' => $row['title'],
            'author' => $row['author'],
            'isbn' => $row['isbn'],
            'available' => $row['availability_status'] === 'available',
        ]);
    }

    public function findAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM books ORDER BY created_at ASC');
        $rows = $statement->fetchAll();

        return array_map(static fn(array $row): Book => Book::fromArray([
            'id' => $row['id'],
            'title' => $row['title'],
            'author' => $row['author'],
            'isbn' => $row['isbn'],
            'available' => $row['availability_status'] === 'available',
        ]), $rows);
    }
}
