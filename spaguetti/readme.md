# Código espagueti
- Una sola capa de código donde las funcionalidades estarán implementadas directamente en los archivos PHP.
- Separación mínima de lógica, estructura y estilo.

## Pasos para iniciar el proyecto completado
1. En la terminal ejecuta composer install
2. Dentro de la carpeta src/includes agrega un archivo '.env' con las credenciales correctas que vienen en el .env.example
3. En la terminal ejecuta un servidor virtual de php, `php -S ip:puerto`
4. Abre tu navegador y accede a [http://ip:puerto](http://ip:puerto).

## Progreso del Proyecto

Puedes seguir el progreso del desarrollo revisando los siguientes commits clave (**NOTA: Los estilos y el body de HTML se agregó considerando que esto es un tutorial para entender PHP**):

Desde un inicio se considera el setup de las variables de entorno como en el princio, con el comando de:
```bash
composer require vlucas/phpdotenv
```

| Funcionalidad | Commit |
|---------------|--------|
| CRUD de Marcas | `a8ab1c7` |
| CRUD de Modelos | `79bf353b` |
| CRUD de Submodelos | `f6e21f3b` |
| Modularización de Configuración DB | `3f614a3a` |
| Agregado de plantilla de head | `14d95c7f` |

Para ver una versión específica:
```bash
git checkout <hash>
```

---
## Diseño de la base de datos

El diseño de la base de datos está documentado en el siguiente archivo: [Diseño de Base de Datos](bd/bd.md)

## Sigue con la implementación en [Código Orientación a objetos (OOP)](poo/readme.md)
