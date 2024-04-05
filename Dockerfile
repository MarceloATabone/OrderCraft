# Use a imagem base do Apache com PHP
FROM php:apache

# Atualize os pacotes e instale o cliente PostgreSQL
RUN apt-get update \
    && apt-get install -y postgresql-client \
    && rm -rf /var/lib/apt/lists/*

# Copie o conteúdo da sua aplicação para o diretório raiz do servidor web do Apache
COPY . /var/www/html/
COPY api/.env /var/www/html/api/.env

# Defina as permissões corretas para os arquivos e diretórios
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
RUN a2enmod rewrite



# Exponha a porta 80 para tráfego web
EXPOSE 80
