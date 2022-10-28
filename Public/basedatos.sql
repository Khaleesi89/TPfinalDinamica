CREATE DATABASE tp4dinamica;
use tp4dinamica;

/* CREATE TABLE profesor (
    usuario varchar(20) NOT NULL,
    contrasenia varchar(255) NOT NULL,
    mailInstitucional varchar(50) NOT NULL,
    materia varchar(255) NOT NULL,
    PRIMARY KEY (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; */

/* CREATE TABLE notas (
    id int AUTO_INCREMENT NOT NULL,
    legajo varchar(20),
    apellidoNombre varchar(50) NOT NULL,
    materia varchar(255) NOT NULL,
    nota decimal(4.2) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; */

CREATE TABLE usuario (
    idUsuario int AUTO_INCREMENT NOT NULL,
    usuarioNombre varchar(30) NOT NULL UNIQUE,
    usuPassword varchar(255) NOT NULL,
    mail varchar(100),
    deleted varchar(15),
    idRol int NOT NULL,
    PRIMARY KEY (idUsuario),
    FOREIGN KEY (idRol) REFERENCES rol (idRol)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE rol (
    idRol int AUTO_INCREMENT NOT NULL,
    nombreRol varchar(20) NOT NULL,
    PRIMARY KEY (idRol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE paginas (
    idPagina int AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255),
    link VARCHAR(255) NOT NULL,
    PRIMARY KEY (idPagina)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE paginaRol (
    idPagRol INT AUTO_INCREMENT NOT NULL,
    idRol INT NOT NULL,
    idPag INT NOT NULL,
    fechaIni varchar(15),
    fechaFin varchar(15),
    PRIMARY KEY (idPagRol),
    FOREIGN KEY (idRol) REFERENCES rol (idRol)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT,
    FOREIGN KEY (idPag) REFERENCES paginas (idPagina)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;