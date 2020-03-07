# Installation
## Linux
```
apt update
apt install -y git curl wget zip unzip
```
## MySQL
We are using a MariaDB on an remote server.
You may however use any backend you like.
## Web server
Basic setup of nginx+php
### Nginx
```
apt update
apt install nginx
```
We publish our application in a local environment and have it proxied/loadbalanced via a central HAProxy/Nginx which will also put a certificate on it. Our backend has the application in a shielded environment which is why we publish plain http:
```
server {
        listen 80 default_server;
        listen [::]:80 default_server;

        root /var/www/chisv/public;

        add_header X-Frame-Options "SAMEORIGIN";
        add_header X-XSS-Protection "1; mode=block";
        add_header X-Content-Type-Options "nosniff";

        index index.html index.htm index.php;

        charset utf-8;

        location / {
                try_files $uri $uri/ /index.php?$query_string;
        }

        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }

        error_page 404 /index.php;

        location ~ \.php$ {
                fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
                include fastcgi_params;
        }

        location ~ /\.(?!well-known).* {
                deny all;
        }

}
```
### PHP-FPM and Related Modules
```
apt install  apt install php-fpm php-common php-mbstring php-xmlrpc php-soap php-gd php-xml php-mysql php-cli php-mcrypt php-zip php-intl
```
Edit `/etc/php/x.y/fpm/php.ini`
```
memory_limit = 512M
upload_max_filesize = 64M
cgi.fix_pathinfo=0
```

### Composer to Download Laravel
`curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer`

## Laravel
* Drop into your local user which runs the web server process: `su - www-data`
* git clone to `/var/www/chisv`
* Create your `.env` file as `/var/www/chisv/.env`
* Compile javascript and prepare PHP:

```
cd /var/www/chisv
php artisan down --message "Install in progress.. Check back in a few minutes"


npm install
npm run prod

composer install
php artisan migrate:fresh --seed
php artisan passport:install

php artisan up
```

## Supervisor Configuration
[See Laravel documentation](https://laravel.com/docs/6.x/queues#supervisor-configuration)
Ensure you are root for the below
### Installing Supervisor
* `apt-get install supervisor`

### Configuring Supervisor
* Edit `/etc/supervisor/conf.d/laravel-worker.conf` to look like this
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/chisv/artisan queue:work database --sleep=3 --memory=512 --timeout=600 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=8
redirect_stderr=true
stdout_logfile=/var/log/nginx/laravel-worker.log
stopwaitsecs=3600
```

### Starting Supervisor
```
supervisorctl reread
supervisorctl update
supervisorctl start laravel-worker:*
```

# Running
* Start nginx and php-fpm
```
systemctl restart nginx
systemctl restart php7.2-fpm
```


# Update
```
cd /var/www/chisv

git fetch
git pull

php artisan down --message "Upgrade progress.. Check back in a few minutes"

composer update
composer install

npm install
npm outdated
npm update
npm run prod

php artisan migrate
php artisan up

supervisorctl restart laravel-worker:*
```