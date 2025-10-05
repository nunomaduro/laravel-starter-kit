# 💡 Real Project Examples

Learn how to use Claude Code Super Wizard in real-world scenarios.

---

## Table of Contents

1. [Building an E-commerce Platform](#example-1-building-an-e-commerce-platform)
2. [SaaS Multi-Tenant Application](#example-2-saas-multi-tenant-application)
3. [API-First Mobile Backend](#example-3-api-first-mobile-backend)
4. [Enterprise CRM System](#example-4-enterprise-crm-system)
5. [Real-Time Collaboration Tool](#example-5-real-time-collaboration-tool)

---

## Example 1: Building an E-commerce Platform

### Project Overview

**Name:** ShopLocal - Handmade Products Marketplace
**Stage:** MVP (3 months timeline)
**Team:** Solo developer
**Stack:** Laravel 12 + Vue 3 + Stripe

### Setup Wizard Answers

```
=== PROJECT DISCOVERY ===
Q: Project name? ShopLocal
Q: What are you building? Online marketplace for handmade products
Q: Project stage? 2 (MVP)
Q: Timeline? 2 (1-3 months)

=== TEAM & WORKFLOW ===
Q: Team size? 1 (Solo developer)
Q: Experience level? 3 (Mostly seniors)
Q: Methodology? 2 (Agile/Scrum)

=== ARCHITECTURE PREFERENCES ===
Q: Backend pattern? 3 (Actions/Commands)
Q: Frontend approach? 3 (Composables/Hooks heavy)
Q: Module communication? 2 (Events only)

=== DEVELOPMENT PREFERENCES ===
Q: What slows you down? 1,4,6 (Boilerplate, Tests, Database design)
Q: Error handling? 4 (User-friendly messages)
Q: Testing strategy? 4 (High coverage 80%+)

=== BUSINESS FEATURES ===
Q: Critical features? 1,2,3,6,8,9,11
   (Auth, Payment, Email, Files, Admin, API, Analytics)
Q: Expected scale? 3 (1K-10K users)

=== INTEGRATIONS ===
Q: Payment providers? 2 (Stripe)
Q: Communication? 1,5 (SendGrid, Pusher)
Q: Third-party? 3,4,7 (OAuth, Analytics, AI services)

=== CODE STYLE ===
Q: Code style? 3 (Clean code always)
Q: Table naming? 1 (snake_case plural)

=== AI BEHAVIOR ===
Q: Explanations? 2 (Balanced)
Q: When mistakes? 3 (Fix + teach why)
Q: Proactivity? 3 (Actively prevent problems)

=== SPECIAL RULES ===
Absolute rules:
- NEVER skip writing tests
- NEVER use DB:: facade, use Eloquent only
- NEVER hardcode prices, always from database

Forbidden:
- NEVER commit directly to main
- NEVER store credit card data
- NEVER trust client-side price calculations
```

### Generated Configuration

**`.claude/config.yml`**
```yaml
project:
  name: ShopLocal
  description: Online marketplace for handmade products
  stage: mvp
  timeline: 1-3 months

architecture:
  backend: actions-pattern
  frontend: composables-heavy
  communication: events-only

features:
  - authentication
  - payments
  - email-notifications
  - file-uploads
  - admin-dashboard
  - api
  - analytics

integrations:
  payment: stripe
  email: sendgrid
  websockets: pusher
  oauth: true
  analytics: true
  ai: true

standards:
  code_quality: clean-code-always
  test_coverage: 80
  explanation_depth: balanced
  proactivity: prevent-problems
```

### Real Usage Examples

#### Scenario 1: Creating Product Management Feature

**Command:**
```
/new-feature product-management
```

**Claude Code Response:**
```
Analyzing your e-commerce requirements...
Detecting: Actions pattern, Events, Stripe integration

Creating product management feature with:

✓ Actions
  - app/Actions/Products/CreateProductAction.php
  - app/Actions/Products/UpdateProductAction.php
  - app/Actions/Products/DeleteProductAction.php
  - app/Actions/Products/PublishProductAction.php

✓ Validation
  - app/Http/Requests/CreateProductRequest.php
  - app/Http/Requests/UpdateProductRequest.php

✓ Controllers (Thin)
  - app/Http/Controllers/ProductController.php
  - app/Http/Controllers/Admin/ProductController.php

✓ Events
  - app/Events/ProductCreated.php
  - app/Events/ProductPublished.php

✓ Listeners
  - app/Listeners/SendProductPublishedNotification.php
  - app/Listeners/UpdateProductSearchIndex.php

✓ Models
  - app/Models/Product.php (with type-safe casts)

✓ Migrations
  - database/migrations/2025_01_15_create_products_table.php

✓ Factory & Seeder
  - database/factories/ProductFactory.php
  - database/seeders/ProductSeeder.php

✓ Tests (90% coverage)
  - tests/Unit/Actions/Products/CreateProductActionTest.php
  - tests/Unit/Actions/Products/UpdateProductActionTest.php
  - tests/Unit/Actions/Products/DeleteProductActionTest.php
  - tests/Feature/Http/ProductControllerTest.php
  - tests/Feature/Http/Admin/ProductControllerTest.php

✓ API Resources
  - app/Http/Resources/ProductResource.php
  - app/Http/Resources/ProductCollection.php

All files follow:
- Your Actions pattern
- Event-driven communication
- Stripe price structure (amount in cents)
- Your absolute rule: prices from database, not hardcoded

⚠️ Security note: Price validation added to prevent client manipulation
⚠️ Rule enforced: All prices fetched from Product model

Run: php artisan test --filter=Product
```

**Generated Action Example:**
```php
<?php

namespace App\Actions\Products;

use App\Models\Product;
use App\Models\User;
use App\Events\ProductCreated;

final readonly class CreateProductAction
{
    public function handle(User $seller, array $data): Product
    {
        // ⚠️ RULE ENFORCED: Never trust client price
        // Price must be validated and stored server-side

        $product = Product::create([
            'seller_id' => $seller->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'price_cents' => $data['price_cents'], // Stripe format
            'inventory' => $data['inventory'],
            'status' => 'draft',
        ]);

        event(new ProductCreated($product));

        return $product->fresh(['seller', 'images']);
    }
}
```

#### Scenario 2: Adding Checkout Flow

**Command:**
```
/new-feature checkout
```

**Claude Code Response:**
```
Analyzing checkout requirements for ShopLocal...
Detected: Stripe integration, event-driven architecture

⚠️ Applying your rules:
- ✓ Never store credit card data (using Stripe tokens)
- ✓ Never trust client prices (server-side calculation)
- ✓ Events for order state changes

Creating checkout flow:

✓ Actions
  - app/Actions/Orders/CreateOrderAction.php
  - app/Actions/Orders/ProcessPaymentAction.php
  - app/Actions/Orders/ConfirmOrderAction.php

✓ Stripe Integration
  - app/Services/Stripe/StripePaymentService.php
  - config/services.php (Stripe credentials)

✓ Events & Listeners
  - app/Events/OrderCreated.php
  - app/Events/OrderConfirmed.php
  - app/Events/PaymentProcessed.php
  - app/Listeners/SendOrderConfirmationEmail.php
  - app/Listeners/ReduceProductInventory.php
  - app/Listeners/NotifySellerOfNewOrder.php

✓ Tests (95% coverage including Stripe mocking)
  - tests/Unit/Actions/Orders/CreateOrderActionTest.php
  - tests/Unit/Services/Stripe/StripePaymentServiceTest.php
  - tests/Feature/CheckoutFlowTest.php (full integration test)

✓ Security measures:
  - Server-side price calculation (your rule enforced)
  - Stripe token validation
  - Inventory locking (prevents overselling)
  - Transaction rollback on payment failure

Run: php artisan test --filter=Checkout
```

**Generated Test Example:**
```php
it('prevents price manipulation during checkout', function () {
    $product = Product::factory()->create(['price_cents' => 5000]); // $50

    $response = $this->postJson('/api/checkout', [
        'product_id' => $product->id,
        'quantity' => 1,
        'price_cents' => 100, // ⚠️ Trying to manipulate price to $1
        'stripe_token' => 'tok_visa',
    ]);

    // ✓ Rule enforced: Server fetches real price from database
    expect($product->fresh()->price_cents)->toBe(5000);

    // ✓ Order total calculated server-side
    $order = Order::latest()->first();
    expect($order->total_cents)->toBe(5000); // Not the manipulated 100
});
```

#### Scenario 3: Debugging a Bug

**Command:**
```
/fix-bug Shopping cart items disappearing after page refresh
```

**Claude Code Response:**
```
Analyzing shopping cart issue...

🔍 Systematic debugging approach:

STEP 1: Checking session configuration
✓ config/session.php - driver: 'redis'
✓ REDIS_CLIENT=predis in .env
⚠️ Issue found: Session lifetime too short (2 minutes)

STEP 2: Checking cart storage logic
✓ app/Actions/Cart/AddToCartAction.php
⚠️ Issue found: Cart stored in session, but session expires quickly

STEP 3: Checking database persistence
✗ Cart not persisted to database for guests
✓ Cart persisted for authenticated users

ROOT CAUSE IDENTIFIED:
1. Session lifetime: 2 minutes (too short)
2. Guest carts not persisted to database
3. Session cookie expires on browser close

RECOMMENDED FIXES:

Option 1: Increase session lifetime (Quick fix)
  config/session.php:
  'lifetime' => 120 → 'lifetime' => 43200 // 30 days

Option 2: Persist guest carts to database (Better solution)
  - Store carts in 'carts' table with session_id
  - Retrieve cart on page load
  - Merge carts on login

Which option would you prefer? [1/2/Both]:
```

**You choose:** Both

**Claude Code:**
```
Implementing both solutions...

✓ Updated config/session.php (lifetime: 43200)
✓ Created migration: 2025_01_15_create_carts_table.php
✓ Created app/Models/Cart.php
✓ Updated app/Actions/Cart/AddToCartAction.php
✓ Created app/Actions/Cart/RetrieveCartAction.php
✓ Created app/Actions/Cart/MergeCartsAction.php

✓ Tests added:
  - tests/Feature/CartPersistenceTest.php
  - tests/Feature/CartMergeOnLoginTest.php

✓ All tests passing (100% coverage for cart logic)

Your absolute rule enforced:
- ✓ Tests written for all new cart logic
- ✓ Eloquent used instead of DB:: facade

Run: php artisan test --filter=Cart
```

---

## Example 2: SaaS Multi-Tenant Application

### Project Overview

**Name:** TeamCollab - Team Management SaaS
**Stage:** Growth (adding features)
**Team:** 4 developers
**Stack:** Laravel 12 + Livewire + PostgreSQL

### Key Wizard Answers

```
Architecture: Domain-Driven Design
Multi-tenant: Yes (separate databases per tenant)
Team size: 4-10 developers
Testing: TDD/BDD approach
Absolute rules:
- NEVER mix tenant data
- NEVER bypass tenant isolation middleware
- ALWAYS scope queries to current tenant
```

### Usage Example: Adding Tenant-Scoped Feature

**Command:**
```
/new-feature team-tasks
```

**Claude Code Response:**
```
Analyzing TeamCollab multi-tenant architecture...
Detected: DDD structure, tenant isolation middleware

⚠️ Applying tenant isolation rules automatically

Creating tenant-scoped team-tasks feature:

✓ Domain Layer
  - app/Domains/Tasks/Models/Task.php (with tenant scope)
  - app/Domains/Tasks/Actions/CreateTaskAction.php
  - app/Domains/Tasks/Actions/AssignTaskAction.php
  - app/Domains/Tasks/ValueObjects/TaskStatus.php

✓ Tenant Scoping
  - app/Domains/Tasks/Scopes/TenantScope.php
  - Applied globally to Task model

✓ Livewire Components
  - app/Http/Livewire/Tasks/TaskList.php
  - app/Http/Livewire/Tasks/TaskForm.php

✓ Tests (TDD approach - tests written first)
  - tests/Unit/Domains/Tasks/CreateTaskActionTest.php
  - tests/Feature/TenantIsolationTest.php ← Critical!

✓ Security validation:
  - ✓ Tenant scope applied to all queries
  - ✓ Middleware enforced on all routes
  - ✓ Tests verify cross-tenant data isolation

⚠️ CRITICAL TEST ADDED:
it('prevents accessing tasks from other tenants', function () {
    $tenant1 = Tenant::factory()->create();
    $tenant2 = Tenant::factory()->create();

    tenancy()->initialize($tenant1);
    $task1 = Task::factory()->create();

    tenancy()->initialize($tenant2);

    // ✓ Cannot see tenant1's task
    expect(Task::find($task1->id))->toBeNull();
});

Your absolute rules enforced:
✓ Tenant scoping on all queries
✓ Isolation middleware required
✓ Cross-tenant access prevented

Run: php artisan test --filter=Tenant
```

---

## Example 3: API-First Mobile Backend

### Project Overview

**Name:** FitTrack - Fitness Tracking API
**Stage:** Greenfield (starting fresh)
**Team:** Solo developer
**Stack:** Laravel 12 API + React Native

### Key Wizard Answers

```
Architecture: Service Layer pattern
Frontend: No (API only)
API versioning: Yes (v1, v2, etc.)
Testing: High coverage (80%+)
Absolute rules:
- ALWAYS version APIs
- NEVER break backward compatibility
- ALWAYS return consistent error formats
```

### Usage Example: Creating API Endpoint

**Command:**
```
/new-api POST /api/v1/workouts
```

**Claude Code Response:**
```
Analyzing FitTrack API structure...
Detected: API-first, versioned routes, service layer

Creating versioned API endpoint:

✓ Route
  - routes/api.php (v1 prefix applied)

✓ Controller
  - app/Http/Controllers/Api/V1/WorkoutController.php

✓ Service Layer
  - app/Services/WorkoutService.php

✓ Validation
  - app/Http/Requests/Api/V1/StoreWorkoutRequest.php

✓ API Resources (consistent format)
  - app/Http/Resources/Api/V1/WorkoutResource.php
  - app/Http/Resources/Api/V1/WorkoutCollection.php

✓ Error Handling (consistent format)
  - app/Exceptions/Api/V1/WorkoutNotFoundException.php
  - Custom error response format in Handler.php

✓ Tests
  - tests/Feature/Api/V1/WorkoutControllerTest.php
  - tests/Unit/Services/WorkoutServiceTest.php

✓ Documentation
  - OpenAPI spec updated: docs/api/v1/openapi.yaml

✓ Your rules enforced:
  - ✓ API versioned (/api/v1/)
  - ✓ Backward compatibility maintained
  - ✓ Consistent error format:
    {
      "error": {
        "code": "WORKOUT_NOT_FOUND",
        "message": "Workout not found",
        "status": 404
      }
    }

Run: php artisan test --filter=WorkoutController
```

**Generated Controller:**
```php
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreWorkoutRequest;
use App\Http\Resources\Api\V1\WorkoutResource;
use App\Services\WorkoutService;

final readonly class WorkoutController extends Controller
{
    public function __construct(
        private WorkoutService $workoutService
    ) {}

    public function store(StoreWorkoutRequest $request): WorkoutResource
    {
        $workout = $this->workoutService->create(
            user: $request->user(),
            data: $request->validated()
        );

        return new WorkoutResource($workout);
    }
}
```

---

## Example 4: Enterprise CRM System

### Project Overview

**Name:** SalesPro - Enterprise CRM
**Stage:** Refactoring (improving code)
**Team:** 10+ developers
**Stack:** Laravel 12 + Vue 3 + MySQL

### Key Wizard Answers

```
Architecture: Repository Pattern
Team: 10+ developers (mixed experience)
Methodology: Waterfall
Testing: Balanced coverage (60%)
Code style: Enterprise patterns
Absolute rules:
- ALWAYS use repositories for data access
- NEVER expose Eloquent models to frontend
- ALWAYS use DTOs for data transfer
```

### Usage Example: Refactoring Legacy Code

**Command:**
```
/optimize customer-search
```

**Claude Code Response:**
```
Analyzing SalesPro customer search performance...
Detected: N+1 query problem, missing indexes, no caching

🔍 Performance Analysis:

CURRENT IMPLEMENTATION:
- 1 query for customers
- 50 queries for related contacts (N+1 problem)
- 50 queries for related orders (N+1 problem)
- No database indexes on search columns
- No caching layer
- Total: ~10 seconds for 50 results

OPTIMIZATIONS RECOMMENDED:

1. Eager Loading (fixes N+1)
   Time saved: ~8 seconds

2. Database Indexes
   - customers.email (BTREE)
   - customers.company (FULLTEXT)
   Time saved: ~1.5 seconds

3. Redis Caching (5 min TTL)
   Time saved: ~9.5 seconds (cached requests)

4. Search Scope Optimization
   - Use FULLTEXT index for company search
   Time saved: ~0.3 seconds

IMPLEMENTING OPTIMIZATIONS:

✓ Updated app/Repositories/CustomerRepository.php
  - Added eager loading: ->with(['contacts', 'orders'])
  - Added search scope with FULLTEXT

✓ Created migration: add_search_indexes_to_customers.php
  - BTREE index on email
  - FULLTEXT index on company

✓ Added caching layer:
  - app/Services/CustomerSearchService.php
  - Redis cache with 5-minute TTL
  - Cache invalidation on customer update

✓ Tests:
  - tests/Unit/Services/CustomerSearchServiceTest.php
  - tests/Feature/CustomerSearchPerformanceTest.php

Your enterprise patterns enforced:
✓ Repository pattern maintained
✓ DTO used for search results
✓ No Eloquent models exposed to frontend

PERFORMANCE RESULTS:
Before: 10,234ms
After:  487ms (21x faster)

Cached: 12ms (852x faster)

Run: php artisan test --filter=CustomerSearch
```

---

## Example 5: Real-Time Collaboration Tool

### Project Overview

**Name:** DocCollab - Real-time Document Editor
**Stage:** MVP (ASAP timeline)
**Team:** 2-3 developers
**Stack:** Laravel 12 + Vue 3 + WebSockets + Redis

### Key Wizard Answers

```
Architecture: Event-driven + Actions
Features: Real-time updates, WebSockets
Communication: Pusher (WebSockets)
Testing: Balanced (60%)
Timeline: ASAP (need it yesterday)
Pain points: Frontend/Backend sync, Real-time updates
```

### Usage Example: Adding Real-Time Collaboration

**Command:**
```
/new-feature real-time-document-editing
```

**Claude Code Response:**
```
Analyzing DocCollab real-time requirements...
Detected: Pusher integration, event-driven architecture

Creating real-time document editing feature:

✓ Backend (Laravel)
  - app/Actions/Documents/UpdateDocumentAction.php
  - app/Events/DocumentUpdated.php (broadcasts to Pusher)
  - app/Listeners/BroadcastDocumentUpdate.php

✓ Pusher Configuration
  - config/broadcasting.php (Pusher configured)
  - .env.example (Pusher credentials template)

✓ Frontend (Vue 3)
  - resources/js/composables/useDocumentSync.js
  - resources/js/components/DocumentEditor.vue
  - Pusher Echo integration

✓ Conflict Resolution
  - app/Services/OperationalTransform/OTService.php
  - Handles concurrent edits

✓ Tests
  - tests/Feature/RealTimeDocumentUpdateTest.php
  - tests/Unit/Services/OTServiceTest.php

✓ WebSocket Events:
  - document.updated → broadcast to channel
  - user.typing → show typing indicator
  - user.cursor-moved → show cursor position

FRONTEND EXAMPLE:

```js
// resources/js/composables/useDocumentSync.js
import { ref, onMounted, onUnmounted } from 'vue';
import Echo from 'laravel-echo';

export function useDocumentSync(documentId) {
  const content = ref('');
  const activeUsers = ref([]);

  onMounted(() => {
    Echo.private(`document.${documentId}`)
      .listen('DocumentUpdated', (e) => {
        content.value = e.content;
      })
      .listenForWhisper('typing', (e) => {
        // Show typing indicator
      });
  });

  const updateDocument = async (newContent) => {
    await axios.post(`/api/documents/${documentId}`, {
      content: newContent
    });
  };

  return { content, activeUsers, updateDocument };
}
```

Your pain points addressed:
✓ Frontend/Backend sync (Pusher real-time)
✓ Conflict resolution (OT algorithm)
✓ Fast development (MVP features prioritized)

Run: php artisan test --filter=RealTime
npm run dev (to test WebSocket)
```

---

## Common Patterns Across All Examples

### Pattern 1: Consistent Structure

Every feature includes:
- ✅ Actions/Services (business logic)
- ✅ Validation (FormRequests)
- ✅ Controllers (thin)
- ✅ Tests (comprehensive)
- ✅ Documentation

### Pattern 2: Rule Enforcement

Claude Code automatically:
- ✅ Applies your absolute rules
- ✅ Prevents forbidden practices
- ✅ Follows architectural patterns
- ✅ Maintains consistency

### Pattern 3: Proactive Problem Solving

Claude Code:
- ✅ Identifies potential issues
- ✅ Suggests optimizations
- ✅ Warns about security concerns
- ✅ Prevents common mistakes

### Pattern 4: Test-First Approach

Every generated code includes:
- ✅ Unit tests for Actions/Services
- ✅ Feature tests for Controllers
- ✅ Integration tests for workflows
- ✅ Performance tests when needed

---

## Your Turn

**Try these commands in your project:**

1. `/new-feature [feature-name]` - Generate complete feature
2. `/fix-bug [description]` - Debug systematically
3. `/optimize [feature]` - Improve performance
4. `/new-api [endpoint]` - Create API endpoint

**Claude Code will:**
- Analyze your project structure
- Follow YOUR architecture
- Apply YOUR rules
- Generate tests automatically
- Maintain consistency

---

**Need more examples?**

Ask Claude Code:
- "Show me how to create a feature like [example]"
- "What would you generate for [use case]?"
- "How would you handle [scenario]?"
