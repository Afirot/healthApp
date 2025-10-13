```HealthApp
graph TD
    A[USUARIO] --> B{Envia Formulasio}
    B -->|Sí| C[Base de Datos]
    B -->|No| D[Front End]
    C --> D
