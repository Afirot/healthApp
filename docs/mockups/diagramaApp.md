```mermaid
graph TD
    A[USUARIO] --> B[Graficas]
    A -->|Peso<br>Altura| C[Formulario]
    C --> D{Calcula IMC}
    D-->|Peso<br>Altura<br>Dia<br>IMC| E[Data Base]
    E--> B

