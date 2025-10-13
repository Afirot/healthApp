```mermaid
graph TD
    A[USUARIO] --> B{Envia Formulasio}
    B -->|Sí| |Envia datos| C[Base de Datos]
    B -->|No| D[Front End]
    C -->|Toma datos| D
