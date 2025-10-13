```mermaid
graph TD
    A[USUARIO] --> B{Inicia Sesion}
    H[Notificacion Bienvenida] -->C[Front End]
    B -->H
    H -->|Peso<br>Altura<br>UserID| D[Formulario]
    D --> E{Calcula IMC}
    E-->|Peso<br>Altura<br>Dia<br>IMC| F[Data Base]
    F-->G{Calcula<br>Maximo/Minimo de peso historico}
    G--> C
    B---|Autenticacion|F
    A-->R{Registrarse}
    R-->|Usuario<br>Hash<br>Nombre<br>Apellidos<br>FechaNacimiento<br>UserID|F

