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

- members
  - id
  - full_name
  - email
  - phone
  - membership_status
  - created_at

- borrow_records
  - id
  - book_id
  - member_id
  - borrowed_at
  - due_date
  - returned_at
  - status

- fines
  - id
  - member_id
  - amount
  - reason
  - status
  - created_at

## Relationships

- One book can appear in many borrow records over time.
- One member can have many borrow records.
- A fine can be associated with one member.

## Persistence Notes

- The database should preserve historical lending records even after a book is returned.
- Availability should be derived from the latest borrow/return state where possible.
- Date and status fields should be populated consistently to support overdue logic.
