FROM node:20.3.1-slim as nodejs
WORKDIR /app
COPY front ./
RUN npm install
RUN npm run build

FROM bitnami/nginx:1.25.1-debian-11-r2 as front
WORKDIR /app
COPY .docker/front-nginx.conf /opt/bitnami/nginx/conf/server_blocks/server.conf
COPY --from=nodejs /app/dist ./
EXPOSE 8080
EXPOSE 8443
ENTRYPOINT ["/opt/bitnami/scripts/nginx/entrypoint.sh"]
CMD ["/opt/bitnami/scripts/nginx/run.sh"]

FROM node:20.3.1-slim as nodejs-back
WORKDIR /app
COPY back ./
RUN npm install
RUN npm run build

FROM gitasap.ru:5050/it/gosti/back:0.1.4 as back
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libpq-dev && \
    docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install exif gd pdo pdo_pgsql && \
    docker-php-source delete && rm -rf /var/lib/apt/lists/* && rm -rf /var/cache/*

COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer
COPY .docker/unit-config.json /docker-entrypoint.d/
WORKDIR /app
COPY back /app/
COPY --from=nodejs-back /app/public ./public
RUN composer install
RUN chown -R unit:unit /app/
EXPOSE 80