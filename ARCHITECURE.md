This section explains the design in simple words. It shows how the system works, what parts connect, and how data moves between them.

### ERD (simple ASCII)

```
- providers (id, name, email)
- products  (id, sku, name, units_per_box, units_in_stock)
- orders    (id, provider_id, total_amount, status, created_at)
- order_items (id, order_id, product_id, quantity, unit_price)
- users (provider staff) (id, provider_id, name, role)
```
ERD (ASCII):
[providers] 1---* [orders] *---* [order_items] *---1 [products]
[providers] 1---* [users]

### High level explanation

- Provider places an order.
- The system checks available stock.
- If enough, it saves the order and items.
- Inventory is updated.
- The system sends an `OrderPlaced` event.
- A listener sends a confirmation email.
- The database stores all product, order, and stock data.
- Background jobs send emails quickly.

**Why this setup?**

- Keeping inventory linked to each provider makes stock and reports easy.
- Having separate order and order item tables helps keep records clear and flexible for future features.
- Using an service file (`PlaceOrderService`) keeps main controllers simple and neat.

### Project skeleton

Below is the folder structure of the Laravel project:

```
app/
  Models/
    Provider.php
    Product.php
    Inventory.php
    Order.php
    OrderItem.php
  Http/
    Controllers/
      Api/
        ProviderOrderController.php
    Requests/
      PlaceOrderRequest.php
  Services/
    PlaceOrderService.php
  Policies/
    ProviderPolicy.php
  Providers/
    EventServiceProvider.php
  Repository/
    InventoryRepository.php
  Events/
    OrderPlaced.php
  Listeners/
    SendOrderConfirmationListener.php
  Jobs/
    SendOrderConfirmationJob.php
database/
  migrations/
  seeders/
routes/
  api.php
tests/
  Feature/
    OrderPlacementFeatureTest.php
  Unit/
    OrderPlacementTest.php

README.md
PLAN.md
ARCHITECTURE.md
```

This structure keeps the code clear and each part separate for easy updates.

---

## Vertical slice (Option A): Provider places a wholesale product order

**Feature summary**

- Endpoint: `POST /api/providers/{provider}/orders`
- Input: product IDs and quantities
- Steps: save order → save items → update stock → return confirmation
- Side effect: sends `OrderPlaced` event and confirmation email

**Why this feature:** It’s a simple end-to-end example that shows how the system works — from request to response.

---
