#!/bin/sh
echo "Resetting XHProf Environment"
echo ""
while true; do
    read -p "Delete all docker containers? [y/n]: " yn
    case $yn in
        [Yy]* ) docker rm -f xhprof_nginx xhprof_php xhprof_redis xhprof_mysql; break;;
        [Nn]* ) echo "Cancelled"; exit;;
        * ) echo "Please answer yes [y] or no [n].";;
    esac
done
