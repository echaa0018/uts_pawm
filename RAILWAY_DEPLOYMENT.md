# Railway Deployment Guide for Laravel Livewire + PostgreSQL

## Prerequisites
- A Railway account (https://railway.app)
- Git installed and project initialized as a git repository
- GitHub/GitLab account (optional, for automatic deployments)

## Deployment Steps

### 1. Prepare Your Project

Make sure all Railway deployment files are committed:
```bash
git add .
git commit -m "Add Railway deployment configuration"
```

### 2. Create a Railway Project

1. Go to https://railway.app and sign in
2. Click "New Project"
3. Choose one of these options:
   - **Deploy from GitHub repo** (recommended for automatic deployments)
   - **Deploy from local repo** (manual deployments)

### 3. Add PostgreSQL Database

1. In your Railway project dashboard, click "+ New"
2. Select "Database" → "PostgreSQL"
3. Railway will automatically create a PostgreSQL instance
4. The database credentials will be available as environment variables

### 4. Configure Environment Variables

In your Railway service settings, add these environment variables:

**Required:**
- `APP_NAME` = Your App Name
- `APP_ENV` = production
- `APP_KEY` = (generate with: php artisan key:generate --show)
- `APP_DEBUG` = false
- `APP_URL` = https://your-app.railway.app (will be provided by Railway)

**Database (will be auto-populated from PostgreSQL service):**
- `DB_CONNECTION` = pgsql
- `DB_HOST` = ${PGHOST}
- `DB_PORT` = ${PGPORT}
- `DB_DATABASE` = ${PGDATABASE}
- `DB_USERNAME` = ${PGUSER}
- `DB_PASSWORD` = ${PGPASSWORD}

**Session & Cache:**
- `SESSION_DRIVER` = file
- `CACHE_STORE` = file
- `QUEUE_CONNECTION` = database

**Optional:**
- `LOG_CHANNEL` = stack
- `LOG_LEVEL` = error
- `MAIL_MAILER` = log (or configure your mail service)

### 5. Link Database to Web Service

1. Go to your web service settings
2. Click on "Variables" tab
3. Click "+ New Variable" → "Add reference"
4. Select your PostgreSQL service
5. This will automatically inject database credentials

### 6. Deploy

If deploying from GitHub:
- Push your code to GitHub
- Railway will automatically build and deploy

If deploying manually:
```bash
railway login
railway link
railway up
```

### 7. Run Migrations

After deployment, run migrations:

**Option A: Using Railway CLI**
```bash
railway run php artisan migrate --force
```

**Option B: Using Railway Dashboard**
1. Go to your service
2. Click "Settings" → "Deployments"
3. Find the latest deployment
4. Click the three dots → "View Logs"
5. You can run commands from the terminal

### 8. Generate Application Key (if not set)

```bash
railway run php artisan key:generate --force
```

### 9. Create Storage Link

```bash
railway run php artisan storage:link
```

### 10. Seed Database (optional)

```bash
railway run php artisan db:seed --force
```

## Important Notes

1. **File Storage**: Railway has ephemeral filesystem. For persistent file storage, use:
   - AWS S3
   - Cloudinary
   - Railway Volumes (for persistent storage)

2. **Environment Variables**: Never commit `.env` file to git. Always use Railway's environment variable settings.

3. **Database Backups**: Set up regular backups for your PostgreSQL database in Railway.

4. **Logs**: View logs in Railway dashboard under your service → "Deployments" → "View Logs"

5. **Custom Domain**: Add your custom domain in Railway under "Settings" → "Domains"

## Troubleshooting

### Application Key Error
```bash
railway run php artisan key:generate --force
```

### Migration Errors
```bash
railway run php artisan migrate:fresh --force
# Or rollback and re-run
railway run php artisan migrate:rollback --force
railway run php artisan migrate --force
```

### Clear Cache
```bash
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear
```

### Permission Issues
Make sure these directories are writable:
- storage/
- bootstrap/cache/

## Post-Deployment Checklist

- [ ] Application accessible at Railway URL
- [ ] Database connected and migrations run
- [ ] Application key generated
- [ ] Storage link created
- [ ] Environment variables configured correctly
- [ ] No errors in deployment logs
- [ ] Test all major features
- [ ] Configure custom domain (if needed)
- [ ] Set up database backups
- [ ] Configure mail service (if needed)

## Useful Railway CLI Commands

```bash
# Login to Railway
railway login

# Link to existing project
railway link

# Deploy
railway up

# Run commands
railway run [command]

# View logs
railway logs

# Open dashboard
railway open

# View environment variables
railway variables
```

## Resources

- Railway Docs: https://docs.railway.app
- Laravel Deployment: https://laravel.com/docs/deployment
- Railway Discord: https://discord.gg/railway
