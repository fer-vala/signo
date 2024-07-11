# Usar Debian 12 (Bookworm) como base
FROM debian:bookworm

ARG PHP_VERSION

# Establecer variables de entorno para Debian frontend y la zona horaria
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=America/Mexico_City

# Actualizar el sistema e instalar utilidades
RUN apt-get update && apt-get install -y \
    apt-transport-https \
    lsb-release \
    ca-certificates \
    curl \
    wget \
    unzip \
    gnupg2 \
    tzdata \
    ntpdate

# Configurar la zona horaria
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Añadir el repositorio de PHP
RUN curl -sSL https://packages.sury.org/php/README.txt | bash -x

# Instalar Apache y la versión de PHP especificada
RUN apt-get update && apt-get install -y \
    apache2 \
    "php${PHP_VERSION}" \
    "php${PHP_VERSION}-cli" \
    "php${PHP_VERSION}-fpm" \
    "php${PHP_VERSION}-common" \
    "php${PHP_VERSION}-mysql" \
    "php${PHP_VERSION}-zip" \
    "php${PHP_VERSION}-gd" \
    "php${PHP_VERSION}-mbstring" \
    "php${PHP_VERSION}-curl" \
    "php${PHP_VERSION}-xml" \
    "php${PHP_VERSION}-bcmath" \
    "php${PHP_VERSION}-pdo" \
    "php${PHP_VERSION}-pdo-pgsql" \
    "php${PHP_VERSION}-pdo-sqlite" \
    libapache2-mod-php"${PHP_VERSION}" \
    && apt-get clean

# Configura el idioma del contenedor a español
RUN apt-get clean && apt-get update && apt-get install -y locales
RUN localedef -i es_MX -c -f UTF-8 -A /usr/share/locale/locale.alias es_MX.UTF-8
ENV LANG es_MX.UTF-8
ENV LANGUAGE es_MX:es
ENV LC_ALL es_MX.UTF-8

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Configura el directorio donde se alojará el sitio web
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Exponer el puerto 80 para el servidor web
EXPOSE 80

# Ejecutar Apache en foreground
CMD ["apache2ctl", "-D", "FOREGROUND"]