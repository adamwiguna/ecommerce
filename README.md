PANDUAN INSTALASI

1. Copy .env.example menjadi .env

2. Setting informasi database .env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=notulen
   DB_USERNAME=root
   DB_PASSWORD=

3. Setelah .env siap, buka terminal dan masuk ke folder project ini dan lakukan perintah
   php artisan migrate:fresh --seed
   php artisan serve

4. Buka url http://127.0.0.1:8000 (default) setelah melakukan perintah diatas

5. Akses sebagai Admin user:admin password:admin

TENTANG APLIKASI

1. Back Office dengan fungsi untuk melakukan pengelolaan Category, Product dan Order
