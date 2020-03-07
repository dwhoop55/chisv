# Installation
* git clone
* Adjust `memory_limit = 512M` in `/etc/php/x.y/fpm/php.ini` to enable auction to complete for larger conferences

# Running
* Run the laravel worker via pm2: pm2 start --cwd /var/www/chisv/ --name "chisv laravel queue worker" --interpreter /usr/bin/php --script="/var/www/chisv/artisan" --args="queue:work"
* Start nginx and php-fpm