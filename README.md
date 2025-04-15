
## My News

```bash
git clone https://github.com/bakyyeva/mynews.git
cd news
composer install
cp .env.example .env
php artisan migrate --seed
php artisan serve
