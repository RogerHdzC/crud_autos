-- Crear tabla de marcas
CREATE TABLE `marcas` (
    `marca_id` INT AUTO_INCREMENT PRIMARY KEY, -- Clave primaria con auto-incremento
    `marca_name` VARCHAR(100) NOT NULL        -- Nombre de la marca
);

-- Crear tabla de modelos
CREATE TABLE `modelos` (
    `modelo_id` INT AUTO_INCREMENT PRIMARY KEY, -- Clave primaria con auto-incremento
    `marca_id` INT NOT NULL,                   -- Clave foránea que referencia a marcas
    `modelo_name` VARCHAR(100) NOT NULL,       -- Nombre del modelo
    CONSTRAINT `fk_modelos_marcas` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`marca_id`) ON DELETE CASCADE ON UPDATE CASCADE -- Relación con marcas
);

-- Crear tabla de submodelos
CREATE TABLE `submodelos` (
    `submodelo_id` INT AUTO_INCREMENT PRIMARY KEY, -- Clave primaria con auto-incremento
    `modelo_id` INT NOT NULL,                     -- Clave foránea que referencia a modelos
    `submodelo_name` VARCHAR(100) NOT NULL,       -- Nombre del submodelo
    `submodelo_year` YEAR NOT NULL,               -- Año del submodelo
    `submodelo_ac` TINYINT(1) NOT NULL,           -- Indicador de aire acondicionado (1 para sí, 0 para no)
    CONSTRAINT `fk_submodelos_modelos` FOREIGN KEY (`modelo_id`) REFERENCES `modelos` (`modelo_id`) ON DELETE CASCADE ON UPDATE CASCADE -- Relación con modelos
);

-- Agregar índices para mejorar el rendimiento en las claves foráneas
CREATE INDEX `idx_modelos_marca_id` ON `modelos` (`marca_id`);
CREATE INDEX `idx_submodelos_modelo_id` ON `submodelos` (`modelo_id`);
