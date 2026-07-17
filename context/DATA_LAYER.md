# Data Layer

The data layer should model the core entities involved in book lending.

## Core Entities

- Book: represents a physical or digital library item.
- Member: represents a library user who can borrow books.
- BorrowRecord: tracks a loan transaction between a member and a book.
- ReturnRecord: tracks the return of a borrowed book.
- Fine: optional entity for overdue penalties or late return handling.

## Data Responsibilities

- Store book metadata such as title, author, ISBN, and availability.
- Store member information such as name, contact details, and account status.
- Maintain lending history through borrow and return records.
- Ensure the current availability state of each book is accurate.

## Notes

The domain model should make it easy to answer common questions such as:
- Which books are currently available?
- Which members currently have books on loan?
- Which loans are overdue?
