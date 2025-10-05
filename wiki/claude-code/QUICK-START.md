# 🚀 Quick Start Guide

Get Claude Code configured for your Laravel project in **under 10 minutes**.

---

## Prerequisites

Before starting, ensure you have:

- ✅ Claude Code installed
- ✅ A Laravel project (this works with Laravel 11+ projects)
- ✅ Node.js and npm installed
- ✅ Basic familiarity with your project structure

---

## Step 1: Install Required MCPs (5 minutes)

MCPs (Model Context Protocol servers) extend Claude Code with specialized capabilities.

### Install Mandatory MCPs

```bash
# Install MCP CLI (if not already installed)
npm install -g @modelcontextprotocol/cli

# Install mandatory MCPs
npx @modelcontextprotocol/create-server context7
npx @modelcontextprotocol/create-server sequential-thinking
```

### Install Laravel-Specific MCP

```bash
# For Laravel projects (required)
npx @modelcontextprotocol/create-server laravel-boost
```

### Optional: Install Additional MCPs

```bash
# For Vue.js projects
npx @modelcontextprotocol/create-server vue-helper

# For documentation management
npx @modelcontextprotocol/create-server notion-api

# For E2E testing
npx @modelcontextprotocol/create-server playwright
```

### Verify Installation

After installation, restart Claude Code and verify MCPs are connected:

```
You can check MCP status by asking:
"Show me which MCPs are connected"

Expected response:
✅ context7 - Connected
✅ sequential-thinking - Connected
✅ laravel-boost - Connected
```

---

## Step 2: Run the Setup Wizard (3 minutes)

### Option A: Copy the Complete Setup Command

1. Open the setup command file:
   - Location: `.claude/commands/SETUP-PROJECT.md`

2. Copy the **entire content** of the file

3. Paste it into Claude Code

4. The wizard will start automatically

### Option B: Use the Slash Command (If available)

```bash
/setup-project
```

The wizard will guide you through:
- ✅ MCP verification
- ✅ Project detection
- ✅ Interactive questionnaire
- ✅ Configuration generation
- ✅ Verification

---

## Step 3: Answer Wizard Questions (2 minutes)

The wizard asks **10 simple questions** grouped into categories:

### 1️⃣ Project Discovery (30 seconds)

```
Q: What's your project name?
A: My E-commerce Platform

Q: What are you building?
A: An online store for handmade products

Q: Project stage?
A: 2 (MVP - initial version)

Q: Timeline?
A: 2 (1-3 months)
```

### 2️⃣ Team & Workflow (20 seconds)

```
Q: Team size?
A: 1 (Solo developer)

Q: Team experience?
A: 3 (Mostly seniors)

Q: Development methodology?
A: 2 (Agile/Scrum sprints)
```

### 3️⃣ Architecture Preferences (30 seconds)

```
Q: Backend architecture pattern?
A: 3 (Actions/Commands) [DETECTED]

Q: Frontend approach?
A: 3 (Composables/Hooks heavy) [DETECTED]

Q: Module communication?
A: 2 (Events only) [DETECTED]
```

### 4️⃣ Development Preferences (30 seconds)

```
Q: What slows you down most? (pick top 3)
A: 1,4,8 (Boilerplate code, Writing tests, Frontend/Backend sync)

Q: Error handling philosophy?
A: 4 (User-friendly messages)

Q: Testing strategy?
A: 4 (High coverage 80%+)
```

### 5️⃣ Business Features (20 seconds)

```
Q: Select critical features:
A: 1,2,3,6,8,9 (Auth, Payment, Email, Files, Admin, API)

Q: Expected scale?
A: 3 (1K-10K users)
```

### 6️⃣ Integrations (15 seconds)

```
Q: Payment providers?
A: 2 (Stripe)

Q: Communication services?
A: 1,5 (SendGrid, Pusher)

Q: Third-party services?
A: 3,4 (Social login, Analytics)
```

### 7️⃣ Code Style (10 seconds)

```
Q: Code style preference?
A: 3 (Clean code always)

Q: Database table naming?
A: 1 (snake_case plural)
```

### 8️⃣ AI Behavior (15 seconds)

```
Q: How should I explain things?
A: 2 (Balanced - code + key points)

Q: When you make mistakes?
A: 3 (Fix + teach why)

Q: Proactivity level?
A: 3 (Actively prevent problems)
```

### 9️⃣ Special Rules (15 seconds)

```
Q: Absolute rules?
Rule 1: NEVER use DB:: facade, always use Eloquent
Rule 2: NEVER skip tests
Type 'done': done

Q: Forbidden practices?
Forbidden 1: NEVER commit directly to main branch
Type 'done': done
```

### 🔟 Confirmation (5 seconds)

Review the generated configuration summary and confirm:

```
Proceed with generation? [Y/n]: Y
```

---

## Step 4: Verify Setup (1 minute)

After the wizard completes, verify everything works:

### Check Generated Files

```bash
ls -la .claude/

Expected output:
config.yml
guidelines.md
coding-standards.md
rules.md
project-context.md
agents/
  backend-architect.md
  testing-champion.md
  code-quality-enforcer.md
  performance-optimizer.md
  boilerplate-generator.md
  documentation-master.md
commands/
  new-feature.md
  new-action.md
  new-api.md
  fix-bug.md
  optimize.md
  quick-test.md
  document.md
validators/
  type-safety-check.sh
  test-coverage-check.sh
  clean-code-check.sh
  inline-style-check.sh
```

### Test a Command

Try your first slash command:

```bash
In Claude Code:
/quick-test

Expected behavior:
Claude Code will run your test suite and show results
```

---

## What Happens Next?

Once setup is complete, Claude Code becomes **project-aware**:

### ✅ It Knows Your Project

```
You: "Create a new product feature"

Claude Code:
[Analyzes your architecture]
[Detects Actions pattern]
[Uses your naming conventions]

Creating product feature with:
- CreateProductAction
- UpdateProductAction
- DeleteProductAction
- CreateProductRequest
- UpdateProductRequest
- ProductController
- ProductFactory
- Tests with 100% coverage
```

### ✅ It Follows Your Standards

```
You: "Add validation to the order form"

Claude Code:
[Uses FormRequest pattern]
[Follows your validation style]
[Includes custom error messages]
[Generates tests]
```

### ✅ It Prevents Mistakes

```
You: "Query all users from the database"

Claude Code:
⚠️ Validation Failed:
You asked me to use DB:: facade, but your rules state:
"NEVER use DB:: facade, always use Eloquent"

I'll use User::query()->get() instead.
```

### ✅ It Optimizes Your Workflow

```
You: "/new-feature checkout"

Claude Code:
[Creates complete checkout feature]
[Includes payment integration]
[Follows your architecture]
[Generates comprehensive tests]
[Documents the code]

✓ Feature ready in 2 minutes (vs 45 minutes manually)
```

---

## Common First Commands

### Create a New Feature

```bash
/new-feature [name]

Example:
/new-feature product-reviews
```

### Fix a Bug

```bash
/fix-bug [description]

Example:
/fix-bug Shopping cart items disappearing after refresh
```

### Generate API Endpoint

```bash
/new-api [endpoint]

Example:
/new-api GET /api/v1/products
```

### Run Tests

```bash
/quick-test [filter]

Example:
/quick-test Product
```

### Optimize Performance

```bash
/optimize [feature]

Example:
/optimize product listing query
```

### Generate Documentation

```bash
/document [target]

Example:
/document CreateOrderAction
```

---

## Quick Tips

### 💡 Ask for Explanations

```
You: "Why did you use an Action instead of a Controller?"

Claude Code:
Based on your architecture preferences (Actions pattern),
I'm creating single-responsibility Action classes for
business logic, keeping controllers thin. This matches
your existing codebase structure in app/Actions/.
```

### 💡 Request Modifications

```
You: "Make that API endpoint return paginated results"

Claude Code:
[Adds pagination]
[Updates tests]
[Follows your API resource pattern]
```

### 💡 Challenge Decisions

```
You: "Shouldn't we cache that query?"

Claude Code:
Great catch! Based on your expected scale (1K-10K users)
and your performance preferences, adding cache here makes
sense. Let me add Redis caching with a 1-hour TTL.
```

---

## Troubleshooting

### MCP Not Connected

```
Problem: laravel-boost shows as disconnected

Solution:
1. Restart Claude Code
2. If still failing, reinstall:
   npx @modelcontextprotocol/create-server laravel-boost
3. Check .mcp.json configuration
```

### Wizard Not Starting

```
Problem: Pasting setup command does nothing

Solution:
1. Ensure you copied the ENTIRE SETUP-PROJECT.md file
2. Try pasting in smaller chunks
3. Use /setup-project command if available
```

### Generated Code Doesn't Match Project

```
Problem: Claude generates MVC instead of Actions

Solution:
1. Re-run the wizard
2. Select option 3 (Actions pattern) in Q3.1
3. Check .claude/config.yml has correct architecture setting
```

### Commands Not Working

```
Problem: Slash commands like /new-feature not recognized

Solution:
1. Check .claude/commands/ directory exists
2. Restart Claude Code
3. Verify command files are .md format
```

---

## Next Steps

Now that setup is complete:

1. 📖 Read the [Complete Setup Guide](./SETUP-GUIDE.md) to understand how it works
2. ⚙️ Explore [Configuration Options](./CONFIGURATION.md) to customize further
3. 📋 Review [Rules & Guidelines](./RULES.md) to see what's enforced
4. 💡 Check [Real Project Examples](./EXAMPLES.md) for inspiration

---

## Get Help

- **Documentation:** Read the full [README](./README.md)
- **Troubleshooting:** See [Troubleshooting Guide](./TROUBLESHOOTING.md)
- **Issues:** Report on GitHub
- **Questions:** Ask in Claude Code

---

**You're all set! Start building with your AI-powered development assistant.**

🎉 Happy coding!
