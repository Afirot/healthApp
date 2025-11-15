# Pruebas unitarias Clase Paciente

# Función Construct

Atributo idusuario.

|                      Rango de Valores                               | Valor de Prueba | Valor Esperado |
|---------------------------------------------------------------------|-----------------|----------------|
| 00000000000000000000000000000000 - FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF |                 | True           |
| String                                                              |                 | False          |
| Boolean                                                             |                 | False          |

# Función send_data

Atributos Peso y Altura.

| Rango de Valores | Valor de Prueba | Valor Esperado |
|------------------|-----------------|----------------|
| 1 - 500          |                 | True           |
| Float            |                 | False          |
| String           |                 | False          |
| Boolean          |                 | False          |

# Pruebas unitarias Clase Registro

Atributos pass y pass2 (las contraseñas introducidas por el usuario a la hora del registro).

# Función comprobarPass

| Rango de Valores | Valor de Prueba | Valor Esperado |
|------------------|-----------------|----------------|
| pass == pass2    |                 | True           |
| pass ≠ pass2     |                 | False          |

# Función comprobarUsuario

Atributo usuario.

| Rango de Valores                                     | Valor de Prueba | Valor Esperado |
|------------------------------------------------------|-----------------|----------------|
| Usuarios no exitentes en la tabla health_app.users   | Zafrilla        | True           |
| Usuarios exitentes en la tabla health_app.users      | ignacio         | False          |
