-- Crear la base de datos
CREATE DATABASE biblioteca;

-- Usar la base de datos
USE biblioteca;

-- Crear la tabla usuarios
CREATE TABLE usuarios (
    id_usuarios INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(55),
    apellido VARCHAR(55),
    correo VARCHAR(55) unique,
    direccion VARCHAR(100)
);

-- Crear la tabla bibliotecarios
CREATE TABLE bibliotecarios (
    id_bibliotecarios INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(55),
    apellido VARCHAR(55),
    correo VARCHAR(55) unique,
    turno VARCHAR(25)
);

-- Crear la tabla solicitudes
CREATE TABLE solicitudes (
    id_solicitudes INT AUTO_INCREMENT PRIMARY KEY,
    libro_id int not null,
    usuarios_id int not null,
    fecha_solicitud DATE,
    fecha_devolucion DATE
);

-- Crear la tabla adeudos
CREATE TABLE adeudos (
    id_adeudos INT AUTO_INCREMENT PRIMARY KEY,
    solicitudes_id INT,
    bibliotecarios_id int,
    usuarios_id int,
    monto_adeudo DECIMAL(10, 2),
    fecha_adeudo DATE,
    motivo_adeudo VARCHAR(255)
);

CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    titulo_unique varchar(100) unique,
    autor VARCHAR(100),
    numero_ejemplar INT
);


-- Añadir clave externa para solicitudes en adeudos
ALTER TABLE adeudos
ADD  constraint fk_adeudo_solicitud 
FOREIGN KEY (solicitudes_id) REFERENCES solicitudes(id_solicitudes);

ALTER TABLE adeudos
ADD  constraint fk_adeudo_usuario
FOREIGN KEY (usuarios_id) REFERENCES usuarios(id_usuarios);

ALTER TABLE adeudos
ADD  constraint fk_adeudo_bibliotecario
FOREIGN KEY (bibliotecarios_id) REFERENCES bibliotecarios(id_bibliotecarios);

-- modificacion de la tbla solicitudes
ALTER TABLE solicitudes
ADD  constraint fk_solicitud_usuario
FOREIGN KEY (usuarios_id) REFERENCES usuarios(id_usuarios);

ALTER TABLE solicitudes
ADD  constraint fk_solicitud_libro
FOREIGN KEY (libro_id) REFERENCES libros(id_libro);


