```mermaid
graph TD
    A[USUARIO] --> B{Envia Formulario}
    B -->|Sí| C[Base de Datos]
    B -->|No| D[Front End]
    C ---|Toma datos| D
