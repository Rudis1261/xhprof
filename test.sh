#!/bin/sh

echo "CREATING CONTAINER (PHP)"
docker run \
-d \
-p 9000:9000 \
-i \
-t \
--name xhprof_php \
-v $(pwd)/src/public:/usr/share/nginx/html \
-w /usr/share/nginx/html \
drpain/xhprof:latest \
/bin/bash