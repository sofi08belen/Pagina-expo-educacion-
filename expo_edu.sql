create database expo_edu
use expo_edu;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contrasenha VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE inicio_sesion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE contenido_admin (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- El campo "id" es la clave primaria y se incrementa automáticamente
    titulo VARCHAR(255) NOT NULL,               -- Título del contenido
    descripcion TEXT,                           -- Descripción del contenido en formato de texto largo
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Guarda la fecha y hora de la publicación
    publicado_por INT,                          -- Referencia al usuario (admin) que publica el contenido
    FOREIGN KEY (publicado_por) REFERENCES usuarios(id)    -- Clave foránea para relacionar con la tabla de usuarios
);
-- A continuación, añadimos una columna para definir el rol de cada usuario
-- Esto nos permitirá identificar si el usuario es "usuario" o "admin"
ALTER TABLE usuarios ADD COLUMN rol ENUM('usuario', 'admin') DEFAULT 'usuario';
-- Por defecto, todos los usuarios son registrados como "usuario" a menos que se especifique que es "admin"
-- Insertar un usuario administrador de ejemplo
-- La contraseña se encripta usando MD5 (recomendado usar algo más seguro como bcrypt)
INSERT INTO usuarios (nombre , email , contrasenha , rol)
VALUES ('admin', 'admin@example.com', MD5('adminpassword'), 'admin');
-- En este caso, estamos insertando un usuario llamado 'admin' con el rol de administrador



