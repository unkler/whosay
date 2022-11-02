## whosay

## ダウンロード方法

git clone 
git clone https://github.com/unkler/whosay.git

git clone ブランチを指定してダウンロードする場合
git clone -b ブランチ名 https://github.com/unkler/whosay.git

もしくはzipファイルでダウンロードしてください

## インストール方法

cd whosay
composer install
npm install
npm run dev

.env.example をコピーして .env ファイルを作成

.envファイルの中の下記をご利用の環境に合わせて変更してください。

XAMPP/MAMPまたは他の開発環境でDBを起動した後に

php artisan migrate:fresh --seed

と実行してください。(データベーステーブルとダミーデータが追加されればOK)

最後に
php artisan key:generate
と入力してキーを生成後、

php artisan serve
で簡易サーバーを立ち上げ、表示確認してください。

## インストール後の実施事項

画像のダミーデータは
public/imagesフォルダ内に
sample1.jpg 〜 sample6.jpg として
保存しています。

php artisan storage:link で
storageフォルダにリンク後、

storage/app/public/productsフォルダ内に
保存すると表示されます。
(productsフォルダがない場合は作成してください。)

ショップの画像も表示する場合は、
storage/app/public/shopsフォルダを作成し
画像を保存してください。

決済のテストとしてstripeを利用しています。
必要な場合は .env にstripeの情報を追記してください。

メールのテストとしてmailtrapを利用しています。
必要な場合は .env にmailtrapの情報を追記してください。

メール処理には時間がかかるので、
キューを使用しています。

必要な場合は php artisan queue:workで
ワーカーを立ち上げて動作確認するようにしてください。