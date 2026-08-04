#!/usr/bin/env bash
set -euo pipefail

: "${DEPLOY_PATH:?DEPLOY_PATH is required}"
: "${DEPLOY_BRANCH:?DEPLOY_BRANCH is required}"

cd "$DEPLOY_PATH"

site_is_down=0
restore_site() {
    if [ "$site_is_down" -eq 1 ]; then
        php artisan up || true
    fi
}
trap restore_site EXIT

echo "Deploying branch: $DEPLOY_BRANCH"
git fetch origin "$DEPLOY_BRANCH"
git pull origin "$DEPLOY_BRANCH"

composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

if [ -f package-lock.json ]; then
    npm ci
else
    npm install
fi

npm run build

php artisan down || true
site_is_down=1
php artisan migrate --force
php artisan storage:link || true
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache || true
php artisan queue:restart || true
php artisan up
site_is_down=0

chmod -R ug+rw storage bootstrap/cache

echo "Deployment complete."
