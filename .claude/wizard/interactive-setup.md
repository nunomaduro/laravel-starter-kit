# 🧙 INTERACTIVE SETUP WIZARD - Complete Project Configuration System

## FILE: .claude/wizard/interactive-setup.md
## PURPOSE: Master wizard for intelligent project configuration
## USAGE: Run this when starting ANY new project with Claude Code

## 🚀 INITIALIZATION COMMAND
```bash
RUN INTERACTIVE SETUP WIZARD

Starting Claude Code Configuration Wizard v2.0
================================================
This wizard will create a PERFECT development environment 
tailored specifically for YOUR project.

Time needed: ~5 minutes
Time saved: ~100 hours of development

Press ENTER to start or 'skip' for quick setup...
📋 WIZARD STRUCTURE
STEP 1: PROJECT DISCOVERY
bash===============================================
STEP 1/10: PROJECT DISCOVERY
===============================================

Let's understand what you're building.

Q1.1: What's the project name?
> [Your answer: e.g., "Marketplace CRM"]

Q1.2: Describe your project in one sentence:
> [Your answer: e.g., "Multi-vendor marketplace for digital products"]

Q1.3: What's the main problem this solves?
> [Your answer: e.g., "Connects vendors with customers efficiently"]

Q1.4: Is this a:
  1. New project (greenfield)
  2. Existing project (needs configuration)
  3. Migration from another system
  4. Refactor of legacy code
  
Choose [1-4]: _

Q1.5: What's your deadline/timeline?
  1. ASAP - Need MVP quickly
  2. 1-3 months - Standard development
  3. 3-6 months - Complex project
  4. 6+ months - Enterprise project
  5. No deadline - Personal/Learning
  
Choose [1-5]: _
STEP 2: TECHNICAL STACK DETECTION
bash===============================================
STEP 2/10: ANALYZING YOUR STACK
===============================================

[AUTO-DETECTING FROM FILES...]

Found: composer.json ✓
→ PHP 8.4 with Laravel 11.35

Found: package.json ✓
→ Vue 3.4.35 with Vuetify 3.6.13

Found: docker-compose.yml ✓
→ PostgreSQL 15 + Redis

Found: Modules/ directory ✓
→ Modular architecture detected

Is this correct? [Y/n]: _

Want to add anything?
  [ ] GraphQL
  [ ] WebSockets
  [ ] Elasticsearch
  [ ] Message Queue (RabbitMQ/Kafka)
  [ ] Other: _______
STEP 3: ARCHITECTURE PREFERENCES
bash===============================================
STEP 3/10: ARCHITECTURE & PATTERNS
===============================================

Q3.1: Backend Architecture Pattern?
  
  1. 🎯 Simple MVC
     → Quick development, less abstraction
     
  2. 📦 Repository Pattern  
     → Database abstraction layer
     
  3. 🎭 Actions/Commands Pattern [RECOMMENDED]
     → Single responsibility, testable
     
  4. 🏛️ Domain-Driven Design
     → Complex business logic
     
  5. 🔧 Service Layer
     → Business logic separation
     
  6. 🤖 Let me analyze and recommend

Choose [1-6]: _

Q3.2: API Design?
  1. REST API (traditional)
  2. GraphQL (flexible queries)
  3. JSON-RPC (simple)
  4. gRPC (performance)
  5. Mixed approach
  
Choose [1-5]: _

Q3.3: How should modules communicate?
  1. Direct calls (simple, coupled)
  2. Events only (decoupled) [RECOMMENDED]
  3. Service contracts (interfaces)
  4. Message queue (async)
  5. Mixed based on context
  
Choose [1-5]: _
STEP 4: TEAM & WORKFLOW
bash===============================================
STEP 4/10: TEAM & WORKFLOW
===============================================

Q4.1: Team composition?
  1. 👤 Solo developer
  2. 👥 2-3 developers  
  3. 👨‍👩‍👦 4-10 developers
  4. 🏢 10+ developers
  
Choose [1-4]: _

Q4.2: Team experience level?
  1. 🌱 Mostly juniors (need guidance)
  2. 🌿 Mixed experience [MOST COMMON]
  3. 🌳 Mostly seniors (want flexibility)
  4. 🎓 Learning project
  
Choose [1-4]: _

Q4.3: Development methodology?
  1. ⚡ Move fast, break things
  2. 🔄 Agile/Scrum sprints
  3. 📋 Kanban flow
  4. 🏔️ Waterfall (planned phases)
  5. 🎨 No formal process
  
Choose [1-5]: _

Q4.4: Code review process?
  1. No reviews (YOLO)
  2. Informal reviews
  3. PR required for main
  4. Strict reviews + approval
  5. Pair/Mob programming
  
Choose [1-5]: _
STEP 5: BUSINESS REQUIREMENTS
bash===============================================
STEP 5/10: BUSINESS REQUIREMENTS  
===============================================

Q5.1: Select ALL critical features:
  [ ] 🔐 Authentication (login/register)
  [ ] 👥 User roles & permissions
  [ ] 💳 Payment processing
  [ ] 📧 Email notifications
  [ ] 📱 SMS notifications
  [ ] 🔔 Push notifications
  [ ] 📊 Analytics & reporting
  [ ] 🔍 Advanced search
  [ ] 💬 Real-time chat
  [ ] 📁 File uploads
  [ ] 🌍 Multi-language
  [ ] 🏪 Multi-tenant
  [ ] 📦 Inventory management
  [ ] 🚚 Shipping integration
  [ ] 📈 Admin dashboard
  [ ] 🔄 API for third-parties
  [ ] 📱 Mobile app API
  [ ] 🤖 AI/ML features
  
Selected: _

Q5.2: Expected user scale?
  1. 📱 < 100 users
  2. 💼 100-1K users
  3. 🏢 1K-10K users
  4. 🌆 10K-100K users
  5. 🌍 100K+ users
  6. 🚀 Millions (need serious scale)
  
Choose [1-6]: _

Q5.3: Data sensitivity?
  1. 📖 Public data only
  2. 📝 Basic personal info
  3. 💳 Financial data (PCI)
  4. 🏥 Health data (HIPAA)
  5. 🔐 Government (high security)
  6. 🎮 Not sensitive
  
Choose [1-6]: _
STEP 6: DEVELOPMENT PREFERENCES
bash===============================================
STEP 6/10: YOUR DEVELOPMENT STYLE
===============================================

Q6.1: What slows you down most? (Pick top 3)
  [ ] Writing boilerplate code
  [ ] Setting up new features
  [ ] Finding bugs
  [ ] Writing tests
  [ ] Documentation
  [ ] Database design
  [ ] API integration
  [ ] Frontend/Backend sync
  [ ] Performance optimization
  [ ] DevOps/Deployment
  [ ] Code reviews
  
Your top 3: _

Q6.2: How do you prefer to handle errors?
  1. 💥 Fail fast & loud
  2. 🦺 Try to recover gracefully
  3. 📝 Log everything, show little
  4. 😊 User-friendly messages
  5. 🔍 Depends on environment
  
Choose [1-5]: _

Q6.3: Testing philosophy?
  1. 🚫 No tests (YOLO)
  2. 🎯 Critical paths only
  3. ⚖️ Balanced coverage (60%)
  4. 🛡️ High coverage (80%+)
  5. 💯 TDD/BDD everything
  
Choose [1-5]: _

Q6.4: Documentation preference?
  1. 📭 No docs, code is documentation
  2. 📝 Inline comments only
  3. 📚 README + inline
  4. 📖 Full documentation
  5. 🎓 Documentation-first
  
Choose [1-5]: _
STEP 7: AI BEHAVIOR CUSTOMIZATION
bash===============================================
STEP 7/10: HOW SHOULD CLAUDE CODE BEHAVE?
===============================================

Q7.1: Explanation style?
  1. ⚡ Brief - Just give me code
  2. 💬 Balanced - Code + key points
  3. 📖 Detailed - Full explanations
  4. 🎓 Teacher - Explain everything
  
Choose [1-4]: _

Q7.2: When you make mistakes?
  1. 🔧 Just fix it silently
  2. 💭 Fix + brief explanation
  3. 📚 Fix + teach me
  4. 🛡️ Fix + prevent future
  
Choose [1-4]: _

Q7.3: Proactivity level?
  1. 🤐 Only do what I ask
  2. 💡 Suggest when obvious
  3. 🚨 Warn about problems
  4. 🚀 Actively improve code
  5. 👨‍🏫 Challenge bad practices
  
Choose [1-5]: _

Q7.4: Code generation style?
  1. ⚡ Quick & dirty (refactor later)
  2. ⚖️ Balanced (good enough)
  3. 💎 Clean code always
  4. 🏗️ Enterprise patterns
  
Choose [1-4]: _
STEP 8: CONSTRAINTS & RULES
bash===============================================
STEP 8/10: CONSTRAINTS & SPECIAL RULES
===============================================

Q8.1: Any ABSOLUTE RULES? (Type 'done' when finished)
  
Example: "NEVER use jQuery", "ALWAYS use transactions"

Rule 1: > _
Rule 2: > _
Rule 3: > _
> done

Q8.2: Any FORBIDDEN practices?
  
Example: "NEVER commit directly to main"

Forbidden 1: > _
Forbidden 2: > _
> done

Q8.3: Preferred naming conventions?

Database tables:
  1. snake_case (user_profiles)
  2. PascalCase (UserProfiles)
  3. camelCase (userProfiles)
  4. plural (users)
  5. singular (user)
  
Choose [1-5]: _

Variables/Functions:
  1. camelCase (JavaScript standard)
  2. snake_case (Python/Ruby)
  3. PascalCase (C#)
  4. kebab-case (URLs/CSS)
  
Choose [1-4]: _
STEP 9: INTEGRATION REQUIREMENTS
bash===============================================
STEP 9/10: EXTERNAL INTEGRATIONS
===============================================

Q9.1: Payment providers? (Select all)
  [ ] Stripe
  [ ] PayPal
  [ ] Square
  [ ] Razorpay
  [ ] MercadoPago
  [ ] Custom bank
  [ ] Crypto
  [ ] None
  Other: _

Q9.2: Communication services?
  [ ] SendGrid (email)
  [ ] Twilio (SMS)
  [ ] Mailgun
  [ ] AWS SES
  [ ] Firebase (push)
  [ ] Slack
  [ ] Discord
  [ ] None
  Other: _

Q9.3: Cloud services?
  [ ] AWS
  [ ] Google Cloud
  [ ] Azure
  [ ] DigitalOcean
  [ ] Vercel
  [ ] Netlify
  [ ] Cloudflare
  [ ] None/On-premise
  Other: _

Q9.4: Third-party APIs?
  [ ] Google Maps
  [ ] Social login (OAuth)
  [ ] Analytics (GA4/Mixpanel)
  [ ] CRM (Salesforce/HubSpot)
  [ ] ERP integration
  [ ] Shipping (FedEx/UPS)
  [ ] AI/ML (OpenAI/Claude)
  Other: _
STEP 10: FINAL CONFIRMATION
bash===============================================
STEP 10/10: CONFIGURATION SUMMARY
===============================================

Based on your answers, I will create:

📁 CONFIGURATION FILES:
  ✓ .claude/config.yml (main configuration)
  ✓ .claude/rules.md (your specific rules)
  ✓ .claude/patterns.md (code patterns)

🤖 SPECIALIZED AGENTS (7 total):
  ✓ backend-specialist.md (Laravel expert)
  ✓ frontend-specialist.md (Vue/Vuetify)
  ✓ payment-handler.md (Stripe/PayPal)
  ✓ testing-guardian.md (Pest/Vitest)
  ✓ performance-optimizer.md (caching/queries)
  ✓ security-auditor.md (OWASP/PCI)
  ✓ bug-hunter.md (debugging)

📝 CUSTOM COMMANDS (12 total):
  ✓ crud-generator.md (your style)
  ✓ api-endpoint.md (REST pattern)
  ✓ payment-flow.md (complete flow)
  ✓ test-suite.md (auto tests)
  ✓ performance-check.md
  ✓ security-audit.md
  ✓ migration-helper.md
  ✓ component-builder.md
  ✓ form-generator.md
  ✓ report-builder.md
  ✓ integration-setup.md
  ✓ deployment-helper.md

✅ VALIDATORS (8 total):
  ✓ code-style.sh
  ✓ security-check.sh
  ✓ performance-baseline.sh
  ✓ module-boundaries.sh
  ✓ api-contracts.sh
  ✓ database-integrity.sh
  ✓ test-coverage.sh
  ✓ pre-commit.sh

🎯 PROJECT-SPECIFIC OPTIMIZATIONS:
  → Boilerplate elimination (your pain point)
  → Auto-sync frontend/backend types
  → Debug wizard for complex bugs
  → Payment flow automation
  → Performance monitoring

Proceed with generation? [Y/n]: _

Would you like to:
  1. Generate everything now
  2. Review configuration first
  3. Adjust some answers
  4. Save and continue later
  
Choose [1-4]: _
🎯 OUTPUT: GENERATED MASTER CONFIG
.claude/wizard-output/project-config.yml
yaml# Generated by Interactive Setup Wizard
# Date: 2024-XX-XX
# Version: 2.0

wizard_metadata:
  completion_time: "5 minutes 32 seconds"
  questions_answered: 47
  confidence_level: 95%
  
project:
  name: "Marketplace CRM"
  description: "Multi-vendor marketplace for digital products"
  stage: "MVP"
  timeline: "3 months"
  
team:
  size: 3
  experience: "mixed"
  methodology: "agile"
  
architecture:
  backend: "actions_pattern"
  frontend: "composition_api"
  communication: "event_driven"
  api: "rest"
  
preferences:
  error_handling: "user_friendly"
  testing: "critical_paths"
  documentation: "balanced"
  code_style: "quick_refactor_later"
  
ai_behavior:
  explanation: "balanced"
  proactivity: "suggest_improvements"
  error_response: "fix_and_explain"
  
integrations:
  payment: ["stripe", "paypal"]
  communication: ["sendgrid", "twilio"]
  cloud: ["aws"]
  
rules:
  always:
    - "Use database transactions for payments"
    - "Log all critical operations"
    - "Validate user input"
  never:
    - "Direct module communication"
    - "Store sensitive data in logs"
    - "Skip error handling"
    
generated_files:
  agents: 7
  commands: 12
  validators: 8
  patterns: 15
  
estimated_time_savings:
  boilerplate_reduction: "70%"
  bug_prevention: "60%"
  development_speed: "3x"
🚀 POST-WIZARD INITIALIZATION
bash=== WIZARD COMPLETE ===

Your project is now perfectly configured!

To start development, use:

1. For new features:
   > CRUD [Model] in [Module]

2. For debugging:
   > BUG FIX: [description]

3. For analysis:
   > ANALYZE: [component]

All commands are customized for YOUR project.

First recommended action:
> TEST CONFIGURATION WITH SAMPLE CRUD

Happy coding! 🚀
