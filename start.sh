#!/bin/sh
echo "Starting Development ENV - PHP7"
echo "Deleting Nginx Docker, discarding old logs"
docker rm xhprof_nginx

echo "Starting Dockers, in order of inclusion"
docker start xhprof_redis xhprof_mysql xhprof_php7-fpm

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
--volumes-from xhprof_php7-fpm \
--link xhprof_php7-fpm:php-fpm \
nginx
