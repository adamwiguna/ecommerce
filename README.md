PANDUAN INSTALASI

1. Copy .env.example menjadi .env

2. Setting informasi database .env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=notulen
   DB_USERNAME=root
   DB_PASSWORD=

3. Setting koneksi email pada .env untuk melakukan pengiriman email
   MAIL_MAILER=smtp
   MAIL_HOST=mailhog
   MAIL_PORT=1025
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS=null
   MAIL_FROM_NAME="${APP_NAME}"

4. Setelah .env siap, buka terminal dan masuk ke folder project ini dan lakukan perintah
   php artisan migrate:fresh --seed
   php artisan serve

5. Buka url http://127.0.0.1:8000 (default) setelah melakukan perintah diatas

6. Akses sebagai Admin user:admin password:admin

TENTANG APLIKASI

1. Back Office dengan fungsi untuk melakukan pengelolaan Category, Product dan Order
2. Akses masuk role Admin username: admin password: admin
3. Tersedia API untuk webpage Customer (Buka terminal, ketikkan perintah php artisan route:list --path=api)
