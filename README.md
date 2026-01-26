# healthApp

¡Bienvenidos a healthApp! Esta aplicación esta desarrollada expresamente para controlar la salud de tu cuerpo.

<img width="1867" height="993" alt="image" src="https://github.com/user-attachments/assets/a8ff6733-331d-47ea-aec7-c1f144d35e00" />

# Pre-requisitos de HealthApp

Es necesario contar con Docker-Compose instalado previamente en el sistema en el que se vaya a desplegar.
Para más información del proceso de instalación de Docker-Compose y requisitos de Docker-Compose pulsa [aquí](https://docs.docker.com/compose/install/)

# Pasos de Instalación

HealthApp es una aplicación web desarrolada principalmente en PHP, para mayor comodidad, se ha dockerizado la aplicación y tecnologías necesarias para su correcto funcionamiento.

## Linux

Para desplegar el contenedor nos situaremos dentro del directorio src, este contendrá los archivos de configuración para desplegar los contenedores necesarios para el funcionamiento de la aplicación.

<pre>cd src</pre>

Una vez situados dentro, ejecutaremos el siguiente comando para levantar los contenedores.

<pre>docker-compose up</pre>

Una vez finalizado el proceso de instalación de los contenedores, podemos realizar una comprobación para ver si ha sido exitoso.

<pre>docker ps -a</pre>

# Funcionamiento

## Acceso a healthApp

Para acceder a la aplicación web, debemos acceder a nuestro navegador preferido y dirigirnos a la IP del equipo donde se ha desplegado la aplicación.

<pre>XXX.XXX.XXX.XXX</pre>

Una vez comprobado que puede acceder nuestros pacientes, podrán hacer uso de healthApp mediante un registro de un usuario, el cuál contendrá sus datos.

<img width="1853" height="837" alt="image" src="https://github.com/user-attachments/assets/56461df1-f833-4ff1-a04d-2b8716a4949f" />

Una vez que inicio sesión el paciente podrá encontrarse con su perfil personal de su usuario y podrá registrar su peso y altura, para ir creando un control histórico del paciente.



# Advertencia de seguridad

Cambiar las contraseñas de la BD en el archivo YAML y de los distintos usuarios usados por la aplicación. Puede llevar a filtraciones de datos.
