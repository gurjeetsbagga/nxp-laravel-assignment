# NXP Laravel Developer Assignment

### Requirements

- PHP 8.1+
- Composer
- SQLite (or MySQL)

### Setup

1. Clone the repo
2. Run `composer install`
3. Copy `.env.example` to `.env` and set up the database
4. Run `php artisan key:generate`
5. Run `php artisan migrate --seed`
6. Run `php artisan serve`

Visit: [http://localhost:8000](http://localhost:8000)

### Test the feature

```bash
curl -X POST http://localhost:8000/api/providers/1/orders \
  -H "Content-Type: application/json" \
  -d '{"items":[{"product_id":1,"quantity":2}]}'
```

---

## Notes

- Add login system later using Laravel Sanctum.
- Add reports for stock and orders.
- Add payments and renewals later.

---
