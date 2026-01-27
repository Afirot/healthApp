#/bin/bash

sudo docker-compose up -d --build
sudo docker exec apache-healthapp fail2ban-server start
