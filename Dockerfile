FROM php:8.3-fpm

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip unzip curl git npm nano \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala o Composer dentro da imagem
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Diretório de trabalho
WORKDIR /var/www

# Copia todos os arquivos (caso existam)
COPY . .

# Ajusta permissões
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www

# Porta do PHP-FPM
EXPOSE 9000

# Comando padrão
CMD ["php-fpm"]

