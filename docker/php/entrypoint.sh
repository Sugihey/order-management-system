#!/bin/sh

cd /src

# Composerインストール
if [ -f "composer.json" ]; then
  echo "Running composer install..."
  composer install || echo "Composer failed"
fi

# npmインストール
if [ -f "package.json" ]; then
  echo "Running npm install..."
  npm install || echo "NPM failed"
fi

# 並列でVite起動（バックグラウンド）
npm run dev &

# php-fpm を起動して常駐
echo "Starting php-fpm..."
exec php-fpm
