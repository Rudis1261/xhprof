#!/bin/bash

function createContainers {
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

    sleep 1

    echo "CREATING CONTAINER (Redis)"
    docker run \
    -d \
    -p 6379:6379 \
    -i \
    --name xhprof_redis \
    redis
    echo
    echo

    sleep 1

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

    sleep 1

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
}


# CHECK IF DOCKER IS INSTALLED
command -v docker >/dev/null 2>&1 || {
    echo "Docker not installed!!  Aborting!!" >&2;
    echo "Installation Documentation: https://docs.docker.com/engine/installation/" >&2;
}
docker -v


# CREATE THE DOCKER CONTAINERS
while true; do
    read -p "BUILD DOCKER PHP IMAGE? [y/n]: " yn1
    case $yn1 in
        [Yy]* ) ./buildImage.sh; break;;
        [Nn]* ) echo "PHP Image not created"; break;;
        * ) echo "Please answer yes [y] or no [n].";;
    esac
done


# CREATE THE DOCKER CONTAINERS
while true; do
    read -p "CREATE DOCKER CONTAINERS? [y/n]: " yn1
    case $yn1 in
        [Yy]* ) createContainers; break;;
        [Nn]* ) echo "No containers created"; break;;
        * ) echo "Please answer yes [y] or no [n].";;
    esac
done

# IMPORT THE DATABASE FILES
while true; do
    read -p "IMPORT THE DATABASE? [y/n]: " yn2
    case $yn2 in
        [Yy]* )
        echo "Ensuring that DOCKER Containers are started";
        ./start.sh
        echo "Creating Local DB";
        mysql -u root -proot -h 127.0.0.1 < src/public/local/data/local.sql;
        echo "Creating Country DB and importing rows";
        mysql -u root -proot -h 127.0.0.1 < src/public/local/data/country.sql;
        echo "Creating Subscriber DB and importing rows";
        mysql -u root -proot -h 127.0.0.1 < src/public/local/data/subscribers.sql;
        echo "Creating TV DB and importing rows";
        mysql -u root -proot -h 127.0.0.1 < src/public/local/data/tvtracker.sql;
        break;;
        [Nn]* ) echo "DB import ignored"; exit;;
        * ) echo "Please answer yes [y] or no [n].";;
    esac
done
