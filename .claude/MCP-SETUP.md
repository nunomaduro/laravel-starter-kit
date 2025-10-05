# 🔌 MCP INSTALLATION GUIDE - Essential Claude Code Extensions

## ⚠️ MANDATORY MCPs (ALL PROJECTS)

These 3 MCPs are REQUIRED for Claude Code to work properly:

### 1. CONTEXT7 - Code Analysis & Understanding
```bashInstall command
npx @modelcontextprotocol/create-server context7What it does:

Analyzes code structure
Finds dependencies
Maps module relationships
Traces function calls


### 2. SEQUENTIAL-THINKING - Problem Decomposition
```bashInstall command
npx @modelcontextprotocol/create-server sequential-thinkingWhat it does:

Breaks complex problems into steps
Plans implementations
Analyzes risks
Optimizes solutions


### 3. MEMORY-BANK - Pattern Memory & Learning
```bashInstall command
npx @modelcontextprotocol/create-server memory-bankWhat it does:

Stores patterns and solutions
Recalls previous implementations
Learns from your codebase
Prevents repeated mistakes


## 🛠️ STACK-SPECIFIC MCPs

### FOR LARAVEL PROJECTS
```bash4. LARAVEL-BOOST - Laravel Specific Tools
npx @modelcontextprotocol/create-server laravel-boostFeatures:

Artisan command integration
Migration generator
Model relationship mapping
Route analyzer
Eloquent query optimizer


### FOR VUE.JS PROJECTS
```bash5. VUE-HELPER - Vue.js Development Tools
npx @modelcontextprotocol/create-server vue-helperFor Vue with Shadcn UI:
claude mcp add shadcn -- bunx -y @jpisnice/shadcn-ui-mcp-server 
--framework vue 
--github-api-key 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Features:

Component generation
Composables creation
Store management
Props validation


### FOR TESTING
```bash6. PLAYWRIGHT - E2E Testing Automation
npx @modelcontextprotocol/create-server playwrightFeatures:

E2E test generation
Visual regression testing
Cross-browser testing


### FOR DOCUMENTATION
```bash7. NOTION-API - Documentation Management
npx @modelcontextprotocol/create-server notion-apiFeatures:

Auto-generate docs
Sync with Notion
API documentation


## 🚀 QUICK INSTALLATION SCRIPT

### For Laravel + Vue Project (Most Common)
```bash#!/bin/bash
Save as: install-mcps.shecho "🔌 Installing Essential MCPs for Claude Code..."Mandatory MCPs
echo "📦 Installing context7..."
npx @modelcontextprotocol/create-server context7echo "📦 Installing sequential-thinking..."
npx @modelcontextprotocol/create-server sequential-thinkingecho "📦 Installing memory-bank..."
npx @modelcontextprotocol/create-server memory-bankLaravel specific
echo "📦 Installing laravel-boost..."
npx @modelcontextprotocol/create-server laravel-boostVue specific
echo "📦 Installing vue-helper..."
npx @modelcontextprotocol/create-server vue-helperTesting
echo "📦 Installing playwright..."
npx @modelcontextprotocol/create-server playwrightDocumentation
echo "📦 Installing notion-api..."
npx @modelcontextprotocol/create-server notion-apiecho "✅ All MCPs installed successfully!"
echo "🚀 You can now start Claude Code with full capabilities!"

## 📋 VERIFICATION CHECKLIST

After installation, verify MCPs are working:
```bashIn Claude Code, run:
VERIFY MCP CONNECTIONSExpected response:
✅ context7 - Connected
✅ sequential-thinking - Connected
✅ memory-bank - Connected
✅ laravel-boost - Connected
✅ vue-helper - Connected
✅ playwright - Connected
✅ notion-api - ConnectedTotal: 7 MCPs active

## 🔧 CONFIGURATION FILE

### `.claude/mcp-config.json`
```json{
"required_mcps": {
"mandatory": [
"context7",
"sequential-thinking",
"memory-bank"
],
"laravel": [
"laravel-boost"
],
"vue": [
"vue-helper"
],
"testing": [
"playwright"
],
"documentation": [
"notion-api"
]
},
"installation_commands": {
"context7": "npx @modelcontextprotocol/create-server context7",
"sequential-thinking": "npx @modelcontextprotocol/create-server sequential-thinking",
"memory-bank": "npx @modelcontextprotocol/create-server memory-bank",
"laravel-boost": "npx @modelcontextprotocol/create-server laravel-boost",
"vue-helper": "npx @modelcontextprotocol/create-server vue-helper",
"shadcn-vue": "claude mcp add shadcn -- bunx -y @jpisnice/shadcn-ui-mcp-server --framework vue --github-api-key [TOKEN]",
"playwright": "npx @modelcontextprotocol/create-server playwright",
"notion-api": "npx @modelcontextprotocol/create-server notion-api"
}
}

## 🎯 PROJECT-SPECIFIC MCP DETECTION
```bashDETECT AND INSTALL REQUIRED MCPs=== ANALYZING PROJECT ===Detected Stack:
✓ Laravel 11.35
✓ Vue 3.4.35
✓ PostgreSQL
✓ Pest TestingRequired MCPs for your project:

✅ context7 (mandatory)
✅ sequential-thinking (mandatory)
✅ memory-bank (mandatory)
⚠️ laravel-boost (not installed)
⚠️ vue-helper (not installed)
Would you like to install missing MCPs? [Y/n]Installation commands:
npm install -g @modelcontextprotocol/cli
npx @modelcontextprotocol/create-server laravel-boost
npx @modelcontextprotocol/create-server vue-helperAfter installation, restart Claude Code.
