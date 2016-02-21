# NGINX VHOST EXTRACT
location ~ \.php$ {
    include                     fastcgi_params;
    fastcgi_index               index.php;
    fastcgi_param               SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_pass                php-fpm:9000;
    fastcgi_read_timeout        600;

    # NOTE THIS LINE
    fastcgi_param  PHP_VALUE   "auto_prepend_file=/usr/share/nginx/html/local/auto_prepend.php";
}