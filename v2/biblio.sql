-- Crear la base de datos
CREATE DATABASE biblioteca;

-- Usar la base de datos
USE biblioteca;

-- Crear la tabla usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(55),
    apellido VARCHAR(55),
    email VARCHAR(55) unique,
    direccion VARCHAR(100),
    bibliotecario_id INT,
    estado_bloqueo varchar(2)
);

-- Crear la tabla bibliotecarios
CREATE TABLE bibliotecarios (
    id_bibliotecario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(55),
    apellido VARCHAR(55),
    turno varchar(10),
    email_bibliotecario VARCHAR(55) unique,
    contrasenia_bibliotecario VARCHAR (100),
    administrador_id int
);

-- Crear la tabla solicitudes
CREATE TABLE solicitudes (
    id_solicitud INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id int not null,
    libro_id int not null,
    fecha_solicitud DATE,
    fecha_entrega DATE
);

-- Crear la tabla adeudos
CREATE TABLE adeudos (
    id_adeudo INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id int,
    solicitud_id INT,
    bibliotecario_id int,
    monto_adeudo DECIMAL(10, 2),
    fecha_adeudo DATE,
    motivo_adeudo VARCHAR(255)
);

CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    titulo_unique varchar(100) unique,
    autor VARCHAR(100),
    numero_ejemplar INT,
    bibliotecario_id int not null
);


create table administrador(
    id_administrador int AUTO_INCREMENT PRIMARY KEY,
    email_administrador varchar (100) unique,
    contrasenia_administrador varchar(100),
    nombre varchar(50)
);


-- modificacion de la tbla solicitudes
ALTER TABLE solicitudes
ADD  constraint fk_solicitud_usuario
FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario);

ALTER TABLE solicitudes
ADD  constraint fk_solicitud_libro
FOREIGN KEY (libro_id) REFERENCES libros(id_libro);





-- Añadir clave externa para solicitudes en adeudos
ALTER TABLE adeudos
ADD  constraint fk_adeudo_solicitud 
FOREIGN KEY (solicitud_id) REFERENCES solicitudes(id_solicitud);

ALTER TABLE adeudos
ADD  constraint fk_adeudo_usuario
FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario);

ALTER TABLE adeudos
ADD  constraint fk_adeudo_bibliotecario
FOREIGN KEY (bibliotecario_id) REFERENCES bibliotecarios(id_bibliotecario);


-- añadir calve externa para tabla bibliotecarios

ALTER TABLE bibliotecarios
ADD constraint fk_bibliotecario_administrador
FOREIGN KEY (administrador_id) REFERENCES administrador(id_administrador);



-- añadir clave externa para tabla libros

ALTER TABLE libros
ADD constraint fk_libro_bibliotecario
FOREIGN KEY (bibliotecario_id) REFERENCES bibliotecarios(id_bibliotecario);

-- añadir clave externa para tabla usuarios

ALTER TABLE usuarios
ADD constraint fk_usuario_bibliotecario
FOREIGN KEY (bibliotecario_id) REFERENCES bibliotecarios(id_bibliotecario);



