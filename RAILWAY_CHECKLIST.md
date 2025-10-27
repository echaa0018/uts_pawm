# 🚨 CRITICAL: Before You Push to Railway

## 1. SET THESE ENVIRONMENT VARIABLES IN RAILWAY DASHBOARD

Go to your Railway project → Variables tab and set:

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-actual-railway-url.railway.app
ASSET_URL=https://your-actual-railway-url.railway.app
```

**Replace `your-actual-railway-url` with your real Railway domain!**

## 2. Push to Deploy

```bash
git push origin main
```

## 3. Watch the Railway Build Logs

Look for these SUCCESS indicators:
```
✅ npm run build
✅ public/build directory exists
✅ manifest.json exists
```

## 4. After Deployment - Verify CSS Loads

1. Open your Railway app URL
2. Press F12 → Network tab
3. Refresh page
4. You should see:
   - `manifest.json` (200 status)
   - `app-[hash].css` (200 status)
   - `app-[hash].js` (200 status)

## 5. If CSS Still Doesn't Load

### Check in Railway Terminal:

```bash
# Verify build directory exists
ls -la public/build

# Check manifest
cat public/build/manifest.json

# Manually rebuild if needed
npm run build

# Restart with cache clear
php artisan config:clear && php artisan config:cache
```

### Check Environment Variables:
- ✅ APP_ENV = production
- ✅ APP_URL matches your Railway domain
- ✅ ASSET_URL matches your Railway domain
- ✅ Both use https:// not http://

## Common Issues:

### "Vite manifest not found"
**Fix:** Assets didn't build. Check build logs, then run `npm run build` in Railway terminal.

### Network shows no CSS files at all
**Fix:** 
1. Verify APP_ENV=production
2. Verify ASSET_URL is set
3. Clear config: `php artisan config:clear`
4. Redeploy

### CSS files show 404
**Fix:** 
1. Check public/build exists
2. Run `npm run build`
3. Verify manifest.json exists

---

## ⚡ Quick Fix Command (in Railway Terminal):

```bash
npm run build && php artisan config:clear && php artisan config:cache && php artisan view:clear
```

Then restart your app in Railway.
