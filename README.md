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

MAIL_FROM_ADDRESS=no-reply@example.com
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

8. 画像の表示
   PHPコンテナ内にて
   'php artisan storage:link'

##使用技術(実行環境)
-PHP8.3.9
-laravel8.83.27
-mysql8.0.26

##ER 図
mogi1.drawio.png に記載

##URL -開発環境 -商品一覧画面(トップ画面): http://localhost/ -会員登録画面: http://localhost/register -プロフィール画面: http//localhost/mypage
-phpMyadmin: http://localhost:8080/

## 商品を取引、チャットの利用をするとき

1. **商品一覧画面** から商品を押下する  
    商品一覧画面　(http://localhost/)

2. **商品詳細画面** が開き、購入手続きの下部に「出品者にチャットを送る」ボタンを押下する  
    商品詳細画面　(http://localhost/item/{item_id})

## ダミーユーザー

### CO01~CO05 出品者
- **名前**: 碇シンジ  
- **メールアドレス**: ikarisinji@test.com  
- **パスワード**: sinji1234  
- **郵便番号**: 123-4567  
- **住所**: 第3新東京市芦ノ湖沿い  
- **建物**: NERV職員宿舎A棟

### CO06~CO10 出品者
- **名前**: 渚カヲル  
- **メールアドレス**: nagisakaworu@test.com  
- **パスワード**: kaworu3456  
- **郵便番号**: 234-5678  
- **住所**: 月面基地タブハベース  
- **建物**: 第5使徒監視区画

### 出品商品なし
- **名前**: 碇ゲンドウ  
- **メールアドレス**: ikarigendou@test.com  
- **パスワード**: gendou7890  
- **郵便番号**: 345-6789  
- **住所**: ネルフ本部地下深部  
- **建物**: 司令室

##取引中商品のダミーデータ
■ 商品名：マイク  
　出品者：渚カヲル  
　購入者：碇シンジ  

■ 商品名：ショルダーバッグ  
　出品者：渚カヲル  
　購入者：碇シンジ  

■ 商品名：革靴  
　出品者：碇シンジ
　購入者：碇ゲンドウ  
