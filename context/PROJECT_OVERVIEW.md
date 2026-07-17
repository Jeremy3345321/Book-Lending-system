# Project Overview

The Book Lending System is a school library-focused application designed to manage the lifecycle of borrowing and returning books.

## Purpose

The system helps the school library track books, students, lending activity, and return status in a structured way. The core focus is on the book lending process, including checking out books, returning them, and tracking overdue items.

## Core Goals

- Manage books and their availability.
- Register and maintain student accounts.
- Support book borrowing and returns.
- Track overdue books and lending history.
- Provide a reliable foundation for future reporting and admin features.

## Main Functional Areas

- Book inventory management
- Student account management
- Borrowing workflow
- Return workflow
- Overdue tracking

## What Needs to Be Done

- Implement the core domain models for books, students, and lending records.
- Create the database schema and persistence layer for books, borrowers, and transactions.
- Finish the book management service logic for adding, updating, and listing books.
- Implement borrowing and returning workflows with availability checks.
- Add overdue calculation and status tracking for late returns.
- Write automated tests for core business rules and edge cases.
- Build a simple user interface or API layer for librarians to manage the system.
- Add authentication and authorization for admin and library staff roles.

## Tech Stack

- XAMPP with PHP and MySQL for local database storage
- Book data is persisted in a MySQL database through the repository layer