<?php

require_once __DIR__ . '/../src/Domain/Book.php';
require_once __DIR__ . '/../src/Data/BookRepository.php';
require_once __DIR__ . '/../src/Application/BookService.php';

function assertTrue(bool $condition, string $message): void
{
    if (!$condition) {
        throw new Exception($message);
    }
}

$storagePath = sys_get_temp_dir() . '/book_lending_test.json';
if (file_exists($storagePath)) {
    unlink($storagePath);
}

$repository = new BookRepository($storagePath);
$service = new BookService($repository);

$book = $service->createBook('Clean Code', 'Robert Martin', '9780132350884');
assertTrue($book->getId() !== null, 'Expected created book to have an id');
assertTrue($book->getTitle() === 'Clean Code', 'Expected title to be stored');
assertTrue($service->listBooks()[0]->getIsbn() === '9780132350884', 'Expected ISBN to be stored');

$updated = $service->updateBook($book->getId(), 'The Pragmatic Programmer', 'Andy Hunt', '9780201616224');
assertTrue($updated->getTitle() === 'The Pragmatic Programmer', 'Expected title to be updated');
assertTrue($service->getBook($book->getId())->getAuthor() === 'Andy Hunt', 'Expected author to be updated');

$service->deleteBook($book->getId());
assertTrue($service->listBooks() === [], 'Expected book list to be empty after deletion');

echo "BookService tests passed\n";
