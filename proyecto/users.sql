CREATE TABLE IF NOT EXISTS usuarios (
    id Int(100) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(15) NOT NULL,
    apellidos VARCHAR(25) NOT NULL,
    pass VARCHAR(20) NOT NULL,    
    correo VARCHAR(30) NOT NULL UNIQUE,
    edad INT(100) NOT NULL,
    color VARCHAR(15) NOT NULL,
    fecha VARCHAR(10) NOT NULL,
    descripcion VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS productos (
    id Int(100) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(15) NOT NULL,
    precio INT(100) NOT NULL,
    fecha VARCHAR(10) NOT NULL,
    descripcion VARCHAR(200)
)