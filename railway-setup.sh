#!/bin/bash

# Railway Deployment Quick Start Script
echo "🚂 Preparing Laravel Livewire Project for Railway Deployment"
echo "============================================================="

# Check if git is initialized
if [ ! -d .git ]; then
    echo "❌ Error: Git repository not initialized"
    echo "Run: git init"
    exit 1
fi

# Check if .env exists (should not be committed)
if [ -f .env ]; then
    echo "✅ .env file exists (will not be committed)"
else
    echo "⚠️  Warning: .env file not found"
fi

# Add files to git
echo ""
echo "📦 Adding deployment files to git..."
git add Procfile nixpacks.toml railway.json deploy.sh RAILWAY_DEPLOYMENT.md

# Show status
echo ""
echo "📊 Current git status:"
git status --short

echo ""
echo "✅ Deployment files ready!"
echo ""
echo "📝 Next steps:"
echo "1. Commit the changes:"
echo "   git commit -m 'Add Railway deployment configuration'"
echo ""
echo "2. Push to GitHub (if using):"
echo "   git push origin main"
echo ""
echo "3. Go to Railway (https://railway.app)"
echo "   - Create new project"
echo "   - Deploy from GitHub repo"
echo "   - Add PostgreSQL database"
echo "   - Configure environment variables"
echo ""
echo "4. Read RAILWAY_DEPLOYMENT.md for detailed instructions"
echo ""
