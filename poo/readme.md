# Código Orientado a Objetos (POO)

- El proyecto ha sido refactorizado utilizando **Programación Orientada a Objetos (POO)** para mejorar la modularidad, la mantenibilidad y la reutilización del código.
- La lógica de negocio, la gestión de datos y la presentación están separadas en clases específicas, lo que facilita la escalabilidad del proyecto.

## Estructura del Proyecto
```
├── classes/
│   ├── Database.php
│   ├── Config.php
│   ├── EntidadBase.php
│   ├── Marca.php
│   ├── Modelo.php
│   └── Submodelo.php
├── css/
│   └── main.css
├── js/
│   └── app.js
├── add.php
├── delete.php
├── edit.php
├── head.php
├── index.php
├── layout.php
└── README.md
```

### **Descripción de Clases**

- **Database**: Encapsula la lógica de conexión a la base de datos usando PDO.
- **Config**: Gestiona la configuración de variables de entorno.
- **EntidadBase**: Clase abstracta que centraliza operaciones CRUD básicas para reutilización en las entidades.
- **Marca, Modelo, Submodelo**: Clases que extienden de `EntidadBase` y representan entidades específicas en el sistema.

---

## **Cómo Iniciar el Proyecto**

1. En la terminal ejecuta:
   ```bash
   composer install
   ```

2. Dentro de la carpeta `src/classes`, agrega un archivo `.env` con las credenciales de la base de datos. Puedes basarte en el archivo `.env.example` incluido.

3. Inicia el servidor local de PHP:
   ```bash
   php -S localhost:3000
   ```

4. Abre tu navegador y accede a [http://localhost:3000](http://localhost:3000).

---

## **Principales Mejoras respecto al Código Espagueti**

- **Separación de responsabilidades**: Lógica de negocio, acceso a datos y presentación están claramente diferenciados.  
- **Reutilización de código**: Gracias a la herencia de `EntidadBase`, se reducen las repeticiones de código.  
- **Mejor mantenimiento**: Cambios en la lógica o en la base de datos afectan menos al resto del código.  
- **Seguridad mejorada**: Uso de sanitización de inputs y consultas preparadas para proteger contra SQL Injection.
