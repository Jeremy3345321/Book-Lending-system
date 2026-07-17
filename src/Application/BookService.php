<?php

namespace App\Application;

use App\Data\BookRepository;
use App\Domain\Book;

class BookService
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createBook(string $title, string $author, string $isbn): Book
    {
        $this->validateBookData($title, $author, $isbn);
        $book = new Book(null, $title, $author, $isbn, true);
        return $this->repository->create($book);
    }

    public function getBook(string $id): ?Book
    {
        return $this->repository->findById($id);
    }

    public function listBooks(): array
    {
        return $this->repository->findAll();
    }

    public function updateBook(string $id, string $title, string $author, string $isbn): Book
    {
        $this->validateBookData($title, $author, $isbn);
        $existing = $this->repository->findById($id);

        if ($existing === null) {
            throw new \InvalidArgumentException('Book not found');
        }

        $existing->setTitle($title);
        $existing->setAuthor($author);
        $existing->setIsbn($isbn);

        return $this->repository->update($existing);
    }

    public function deleteBook(string $id): void
    {
        $this->repository->delete($id);
    }

    private function validateBookData(string $title, string $author, string $isbn): void
    {
        if (trim($title) === '') {
            throw new \InvalidArgumentException('Book title is required');
        }

        if (trim($author) === '') {
            throw new \InvalidArgumentException('Book author is required');
        }

        if (trim($isbn) === '') {
            throw new \InvalidArgumentException('Book ISBN is required');
        }
    }
}
