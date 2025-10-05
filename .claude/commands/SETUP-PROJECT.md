# 🚀 SETUP PROJECT - Master Configuration Command

## COPY THIS ENTIRE COMMAND INTO CLAUDE CODE
```text
EXECUTE COMPLETE PROJECT SETUP

You are now my project configuration assistant. 
Execute these phases in order:

=================================================================
PHASE 1: MCP VERIFICATION & INSTALLATION
=================================================================

1.1 CHECK MCP STATUS:
    First, verify which MCPs are connected:
    - context7 (mandatory)
    - sequential-thinking (mandatory)  
    - memory-bank (mandatory)
    
    Show status like:
    ✅ context7 - Connected
    ❌ sequential-thinking - Not found
    ✅ memory-bank - Connected
    
1.2 DETECT PROJECT STACK:
    Check these files:
    - composer.json → PHP/Laravel version
    - package.json → Vue/React/Node version
    - requirements.txt → Python/Django
    - Gemfile → Ruby/Rails
    - go.mod → Go
    
    Detected stack determines required MCPs:
    - Laravel → need laravel-boost
    - Vue → need vue-helper
    - React → need react-helper
    - Testing framework → need playwright
    
1.3 SHOW MCP INSTALLATION:
    If any MCPs missing, display:
```bash
    === MISSING MCPs - Install these first ===
    
    # Step 1: Install MCP CLI (if needed)
    npm install -g @modelcontextprotocol/cli
    
    # Step 2: Install mandatory MCPs
    npx @modelcontextprotocol/create-server context7
    npx @modelcontextprotocol/create-server sequential-thinking
    npx @modelcontextprotocol/create-server memory-bank
    
    # Step 3: Install stack-specific MCPs
    [Show based on detected stack]
    
    # For Laravel:
    npx @modelcontextprotocol/create-server laravel-boost
    
    # For Vue:
    npx @modelcontextprotocol/create-server vue-helper
    
    # For Vue + Shadcn:
    claude mcp add shadcn -- bunx -y @jpisnice/shadcn-ui-mcp-server \
      --framework vue \
      --github-api-key YOUR_GITHUB_TOKEN
Then ask: "Have you installed the missing MCPs? [Y/n]: _"

If N: "Please install MCPs first, then run this command again."
If Y: Continue to Phase 2
=================================================================
PHASE 2: PROJECT ANALYSIS & DETECTION
2.1 CHECK EXISTING CONFIGURATION:
Look for .claude/ directory
If exists:
    === EXISTING CONFIGURATION FOUND ===
    Created: [date]
    Last updated: [date]
    
    Options:
    1. Use existing configuration
    2. Update configuration (keep as defaults)
    3. Start fresh (delete and recreate)
    
    Choose [1-3]: _
2.2 AUTO-DETECT PROJECT INFO:
While waiting for response, analyze:
    Scanning project structure...
    ✓ Found 16 modules (modular architecture)
    ✓ Found Actions pattern in use
    ✓ Found Event-driven communication
    ✓ Found Repository pattern
    ✓ Found 127 tests (Pest framework)
    ✓ Found API resources pattern
    ✓ Found Vue Composition API
    ✓ Found Pinia stores
=================================================================
PHASE 3: INTERACTIVE SETUP WIZARD
Now I'll ask you questions to perfectly configure Claude Code.
=====================================
STEP 1 OF 10: PROJECT DISCOVERY
Q1.1: What's your project name?

[Wait for answer]

Q1.2: What are you building? (one sentence)

[Wait for answer]

Q1.3: What's the project stage?

Greenfield (starting fresh)
MVP (initial version)
Growth (adding features)
Refactoring (improving code)
Maintenance (bugs & small features)

Your choice [1-5]: _
Q1.4: Timeline/Urgency?

ASAP - Need it yesterday
1-3 months (normal pace)
3-6 months (complex project)
6+ months (enterprise)
No deadline (learning/personal)

Your choice [1-5]: _
=====================================
STEP 2 OF 10: TEAM & WORKFLOW
Q2.1: Team size?

Solo developer
2-3 developers
4-10 developers
10+ developers

Your choice [1-4]: _
Q2.2: Team experience level?

Mostly juniors (need guidance)
Mixed experience levels
Mostly seniors (want flexibility)

Your choice [1-3]: _
Q2.3: Development methodology?

Move fast, fix later
Agile/Scrum sprints
Kanban flow
Waterfall
No formal process

Your choice [1-5]: _
=====================================
STEP 3 OF 10: ARCHITECTURE PREFERENCES
Q3.1: Backend architecture pattern?

Simple MVC (fast development)
Repository Pattern (abstraction)
Actions/Commands (single responsibility) [DETECTED IN YOUR CODE]
Domain-Driven Design (complex logic)
Service Layer (business separation)
Let me suggest based on project

Your choice [1-6]: _
Q3.2: Frontend approach?

Simple components (prop drilling ok)
Smart/Dumb component split
Composables/Hooks heavy [DETECTED IN YOUR CODE]
Heavy state management
Let me suggest

Your choice [1-5]: _
Q3.3: Module communication?

Direct calls (simple, coupled)
Events only (decoupled) [DETECTED IN YOUR CODE]
Service contracts
Message queue (async)
Mixed approach

Your choice [1-5]: _
=====================================
STEP 4 OF 10: DEVELOPMENT PREFERENCES
Q4.1: What slows you down most? (pick top 3)
[ ] Writing boilerplate code
[ ] Setting up new features
[ ] Finding & fixing bugs
[ ] Writing tests
[ ] Documentation
[ ] Database design
[ ] API integration
[ ] Frontend/Backend sync
[ ] Performance optimization
[ ] DevOps/Deployment
Enter numbers (e.g., 1,3,5): _
Q4.2: Error handling philosophy?

Fail fast and loud
Try to recover gracefully
Log everything, show little
User-friendly messages
Depends on context

Your choice [1-5]: _
Q4.3: Testing strategy?

No tests (YOLO mode)
Critical paths only (20%)
Balanced coverage (60%)
High coverage (80%+)
TDD/BDD approach

Your choice [1-5]: _
=====================================
STEP 5 OF 10: BUSINESS FEATURES
Q5.1: Select ALL critical features for your project:
[ ] User authentication & roles
[ ] Payment processing
[ ] Email notifications
[ ] SMS notifications
[ ] Real-time updates (WebSockets)
[ ] File uploads/media
[ ] Search functionality
[ ] Admin dashboard
[ ] API for third-parties
[ ] Multi-language support
[ ] Analytics & reporting
[ ] Inventory management
[ ] Multi-tenant architecture
Select (e.g., 1,2,5,8): _
Q5.2: Expected scale?

< 100 users
100-1K users
1K-10K users
10K-100K users
100K+ users
Millions (need serious scale)

Your choice [1-6]: _
=====================================
STEP 6 OF 10: INTEGRATIONS
Q6.1: Payment providers needed?
[ ] None
[ ] Stripe
[ ] PayPal
[ ] Square
[ ] Local provider: ______
[ ] Cryptocurrency
Select all that apply: _
Q6.2: Communication services?
[ ] None
[ ] SendGrid (email)
[ ] Mailgun (email)
[ ] AWS SES (email)
[ ] Twilio (SMS)
[ ] Pusher (websockets)
[ ] Firebase (push)
Select all that apply: _
Q6.3: Third-party services?
[ ] None
[ ] AWS services
[ ] Google Cloud
[ ] Social login (OAuth)
[ ] Analytics (GA4/Mixpanel)
[ ] Maps/Location services
[ ] AI services (OpenAI/Claude)
Select all that apply: _
=====================================
STEP 7 OF 10: CODE STYLE & STANDARDS
Q7.1: Code style preference?

Quick & dirty (refactor later)
Balanced (good enough)
Clean code always
Enterprise patterns

Your choice [1-4]: _
Q7.2: Naming conventions?
Database tables:

snake_case plural (user_profiles)
snake_case singular (user_profile)
PascalCase (UserProfiles)
Whatever exists already

Your choice [1-4]: _
=====================================
STEP 8 OF 10: AI BEHAVIOR
Q8.1: How should I explain things?

Brief - just the code
Balanced - code + key points
Detailed - full explanations
Teacher mode - explain everything

Your choice [1-4]: _
Q8.2: When you make mistakes, I should?

Just fix it
Fix + brief explanation
Fix + teach you why
Fix + create validator to prevent

Your choice [1-4]: _
Q8.3: Proactivity level?

Only do what you ask
Suggest obvious improvements
Actively prevent problems
Challenge bad practices

Your choice [1-4]: _
=====================================
STEP 9 OF 10: SPECIAL RULES
Q9.1: Any ABSOLUTE RULES for your project?
(Type each rule and press Enter, type 'done' when finished)
Example: "NEVER use jQuery"
Rule 1: _
Rule 2: _
Rule 3: _
Type 'done': _
Q9.2: Any FORBIDDEN practices?
(Type each and press Enter, type 'done' when finished)
Example: "NEVER commit directly to main"
Forbidden 1: _
Forbidden 2: _
Type 'done': _
=====================================
STEP 10 OF 10: CONFIRMATION
Based on your answers, I will create:
📁 CONFIGURATION FILES:
✓ .claude/config.yml - Main configuration
✓ .claude/rules.md - Your project rules
✓ .claude/mcp-status.json - MCP tracking
🤖 SPECIALIZED AGENTS ([X] files):
✓ [agent-1] based on [your stack]
✓ [agent-2] based on [your patterns]
✓ [agent-3] based on [your needs]
[List all agents to be created]
📝 CUSTOM COMMANDS ([Y] files):
✓ [command-1] for [your workflow]
✓ [command-2] for [your pain points]
[List all commands]
✅ VALIDATORS ([Z] files):
✓ [validator-1] for [your standards]
✓ [validator-2] for [your rules]
[List all validators]
🎯 OPTIMIZATIONS FOR YOUR PAIN POINTS:
→ [Pain point 1]: [Solution]
→ [Pain point 2]: [Solution]
→ [Pain point 3]: [Solution]
Proceed with generation? [Y/n]: _
=================================================================
PHASE 4: CONFIGURATION GENERATION
[After confirmation]
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
[Show each file as created]
=================================================================
PHASE 5: FINAL SETUP & VERIFICATION
Testing configuration...
✓ All MCPs responding
✓ Agents loaded successfully
✓ Commands ready to use
✓ Validators executable
=================================================================
🎉 SETUP COMPLETE!
Your project is now perfectly configured for:

[Your stack summary]
[Your architecture]
[Your workflow]

You can now use these commands:

CRUD [Model] in [Module]
Example: CRUD Product in Catalog
FIX BUG: [description]
Example: FIX BUG: Cart items disappearing
ANALYZE: [component]
Example: ANALYZE: Checkout flow
OPTIMIZE: [feature]
Example: OPTIMIZE: Product listing query

First recommended action based on your project:

[Specific suggestion based on answers]

Type HELP for all available commands.
Happy coding! 🚀
