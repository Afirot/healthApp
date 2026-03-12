#!/bin/bash
set -e

# Levanta los contenedores y reconstruye
sudo docker-compose up -d --build

# Arranca fail2ban en Apache
sudo docker exec apache-healthapp fail2ban-server start

# Espera a que MariaDB esté lista
echo "Esperando a que MariaDB arranque..."
sleep 2
echo "MariaDB lista."

# Actualiza o crea usuarios y cambia contraseñas
echo "Creando/actualizando usuarios con contraseñas del .env..."

# db_users
sudo docker exec lamp-mariaDB-1 bash -c "mariadb -u root -p\$MYSQL_ROOT_PASSWORD -e \"
CREATE USER IF NOT EXISTS 'db_users'@'%' IDENTIFIED BY '\$DB_USERS_PASS';
ALTER USER 'db_users'@'%' IDENTIFIED BY '\$DB_USERS_PASS';
FLUSH PRIVILEGES;
\""

# data_user
sudo docker exec lamp-mariaDB-1 bash -c "mariadb -u root -p\$MYSQL_ROOT_PASSWORD -e \"
CREATE USER IF NOT EXISTS 'data_user'@'%' IDENTIFIED BY '\$DATA_PASS';
ALTER USER 'data_user'@'%' IDENTIFIED BY '\$DATA_PASS';
FLUSH PRIVILEGES;
\""

# insert_user
sudo docker exec lamp-mariaDB-1 bash -c "mariadb -u root -p\$MYSQL_ROOT_PASSWORD -e \"
CREATE USER IF NOT EXISTS 'insert_user'@'%' IDENTIFIED BY '\$INSERT_USER_PASS';
ALTER USER 'insert_user'@'%' IDENTIFIED BY '\$INSERT_USER_PASS';
FLUSH PRIVILEGES;
\""

echo "Usuarios creados/actualizados correctamente."