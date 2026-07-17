# Data Layer

The data layer models the core entities involved in book lending using a MySQL-backed persistence layer on XAMPP.

## Core Entities

- Book: represents a library item with title, author, ISBN, and availability.
- LendingRecord: tracks a borrowing transaction between a book and a student identifier.
- Student: not modeled as a separate entity in the domain; it is represented by a simple student_id field on the lending record.

## Data Responsibilities

- Store book metadata such as title, author, ISBN, and availability status.
- Store lending history through borrowing and return records.
- Preserve the current and historical state of each loan.
- Support overdue calculations by comparing the current date with the due date.

## Notes

The domain model should make it easy to answer common questions such as:
- Which books are currently available?
- Which books are currently on loan?
- Which loans are overdue?
- Which student IDs are associated with a borrowing record?
