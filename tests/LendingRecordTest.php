<?php

require_once __DIR__ . '/../src/Domain/LendingRecord.php';

use App\Domain\LendingRecord;

function assertTrue(bool $condition, string $message): void
{
    if (!$condition) {
        throw new Exception($message);
    }
}

$borrowedAt = new DateTimeImmutable('2026-07-10 09:00:00');
$dueDate = new DateTimeImmutable('2026-07-15 09:00:00');

$record = new LendingRecord('loan-1', 'book-1', 'student-42', $borrowedAt, $dueDate);

assertTrue($record->getBookId() === 'book-1', 'Expected book id to be stored');
assertTrue($record->getStudentId() === 'student-42', 'Expected student id to be stored');
assertTrue($record->getStatus() === 'borrowed', 'Expected initial status to be borrowed');

$record->markReturned(new DateTimeImmutable('2026-07-14 10:30:00'));
assertTrue($record->getStatus() === 'returned', 'Expected status to be returned');
assertTrue($record->getReturnedAt() !== null, 'Expected returned timestamp to be set');

$overdueRecord = new LendingRecord(
    'loan-2',
    'book-2',
    'student-99',
    new DateTimeImmutable('2026-07-01 09:00:00'),
    new DateTimeImmutable('2026-07-05 09:00:00')
);

assertTrue($overdueRecord->isOverdue(new DateTimeImmutable('2026-07-07 09:00:00')) === true, 'Expected overdue to be detected');
assertTrue($overdueRecord->isOverdue(new DateTimeImmutable('2026-07-04 09:00:00')) === false, 'Expected loan to not be overdue before the due date');

echo "LendingRecord tests passed\n";
