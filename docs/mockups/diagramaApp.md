```mermaid
graph TD
    A[Paciente] -->|Usuario<br>Contraseña| B[Panel Login]
    H[Notificacion Bienvenida] -->C[Front End]
    B -->L{Procesar<br>datos de login}
    L -->|Autenticacion exitosa|H
    L -->|Autenticacion NO exitosa|B
    H -->|Peso<br>Altura| D[Formulario]
    D-->|Peso<br>Altura<br>Fecha<br>UserID| F[Data Base]
    F-->G{Calcula<br>Maximo/Minimo de peso historico, IMC y genera las graficas de datos}
    G--> C
    L---|Compara datos de autenticacion|F
    A-->R{Registrarse}
    R-->|Usuario<br>Hash<br>Nombre<br>Apellidos<br>FechaNacimiento<br>UserID|F

