<?php

namespace App\Domain;

use DateTimeImmutable;

class LendingRecord
{
    private string $id;
    private string $bookId;
    private string $studentId;
    private DateTimeImmutable $borrowedAt;
    private DateTimeImmutable $dueDate;
    private ?DateTimeImmutable $returnedAt = null;
    private string $status;

    public function __construct(
        string $id,
        string $bookId,
        string $studentId,
        DateTimeImmutable $borrowedAt,
        DateTimeImmutable $dueDate,
        ?DateTimeImmutable $returnedAt = null,
        string $status = 'borrowed'
    ) {
        $this->id = $id;
        $this->bookId = $bookId;
        $this->studentId = $studentId;
        $this->borrowedAt = $borrowedAt;
        $this->dueDate = $dueDate;
        $this->returnedAt = $returnedAt;
        $this->status = $status;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBookId(): string
    {
        return $this->bookId;
    }

    public function getStudentId(): string
    {
        return $this->studentId;
    }

    public function getBorrowedAt(): DateTimeImmutable
    {
        return $this->borrowedAt;
    }

    public function getDueDate(): DateTimeImmutable
    {
        return $this->dueDate;
    }

    public function getReturnedAt(): ?DateTimeImmutable
    {
        return $this->returnedAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function markReturned(DateTimeImmutable $returnedAt): void
    {
        $this->returnedAt = $returnedAt;
        $this->status = 'returned';
    }

    public function isOverdue(DateTimeImmutable $asOf = null): bool
    {
        $referenceDate = $asOf ?? new DateTimeImmutable('now');

        if ($this->status === 'returned') {
            return false;
        }

        return $referenceDate > $this->dueDate;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'book_id' => $this->bookId,
            'student_id' => $this->studentId,
            'borrowed_at' => $this->borrowedAt->format('Y-m-d H:i:s'),
            'due_date' => $this->dueDate->format('Y-m-d H:i:s'),
            'returned_at' => $this->returnedAt?->format('Y-m-d H:i:s'),
            'status' => $this->status,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? '',
            $data['book_id'] ?? '',
            $data['student_id'] ?? '',
            new DateTimeImmutable($data['borrowed_at'] ?? 'now'),
            new DateTimeImmutable($data['due_date'] ?? 'now'),
            isset($data['returned_at']) && $data['returned_at'] !== null
                ? new DateTimeImmutable($data['returned_at'])
                : null,
            $data['status'] ?? 'borrowed'
        );
    }
}
