#!/bin/bash
set -e

# Levanta los contenedores y reconstruye
sudo docker compose up -d --build

# Arranca fail2ban en Apache
sudo docker exec apache-healthapp fail2ban-server start

