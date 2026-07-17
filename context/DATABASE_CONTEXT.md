# Database Context

The database supports the core lending workflow using XAMPP with MySQL.

## Current Tables

- books
  - id
  - title
  - author
  - isbn
  - availability_status
  - created_at

- lending_records
  - id
  - book_id
  - student_id
  - borrowed_at
  - due_date
  - returned_at
  - status

## Relationships

- One book can appear in many lending records over time.
- A lending record references a student through the student_id field only.

## Persistence Notes

- The database preserves historical lending records even after a book is returned.
- Book availability is stored as an availability_status field and can be updated as loans change.
- Date and status fields should be populated consistently to support overdue logic.
- The repository layer uses the XAMPP MySQL connection configured locally via PHP.
