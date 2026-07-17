# Design Architecture

The system follows a modular and layered architecture so that features remain maintainable as the project grows.

## Current Structure

- Presentation layer: handles user interaction, API endpoints, or UI views.
- Application layer: contains use cases and orchestration logic for book management and lending operations.
- Domain layer: contains business rules for books and lending records, including overdue checks.
- Data layer: handles persistence through repositories and MySQL access using XAMPP.

## Design Principles

- Keep each module focused on one responsibility.
- Separate domain logic from infrastructure concerns.
- Use clear service and repository boundaries.
- Make the lending workflow explicit and easy to follow.

## Current Modules

- Book management
- Lending record domain model
- Repository-backed persistence with MySQL
- Future support for borrowing, returning, and overdue workflows
