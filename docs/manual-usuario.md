# Manual de usuario HealthApp
HealthApp ofrece una serie de funciones que permite la gestion del Indice de Masa Corporal de uno o multiples pacientes.

## Login
Para poder acceder a la aplicacion el paciente debe de estar registrado como paciente en la aplicacion, en caso de no estarlo, puede registrarse en cualquier momento haciendo click en el enlace debajo del formulario de Login "Registrarme como paciente".

Una vez creada la cuenta, el paciente podra entrar a ver y modificar sus registros en cualquier momento simplemente introduciendo su usuario y contraseña, lo cual le dara acceso al panel principal y solo y unicamente a sus datos.

## Registrar

El formulario solicita, de forma obligatoria, el nombre, los apellidos y la fecha de nacimiento del paciente, datos necesarios para los registros medicos.
Asimismo, solicitara un usuario y una contraseña, esta ultima sera hasheada por el programa antes de ser almacenada en la base de datos.

## Panel principal

Una vez el usuario se ha identificado, la aplicacion le dara la bienvenida con una notificación.

Dentro de la aplicacion podra ver, lo primero, un interruptor que permite acceder al formulario en el cual podra enviar datos una vez al dia a la base de datos.

### Formulario IMC

El formulacio solo solicitara la altura y el peso del paciente, aunque, ademas de esto, tambien se almacenara la fecha en el que los datos han sido ingresados a la base de datos.

### Graficas de datos

El usuario podra ver sus datos en forma de una grafica, organizada por fecha, en esta tabla se representaran 3 datos, la altura del paciente, su peso y su IMC.
