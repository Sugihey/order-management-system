<p align="center">
<h1>Order Management System</h1>
</p>

## このリポジトリについて

環境構築は以下のサイトを参考に行った
https://qiita.com/hitotch/items/2e816bc1423d00562dc2

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
$ docker compose exec l11dev-app bash
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
