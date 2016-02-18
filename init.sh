#!/bin/bash

echo "CREATING CONTAINER MySQL (Mariabd)"
docker run \
-d \
-e MYSQL_ROOT_PASSWORD=root \
-p 3306:3306 \
-i \
--name xhprof_mysql \
mariadb
echo
echo

echo "CREATING CONTAINER (Redis)"
docker run \
-d \
-p 6379:6379 \
-i \
--name xhprof_redis \
redis
echo
echo


echo "CREATING CONTAINER (PHP)"
docker run \
-d \
-p 9000:9000 \
-i \
-t \
--name xhprof_php \
-v $(pwd)/src/public:/usr/share/nginx/html \
-w /usr/share/nginx/html \
--link xhprof_redis:redis \
--link xhprof_mysql:mysql \
drpain/xhprof:latest \
/bin/bash -c "php-fpm"
echo

echo "CREATING CONTAINER (NGINX)"
echo "Vhosts directory: $(pwd)/images/nginx/vhosts"
docker run \
-d \
--privileged=true \
-p 80:80 \
-p 443:443 \
--name xhprof_nginx \
-v $(pwd)/config/nginx/nginx.conf:/etc/nginx/nginx.conf:ro \
-v $(pwd)/config/nginx/vhosts/:/etc/nginx/sites-enabled/:ro \
--volumes-from xhprof_php \
--link xhprof_php:php-fpm \
nginx
