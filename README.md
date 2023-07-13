# introduce

<h5>task vhi-web di build menggunakan framework laravel versi 10 dengan versi php 8.1>= dan versi composer 2.5.8, jadi pastikan versi php yang anda gunakan sudah sesuai</h5>

<h5>
aktifkan require module php yang dibutukan untuk menjalankan framework tersebut, beberapa modul yang di harus di aktifkan ialah pdo_mysqli, mysqli, xml  dan mbstring, zip, curl dan sodium
</h5>

```bash
#berikut list lengkap dari module php yang digunakan
[PHP Modules]
calendar
Core
ctype
curl
date
dom
exif
FFI
fileinfo
filter
ftp
gettext
hash
iconv
json
libxml
mbstring
mysqli
mysqlnd
openssl
pcntl
pcre
PDO
pdo_mysql
Phar
posix
random
readline
Reflection
session
shmop
SimpleXML
sockets
sodium
SPL
standard
sysvmsg
sysvsem
sysvshm
tokenizer
xml
xmlreader
xmlwriter
xsl
Zend OPcache
zlib

[Zend Modules]
Zend OPcache


```

# composer run

```Bash
composer install
```

# Start Local Development Server API(laravel) RedComm

```Bash
php -S localhost:8000 -t public || php artisan serve
```

# migrate table db, menjalankan seed dan link storage

```Bash
#migrate datanya
php artisan migrate
# jalankan sedder
php artisan db:seed

# jika ingin rollback table nya jalan kan perintah di bawah ini(optional)
php artisan migrate:rollback || php artisan migrate:refresh (jika ingin merubah struktur field)

```

# Endpoint Auth API dan Profile (jika ingin menggunakan fitur AUTH)

```Bash
#baseUrl
localhost:8000 -> sesuaikan dengan base url kalian

#Login
{{base_url}}/login ->POST
#register
{{base_url}}/register ->POST
#logout
{{base_url}}/logout ->POST
#profile dan update profile
{{base_url}}/home/profile ->POST

```

# unit test notes crud

```bash
php artisan test
```
