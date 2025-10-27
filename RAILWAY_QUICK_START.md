# Quick Railway Deployment Reference

## 🚀 Deploy to Railway in 5 Steps

### Step 1: Commit Deployment Files
```bash
git add .
git commit -m "Add Railway deployment configuration"
git push origin main  # if using GitHub
```

### Step 2: Create Railway Project
1. Go to [Railway.app](https://railway.app)
2. Sign in with GitHub
3. Click "New Project"
4. Select "Deploy from GitHub repo"
5. Choose your repository

### Step 3: Add PostgreSQL Database
1. In Railway project dashboard, click "+ New"
2. Select "Database" → "PostgreSQL"
3. Railway creates the database automatically

### Step 4: Configure Environment Variables

**Method A: Auto-link Database (Recommended)**
1. Go to your web service → "Variables"
2. Click "+ New Variable" → "Add Reference"
3. Select PostgreSQL service
4. Add these additional variables:

```
APP_NAME=YourAppName
APP_ENV=production
APP_KEY=  # Generate with: php artisan key:generate --show
APP_DEBUG=false
APP_URL=https://${{RAILWAY_PUBLIC_DOMAIN}}
DB_CONNECTION=pgsql
```

**Method B: Manual Configuration**
```
APP_NAME=YourAppName
APP_ENV=production
APP_KEY=  # Generate with: php artisan key:generate --show
APP_DEBUG=false
APP_URL=https://${{RAILWAY_PUBLIC_DOMAIN}}

DB_CONNECTION=pgsql
DB_HOST=${{Postgres.PGHOST}}
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database
LOG_LEVEL=error
```

### Step 5: Generate App Key & Run Migrations

After first deployment:

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login and link
railway login
railway link  # Select your project

# Generate application key
railway run php artisan key:generate --force

# Run migrations
railway run php artisan migrate --force

# Create storage link
railway run php artisan storage:link
```

## 📋 Post-Deployment Checklist

- [ ] App accessible at Railway URL
- [ ] Database migrations completed
- [ ] No errors in logs
- [ ] Test login/authentication
- [ ] Test key features

## 🔧 Common Commands

```bash
# View logs
railway logs

# Run artisan commands
railway run php artisan [command]

# Clear cache
railway run php artisan cache:clear
railway run php artisan config:clear

# Re-run migrations
railway run php artisan migrate:fresh --force
```

## 🐛 Troubleshooting

### Error: "No application encryption key"
```bash
railway run php artisan key:generate --force
```

### Database connection error
- Check PostgreSQL service is linked
- Verify environment variables are set correctly
- Check Railway logs for specific error

### 500 Error
```bash
# Check logs
railway logs

# Clear all cache
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear
```

## 📚 Full Documentation
See [RAILWAY_DEPLOYMENT.md](./RAILWAY_DEPLOYMENT.md) for complete guide.

## 🔗 Useful Links
- Railway Dashboard: https://railway.app/dashboard
- Railway Docs: https://docs.railway.app
- Laravel Deployment: https://laravel.com/docs/deployment
