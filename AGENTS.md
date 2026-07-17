# AGENTS.md

This file is the primary working guide for the Book Lending System project. It should be consulted before implementation work begins and updated as the project evolves.

## Context File Index

A context folder exists at the project root to capture project knowledge and implementation guidance.

Current context files:
- [context/PROJECT_OVERVIEW.md](context/PROJECT_OVERVIEW.md) - Product scope, goals, and primary user stories.
- [context/DESIGN_ARCHITECTURE.md](context/DESIGN_ARCHITECTURE.md) - Proposed system structure and architectural decisions.
- [context/DATA_LAYER.md](context/DATA_LAYER.md) - Core domain entities and data responsibilities.
- [context/DATABASE_CONTEXT.md](context/DATABASE_CONTEXT.md) - Database tables, relationships, and persistence notes.

## Code Guidelines

- Separation of concerns: keep files focused on a single responsibility and avoid creating large monolithic files.
- Use clear and descriptive names for files, classes, functions, and variables.
- Keep business rules in dedicated service or domain logic rather than spreading them across unrelated modules.
- Prefer small, testable units of code over tightly coupled implementations.
- Follow consistent formatting and keep the codebase easy to read and maintain.
- Document important decisions in the relevant context files when they affect architecture or behavior.

## How this guide should be used

- As the project grows, add more context files under the context folder rather than overloading this guide.
- Before starting any implementation task, review the relevant context files first.
- At the end of each task implementation, update the relevant context markdown files to reflect new decisions, changes, or discovered requirements.
