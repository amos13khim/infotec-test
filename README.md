# Books Catalog on Yii2 + MySQL + Docker

Minimal Yii2 Basic project for a books catalog with guest access, user CRUD, author subscriptions and public reporting.

## Requirements

- Docker
- Docker Compose

## Quick start

1. Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
2. Start the application:
   ```bash
   docker compose up --build -d
   ```
3. Run migrations:
   ```bash
   docker compose exec app php yii migrate --interactive=0
   ```
4. Open the app in the browser:
   - http://localhost:8080

## Default user

- Username: admin
- Password: admin123

## Notes

- Guest can view books and subscribe to authors by phone.
- Logged-in user can create, update, and delete books/authors.
- Public report is available at /site/report.
- SMS sending is simulated via the SMSPilot emulator mode.
