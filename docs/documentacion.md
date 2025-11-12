# HealthApp

## Clases

### Paciente

Esta clase se usara para todas las operaciones referentes a un paciente y sus datos.

#### Construct

Cuando se cree un objeto de la clase Paciente, el sistema tomara la id del usuario almacenada en $_SESSION y almacenara en las variables username, nombre, apellidos y fecha_nacimiento los datos requeridos.

#### Welcome

Este metodo generara una notificacion dando la bienvenida al usuario usando su nombre y su apellido almacenado en las variables nombre y apellidos

#### send_data

Este metodo sirve para enviar los datos de altura y peso a la base de datos.

#### Extract_data

Este metodo extrae todos los datos dentro de la base de datos y los devuelbe como una matriz.

### Registro

Esta clase se usara para todas las operaciones referentes al registro de un usuario.

#### Construct

Al crear un objeto de esta clase se deberan introducir manualmente los datos usuario, nombre, apellidos, fechaNacimiento, password1 y password2.

#### insertarUsuario

Esta funcion se encarga de insertar al nuevo usuario dentro de la base de datos.

#### comprobarUsuario

Esta funcion se encarga de comprobar si el username que se esta creando existe o no en la base de datos.

En caso de existir ya el usuario dentro de la base de datos, se devolbera un nuevo formulario de registro, si no, se ejecutara el metodo insertarUsuario.

#### comprobarPasss

Esta funcion comprueba que las dos contraseñas introducidas sean iguales, en caso de no serlo, se abrira de nuevo el formulario de registro, en caso de ambas ser iguales, se llamara al metodo comprobarUsuario.
