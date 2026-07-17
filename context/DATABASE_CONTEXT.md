# Database Context

The database should support the core lending workflow and provide a reliable record of borrowing activity.

## Suggested Tables

- books
  - id
  - title
  - author
  - isbn
  - availability_status
  - created_at

- students
  - id
  - full_name
  - email
  - phone
  - created_at

- borrow_records
  - id
  - book_id
  - student_id
  - borrowed_at
  - due_date
  - returned_at
  - status


## Relationships

- One book can appear in many borrow records over time.
- One student can have many borrow records.

## Persistence Notes

- The database should preserve historical lending records even after a book is returned.
- Availability should be derived from the latest borrow/return state where possible.
- Date and status fields should be populated consistently to support overdue logic.
