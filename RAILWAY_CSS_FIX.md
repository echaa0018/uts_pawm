# Railway CSS Not Loading - Fix Guide

## Problem
CSS and JavaScript assets are not loading on Railway deployment, causing the website to look broken.

## Root Cause
Laravel uses Vite to compile assets. The compiled assets are stored in `public/build/` directory with a `manifest.json` file. When this manifest is missing or Laravel can't find it, NO CSS/JS files will load.

## Critical Fixes Applied

### 1. Updated `AppServiceProvider.php`
Forces Vite to use the production manifest file in production environment.

### 2. Updated `nixpacks.toml`
- Moved npm install to install phase
- Added verification commands to check if build succeeded
- Uses new `start.sh` script that verifies assets before starting

### 3. Created `start.sh`
Emergency startup script that:
- Verifies `public/build` exists
- Verifies `manifest.json` exists
- Rebuilds assets if missing
- Runs migrations and optimizations
- Starts the server

### 4. Added `ASSET_URL` to environment variables
Critical for production asset serving.

## CRITICAL: Railway Environment Variables

### ⚠️ MUST SET THESE IN RAILWAY:

```bash
APP_NAME=YourAppName
APP_ENV=production
APP_KEY=base64:your-generated-key-here
APP_DEBUG=false
APP_URL=https://your-actual-app.railway.app
ASSET_URL=https://your-actual-app.railway.app
```

**IMPORTANT:** 
- `APP_URL` and `ASSET_URL` MUST match your actual Railway domain
- MUST use `https://` not `http://`
- NO trailing slash

### Database (Railway PostgreSQL):
```bash
DB_CONNECTION=pgsql
DB_HOST=${{Postgres.PGHOST}}
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}
```

## Deployment Steps

### 1. Commit and Push Changes
```bash
git add .
git commit -m "Fix CSS deployment on Railway"
git push origin main
```

### 2. Redeploy on Railway
Railway will automatically trigger a new deployment when you push to main.

### 3. Verify Build Logs
In Railway dashboard:
1. Go to your project
2. Click on "Deployments"
3. Check the build logs for:
   - "Installing NPM dependencies..."
   - "Building assets..."
   - "✅ Build directory created successfully"

### 4. Check Environment Variables
Make sure `APP_URL` matches your Railway URL:
```bash
APP_URL=https://your-actual-subdomain.railway.app
```

## Troubleshooting

### Assets Still Not Loading?

1. **Clear all caches in Railway:**
   Run this command in Railway terminal:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

2. **Check if build directory exists:**
   ```bash
   ls -la public/build
   ```

3. **Manually rebuild assets:**
   ```bash
   npm install
   npm run build
   ```

4. **Verify APP_URL is correct:**
   - Should use HTTPS
   - Should match your Railway domain
   - No trailing slash

5. **Check build logs for errors:**
   - Look for npm errors
   - Look for Vite build errors

### Common Issues:

#### Issue: "Vite manifest not found"
**Solution:** Assets weren't built. Redeploy or run `npm run build` manually.

#### Issue: "Mixed content" errors
**Solution:** Make sure `APP_URL` uses `https://` not `http://`

#### Issue: 404 on CSS/JS files
**Solution:** 
- Verify `public/build` directory exists
- Check that `nixpacks.toml` includes build phase
- Ensure environment variables are set correctly

## Verification

After deployment, your compiled assets should be at:
```
https://your-app.railway.app/build/assets/app-[hash].css
https://your-app.railway.app/build/assets/app-[hash].js
```

Open browser DevTools (F12) → Network tab to verify assets are loading with 200 status.

## Notes

- The `public/build` directory is gitignored (as it should be)
- Assets are built fresh on each Railway deployment
- Build time may take 2-5 minutes depending on project size
- If builds fail, check Railway build logs for specific errors

## Quick Fix Command

If you need to manually rebuild everything in Railway terminal:
```bash
npm install && npm run build && php artisan config:cache && php artisan route:cache && php artisan view:cache
```
