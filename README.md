# 模擬案件\_フリマアプリ

##環境構築
**Docker ビルド**

1. 'git@github.com:nanami-dimm/mogi1.git'
2. DockerDesktop を立ち上げる。
3. コンテナの作成　'docker-compose up -d --build'

**laravel 環境構築**

1. php コンテナへアクセス
   'docker-compose exec php bash'
2. 'composer install'

3. .env ファイルの作成
   php コンテナ内にて
   'cp .env.example .env'

4. .env に以下の環境変数を追加

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成
   php コンテナ内にて
   'php artisan key:generate'

6. マイグレーションの実行
   PHP コンテナ内にて
   'php artisan migrate'

7. シーティングの実行
   PHP コンテナ内にて
   'php artisan db:seed'

##使用技術(実行環境)
-PHP7.4.9
-laravel8.83.27
-mysql8.0.26

##ER 図
mogi1.drawio.png に記載

##URL -開発環境 -商品一覧画面(トップ画面): http://localhost/ -会員登録画面: http://localhost/register -プロフィール画面: http//localhost/mypage
-phpMyadmin: http://localhost:8080/
