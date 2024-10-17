create database bdexcel;

create table `persona`(
    `PerDNI` int not null,
    `PerNombre` varchar(50),
    `PerFechaNac` date,
    PRIMARY KEY (`PerDNI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE paginas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);