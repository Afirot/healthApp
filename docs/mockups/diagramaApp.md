```mermaid
graph TD
    A[USUARIO] --> B{Envia Formulasio}
    B -->|Sí| C[Base de Datos]
    B -->|No| D[Front End]
    D -->|Toma datos| C
