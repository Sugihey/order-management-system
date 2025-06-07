<p align="center">
<h1>Order Management System</h1>
</p>

## このリポジトリについて
## HostingURL
[[https://sugihey.github.io/order-management-system/public/mock/index.html]]
## Artisan Login Screen
[[https://sugihey.github.io/order-management-system/public/mock/artisan_login.html]]

## Clone後のセットアップ
### Docker起動前の準備
プロジェクトフォルダに移動して以下のディレクトリがリポジトリに含まれない場合はコマンドを実行して作成。
```cmd
# ログファイルを格納するディレクトリを作る（Gitを使う場合はこの``logs``フォルダをignoreすべき）
> mkdir ./docker/nginx/logs

# MySQLで使用するディレクトリを作る（Gitを使う場合はこの``mysql``フォルダをignoreすべき）
> mkdir ./docker/mysql
```
### Dockerの起動
以下のコマンドでDockerを起動
```cmd
> docker compose up -d
```
localhost:80で開発サーバーが起動する

## appサーバーコンソールへのアクセス
```cmd
> docker compose exec l11dev-app bash
```
### .envファイルの作成
.env.sampleをコピーして.envファイルを作成
db接続の設定を以下の内容に変更
```
DB_CONNECTION=mysql
DB_HOST=l11dev-mysql
DB_PORT=3306
DB_DATABASE=l11dev
DB_USERNAME=root
DB_PASSWORD=root
```
.envをコピーして作成した場合はAPP_KEYが未定義なので、以下のコマンドでキーを生成する
```
php artisan key:generate
```
## storage/logsディレクトリへの書き込み権限付与
```bash
$ cd /src
$ chmod -R guo+w storage
```
## storageへのリンクを作成
```bash
$ php artisan storage:link
```
## 初期テーブルを生成
```bash
php artisan migrate
```
## Viteの起動
```bash
$ npm run dev
```

環境構築は以下のサイトを参考に行った
https://qiita.com/hitotch/items/2e816bc1423d00562dc2

## VSCodeでのDocker側phpインタープリタの指定方法
- DevContainer拡張をインストール
- \>DevContainer: Reopen in Container を実行
- リモート開発側でphpへのパスに /usr/local/bin/php を指定

## デバッグ
- PHP Debugをインストール
- F5でリッスンスタート

## Devin's URL
https://docker-compose-setup-app-tunnel-ctyoel0r.devinapps.com