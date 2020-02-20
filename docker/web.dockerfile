FROM nginx:1.15

ADD ./docker/nginx/vhost.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www