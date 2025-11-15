# Pruebas unitarias Clase Paciente

# Función Construct

Atributo idusuario.

|                      Rango de Valores                               | Valor de Prueba                  | Valor Esperado     |
|---------------------------------------------------------------------|----------------------------------|--------------------|
| 00000000000000000000000000000000 - FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF | aB3dE9fG1hJ6kL0mN2pQ4rS7tU8vW5xY | True               |
| String                                                              | idNoValido                       | False              |
| Boolean                                                             | True                             | False              |
| Null                                                                | Null                             | False              |
| Vacío ()                                                            |                                  | ArgumentCountError |

# Función send_data

Atributos Peso y Altura.

| Rango de Valores  | Valor de Prueba    | Valor Esperado |
|-------------------|--------------------|----------------|
| Enteros positivos | 100,100            | True           |
| Entero negativos  | -100,-100          | False          |
| String            | 'Hola', 'Caracola' | False          |
| Boolean           | True,True          | False          |
| Float             | 33.33,33.33        | False          |

# Pruebas unitarias Clase Registro

Atributos pass y pass2 (las contraseñas introducidas por el usuario a la hora del registro).

# Función comprobarPass

| Rango de Valores | Valor de Prueba               | Valor Esperado |
|------------------|-------------------------------|----------------|
| pass == pass2    | Contraseca1234,Contraseca1234 | True           |
| pass ≠ pass2     | Contraseca1234,OtraContraseña | False          |

# Función comprobarUsuario

Atributo usuario.

| Rango de Valores                                     | Valor de Prueba | Valor Esperado |
|------------------------------------------------------|-----------------|----------------|
| Usuarios no exitentes en la tabla health_app.users   | Zafrilla1843    | True           |
| Usuarios exitentes en la tabla health_app.users      | ignacio         | False          |

Importante: No se ha realizado pruebas unitarias de los datos de registro e inicio de sesión, ya que estos datos se controlan sus formatos mediante expresiones regulares en el frontend
