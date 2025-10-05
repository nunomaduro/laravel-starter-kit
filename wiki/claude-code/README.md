# 🤖 Claude Code Super Wizard Setup

Welcome to the **Claude Code Super Wizard Setup** - a comprehensive system designed to configure Claude Code perfectly for your Laravel projects. This intelligent setup system analyzes your project, detects your stack, and creates a tailored configuration that maximizes your development productivity.

## 📚 Documentation Index

1. [Overview](#overview)
2. [What's Included](#whats-included)
3. [How It Works](#how-it-works)
4. [Quick Start Guide](./QUICK-START.md)
5. [Complete Setup Guide](./SETUP-GUIDE.md)
6. [Configuration Reference](./CONFIGURATION.md)
7. [Rules & Guidelines](./RULES.md)
8. [MCP Integration](./MCP-GUIDE.md)
9. [Real Project Examples](./EXAMPLES.md)
10. [Troubleshooting](./TROUBLESHOOTING.md)

---

## Overview

The Claude Code Super Wizard is an **interactive setup system** that transforms Claude Code into a project-specific AI assistant. Instead of generic responses, you get intelligent assistance tailored to:

- ✅ Your exact Laravel version and packages
- ✅ Your architectural patterns (Actions, Repositories, DDD, etc.)
- ✅ Your team's coding standards and preferences
- ✅ Your specific pain points and workflows
- ✅ Your testing strategy and quality requirements

### Why Use This Setup?

**Without setup:**
- Claude Code gives generic Laravel advice
- Doesn't know your project structure
- Can't follow your team's conventions
- Might suggest outdated patterns
- Requires constant manual corrections

**With this setup:**
- Claude Code becomes a **project expert**
- Understands your exact architecture
- Follows YOUR coding standards automatically
- Uses version-specific features correctly
- Provides context-aware suggestions

---

## What's Included

The setup system creates a complete `.claude/` configuration directory with:

### 1. Core Configuration Files

| File | Purpose |
|------|---------|
| `config.yml` | Main project configuration and metadata |
| `guidelines.md` | Laravel Boost curated guidelines for Laravel 12 |
| `coding-standards.md` | Project-specific coding conventions |
| `rules.md` | Custom rules and forbidden practices |
| `project-context.md` | Auto-detected project information |

### 2. Specialized Agents

Intelligent sub-agents that handle specific development tasks:

| Agent | Specialization |
|-------|----------------|
| `backend-architect.md` | Laravel architecture, design patterns, database design |
| `testing-champion.md` | Pest testing, test generation, coverage optimization |
| `code-quality-enforcer.md` | PHPStan, Pint, Rector, quality standards |
| `performance-optimizer.md` | Query optimization, caching, scaling |
| `boilerplate-generator.md` | CRUD generation, scaffolding, repetitive tasks |
| `documentation-master.md` | PHPDoc, API docs, architecture documentation |

### 3. Custom Commands

Slash commands for common workflows:

| Command | What It Does |
|---------|--------------|
| `/new-feature [name]` | Scaffolds complete feature with tests |
| `/new-action [name]` | Creates Action class with validation |
| `/new-api [endpoint]` | Generates API endpoint with resources |
| `/fix-bug [description]` | Analyzes and fixes bugs systematically |
| `/optimize [feature]` | Identifies and resolves performance issues |
| `/quick-test [filter]` | Runs targeted tests with coverage |
| `/document [target]` | Generates comprehensive documentation |

### 4. Validators (Hooks)

Automated quality checks that run before tool execution:

| Validator | Checks |
|-----------|--------|
| `type-safety-check.sh` | Enforces 100% type coverage |
| `test-coverage-check.sh` | Validates test coverage requirements |
| `clean-code-check.sh` | Prevents code smells and anti-patterns |
| `inline-style-check.sh` | Blocks inline styles in components |

### 5. MCP Integration

**MCP (Model Context Protocol)** servers provide specialized capabilities:

| MCP Server | Capability |
|------------|------------|
| `laravel-boost` | Laravel-specific tools, Artisan integration, documentation search |
| `context7` | Code analysis, dependency mapping, module relationships |
| `sequential-thinking` | Problem decomposition, implementation planning |
| `herd` | Local service management (MySQL, Redis, etc.) |
| `notion-api` | Documentation synchronization |

---

## How It Works

The setup process follows a **5-phase interactive wizard**:

### Phase 1: MCP Verification & Installation

1. **Checks installed MCPs** - Verifies required MCP servers are available
2. **Detects project stack** - Analyzes `composer.json`, `package.json` to determine technology stack
3. **Shows installation commands** - Provides exact commands for missing MCPs
4. **Waits for confirmation** - Ensures MCPs are installed before continuing

**Example Output:**
```
=== MCP STATUS ===
✅ context7 - Connected
✅ sequential-thinking - Connected
❌ laravel-boost - Not found
✅ herd - Connected

Missing MCPs detected. Install with:
npx @modelcontextprotocol/create-server laravel-boost

Have you installed the missing MCPs? [Y/n]:
```

### Phase 2: Project Analysis & Detection

1. **Scans existing configuration** - Checks if `.claude/` directory exists
2. **Auto-detects project patterns** - Identifies:
   - Architectural patterns (Actions, Repositories, Services)
   - Module structure
   - Testing framework and coverage
   - Frontend framework (Vue, React, Livewire)
   - API patterns
   - Event-driven architecture

**Example Output:**
```
Scanning project structure...
✓ Found 16 modules (modular architecture)
✓ Found Actions pattern in use
✓ Found Event-driven communication
✓ Found Repository pattern
✓ Found 127 tests (Pest framework)
✓ Found API resources pattern
✓ Found Vue Composition API
✓ Found Pinia stores
```

### Phase 3: Interactive Setup Wizard

**10-step questionnaire** that gathers:

1. **Project Discovery** - Name, purpose, stage, timeline
2. **Team & Workflow** - Team size, experience level, methodology
3. **Architecture Preferences** - Backend pattern, frontend approach, module communication
4. **Development Preferences** - Pain points, error handling, testing strategy
5. **Business Features** - Critical features, expected scale
6. **Integrations** - Payment providers, communication services, third-party APIs
7. **Code Style & Standards** - Code quality level, naming conventions
8. **AI Behavior** - Explanation depth, proactivity level, error handling
9. **Special Rules** - Absolute rules, forbidden practices
10. **Confirmation** - Review and approve generated configuration

**Example Questions:**
```
Q3.1: Backend architecture pattern?

1. Simple MVC (fast development)
2. Repository Pattern (abstraction)
3. Actions/Commands (single responsibility) [DETECTED IN YOUR CODE]
4. Domain-Driven Design (complex logic)
5. Service Layer (business separation)
6. Let me suggest based on project

Your choice [1-6]: 3

Q4.1: What slows you down most? (pick top 3)
[ ] Writing boilerplate code
[ ] Setting up new features
[x] Finding & fixing bugs
[x] Writing tests
[ ] Documentation
[x] Database design
[ ] API integration
[ ] Frontend/Backend sync
[ ] Performance optimization
[ ] DevOps/Deployment

Enter numbers (e.g., 1,3,5): 3,4,6
```

### Phase 4: Configuration Generation

Based on your answers, the wizard creates:

1. **Configuration files** with your preferences
2. **Specialized agents** tailored to your stack
3. **Custom commands** for your workflows
4. **Validators** enforcing your standards
5. **Optimizations** targeting your pain points

**Example Output:**
```
Creating your configuration...
✓ Created .claude/config.yml
✓ Created .claude/rules.md
✓ Created .claude/agents/backend-specialist.md
✓ Created .claude/agents/frontend-specialist.md
✓ Created .claude/agents/testing-expert.md
✓ Created .claude/commands/crud-generator.md
✓ Created .claude/commands/api-endpoint.md
✓ Created .claude/validators/code-style.sh
✓ Created .claude/validators/module-check.sh
```

### Phase 5: Final Setup & Verification

1. **Tests configuration** - Validates all files are correct
2. **Verifies MCPs** - Ensures all MCPs are responsive
3. **Loads agents** - Confirms specialized agents are available
4. **Prepares commands** - Makes slash commands ready to use
5. **Provides next steps** - Recommends first action based on your project

**Example Output:**
```
Testing configuration...
✓ All MCPs responding
✓ Agents loaded successfully
✓ Commands ready to use
✓ Validators executable

🎉 SETUP COMPLETE!

Your project is now perfectly configured for:
- Laravel 12 with Actions pattern
- Pest 4 testing with 100% coverage
- Vue 3 Composition API
- Event-driven architecture

You can now use these commands:
- /new-feature [name] - Scaffold complete feature
- /fix-bug [description] - Systematic bug fixing
- /optimize [feature] - Performance analysis

First recommended action: Run /quick-test to verify everything works
```

---

## Key Features

### 🎯 Smart Detection

The wizard **automatically detects**:
- Laravel version and installed packages
- Architectural patterns from your codebase
- Testing framework and coverage
- Frontend framework and libraries
- Existing code conventions

### 🧠 Context-Aware Intelligence

Once configured, Claude Code **knows**:
- Your exact package versions (uses Laravel 12 features, not Laravel 10)
- Your preferred patterns (suggests Actions, not Controllers)
- Your coding standards (enforces your conventions)
- Your team's experience (adjusts explanation depth)
- Your pain points (proactively prevents issues)

### ⚡ Workflow Optimization

The setup creates **custom workflows** for:
- Feature scaffolding matching YOUR structure
- Bug fixing following YOUR debugging process
- Testing with YOUR coverage requirements
- Documentation in YOUR preferred format

### 🛡️ Quality Enforcement

Validators automatically:
- Block type safety violations
- Enforce test coverage minimums
- Prevent code smells
- Check architectural rules

### 📖 Version-Specific Documentation

The `laravel-boost` MCP provides:
- Documentation for YOUR installed package versions
- No outdated Laravel 8 examples when you're using Laravel 12
- Tailwind 4 syntax (not deprecated v3 utilities)
- Pest 4 browser testing (not old Dusk examples)

---

## What Makes This Different?

### Traditional AI Code Assistants

```
You: "Create a new feature for managing products"

AI: "Sure! Here's a basic controller with CRUD methods..."
[Generates generic MVC code]
[Doesn't match your architecture]
[Misses your validation patterns]
[No tests included]
```

### With Claude Code Super Wizard

```
You: "/new-feature product-management"

Claude Code:
[Analyzes your codebase]
[Detects Actions pattern]
[Follows your naming conventions]

Creating product management feature...

✓ Created app/Actions/Products/CreateProductAction.php
✓ Created app/Http/Requests/CreateProductRequest.php
✓ Created app/Http/Controllers/ProductController.php
✓ Created tests/Unit/Actions/Products/CreateProductActionTest.php
✓ Created tests/Feature/Http/ProductControllerTest.php
✓ Created database/factories/ProductFactory.php
✓ All files follow YOUR conventions
✓ Tests achieve 100% coverage
✓ Type safety enforced

Run: php artisan test --filter=Product
```

---

## Real-World Benefits

### Before Setup

❌ Claude suggests outdated patterns
❌ Generates code that doesn't match your structure
❌ You spend time fixing AI-generated code
❌ Need to specify conventions every time
❌ Tests are an afterthought

### After Setup

✅ Claude becomes a **project expert**
✅ Code matches your architecture perfectly
✅ Tests generated automatically with features
✅ Conventions followed automatically
✅ Proactive quality enforcement
✅ Version-specific documentation

### Time Savings

**Example: Adding a new feature**

- **Without setup:** 45 minutes (code + fixing + testing + adjusting)
- **With setup:** 10 minutes (code generated correctly, tests included)
- **Savings:** 35 minutes per feature

**Example: Debugging a bug**

- **Without setup:** 2 hours (manual investigation, trial and error)
- **With setup:** 30 minutes (systematic analysis, targeted fixes)
- **Savings:** 90 minutes per bug

**Example: Writing tests**

- **Without setup:** 1 hour (writing from scratch, ensuring coverage)
- **With setup:** 15 minutes (tests auto-generated with feature)
- **Savings:** 45 minutes per test suite

---

## Next Steps

### First Time Setup

1. Read the [Quick Start Guide](./QUICK-START.md)
2. Install required MCPs from [MCP Guide](./MCP-GUIDE.md)
3. Run the setup wizard
4. Try your first command

### Understanding the System

1. Review [How It Works](./SETUP-GUIDE.md)
2. Learn about [Configuration Options](./CONFIGURATION.md)
3. Explore [Available Rules](./RULES.md)

### Using in Real Projects

1. Check [Real Project Examples](./EXAMPLES.md)
2. Customize your [Configuration](./CONFIGURATION.md)
3. Add project-specific rules

### Troubleshooting

Having issues? See the [Troubleshooting Guide](./TROUBLESHOOTING.md)

---

## Community & Support

- **GitHub Issues:** Report bugs or request features
- **Discussions:** Share your setup configurations
- **Examples:** Contribute real-world usage examples

---

## License

This setup system is part of the Laravel Starter Kit and is available under the MIT license.

---

**Ready to supercharge your Laravel development with Claude Code?**

👉 [Start with the Quick Start Guide](./QUICK-START.md)
