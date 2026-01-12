# healthApp

¡Bienvenidos a healthApp! Esta aplicación esta desarrollada expresamente para controlar la salud de tu cuerpo.

<img width="1867" height="993" alt="image" src="https://github.com/user-attachments/assets/a8ff6733-331d-47ea-aec7-c1f144d35e00" />

# Pre-requisitos de HealthApp

Es necesario contar con Docker-Compose instalado previamente en el sistema en el que se vaya a desplegar.
Para más información del proceso de instalación de Docker-Compose y requisitos de Docker-Compose pulsa [aquí](https://docs.docker.com/compose/install/)

# Pasos de Instalación

HealthApp es una aplicación web desarrolada principalmente en PHP, para mayor comodidad, se ha dockerizado la aplicación y tecnologías necesarias para su correcto funcionamiento.

Para desplegar el contenedor nos situaremos dentro del directorio src, este contendrá los archivos de configuración para desplegar los contenedores necesarios para el funcionamiento de la aplicación.

# Linux

<pre>docker-compose up</pre>

# Windows

# Advertencia de seguridad

Cambiar las contraseñas de la BD en el archivo YAML y de los distintos usuarios usados por la aplicación. Puede llevar a filtraciones de datos 
