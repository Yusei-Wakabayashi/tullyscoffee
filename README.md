#  起動順序

ローカル環境のnpmとnodeのバージョンを確認する
node20以上とnpm10以上のバージョンであることを確認
nodeとnpmが存在しない場合はインストールしてくる
バージョンが古い場合はnodeは公式サイトから新しいインストーラで持ってくる
npmはnpm install axios@latestで新しいバージョンをインストール
npm run buildで構築

ローカルのpackage.jsonと同じディレクトリ内でnpm install,npm update,npm run build,npm run devを実行
あとはdockerの構築
dockerは
docker compose buildで構築
docker compose up -dで起動
docker exec -it app-ecsitesimulater bashでappコンテナにログイン
composer.jsonと同じディレクトリに移動
composer install
cp .env.example .envで.envファイルを作成
php artisan key:generateで鍵の作成
php artisan migrateとphp artisan db:seedでdatabaseの作成

テスト用サーバーをnpm run devで起動