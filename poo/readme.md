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

## **Cómo Iniciar el Proyecto Completado**

1. En la terminal ejecuta:
   ```bash
   composer install
   ```

2. Dentro de la carpeta `src/classes`, agrega un archivo `.env` con las credenciales de la base de datos. Puedes basarte en el archivo `.env.example` incluido.

3. Inicia el servidor local de PHP:
   ```bash
   php -S ip:puerto
   ```

4. Abre tu navegador y accede a [http://ip:puerto](http://ip:puerto).

---

## Progreso del Proyecto

Puedes seguir el progreso del desarrollo revisando los siguientes commits clave (**NOTA: Los estilos y el body de HTML se agregó considerando que esto es un tutorial para entender PHP**):

Desde un inicio se considera el setup de las variables de entorno como en el princio, con el comando de:
```bash
composer require vlucas/phpdotenv
```

| Funcionalidad | Commit |
|---------------|--------|
| CRUD de Marcas | `856825b` |
| Modularización de carga del env | `6e316ad` |
| CRUD de Modelos | `610dea3` |
| Refactorizar la funciones duplicadas | `a7566c7` |
| CRUD de Submodelos | `bfa5b1c` |
| Confirmación de delete | `e6fe1c5` |

Para ver una versión específica:
```bash
git checkout <hash>
```


## **Principales Mejoras respecto al Código Espagueti**

- **Separación de responsabilidades**: Lógica de negocio, acceso a datos y presentación están claramente diferenciados.  
- **Reutilización de código**: Gracias a la herencia de `EntidadBase`, se reducen las repeticiones de código.  
- **Mejor mantenimiento**: Cambios en la lógica o en la base de datos afectan menos al resto del código.  
- **Seguridad mejorada**: Uso de sanitización de inputs y consultas preparadas para proteger contra SQL Injection.
