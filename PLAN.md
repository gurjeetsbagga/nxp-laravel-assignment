**Project understanding**

HSL LABS sells a nutritional product through Licensed Providers (plastic surgeons). Providers need a dashboard to manage orders, inventory, patients, and billing. This project focuses on the Provider side for ordering and inventory.

**Assumptions**

- Providers can log in to the dashboard. Only a test provider is added for now.
- Payment setup is not included. The project only covers placing orders.
- Product details are stored in the local database.
- Emails are simulated using a local setup.

**Main components / modules**

1. Authentication (basic for providers)
2. Product list
3. Inventory per provider
4. Orders and Order Items
5. Billing (future)
6. Patients and Subscriptions (future)
7. Background jobs (for email)

**Key questions for the company**

1. Is each provider’s account separate or shared?
2. What is the expected number of monthly orders?
3. Which payment method do you plan to use later?
4. Is the inventory specific to each provider or shared?

**Milestone timeline**

- Week 1 — Plan and design data model
- Week 2 — Build core models and API for orders and inventory
- Week 3 — Create dashboard for providers
- Week 4 — Add billing and emails
- Week 5 — Test and finalize
