CREATE DATABASE waap_official;
USE waap_official;

CREATE TABLE IF NOT EXISTS usuario(
	id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(80) NOT NULL,
    sexo CHAR(1),
    nascimento DATE NOT NULL,
    cpf CHAR(16) NOT NULL UNIQUE,
    privilegio CHAR(1) NOT NULL
);
CREATE TABLE IF NOT EXISTS ong(
	id_ong INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nome VARCHAR(60) NOT NULL,
    cnpj CHAR(18) NOT NULL UNIQUE,
    fundacao DATE NOT NULL,
    descricao_ong TEXT NOT NULL,
    foreign key (id_usuario) references usuario(id_usuario),
    status_ong CHAR(1) NOT NULL
);
CREATE TABLE IF NOT EXISTS animal(
	id_animal INT AUTO_INCREMENT PRIMARY KEY,
    id_ong INT NOT NULL,
    nome VARCHAR(30) NOT NULL,
    idade INT NOT NULL,
    sexo CHAR(1) NOT NULL,
    historia_animal TEXT NOT NULL,
    especie CHAR(1) NOT NULL,
    porte CHAR(1) NOT NULL,
    foto VARCHAR(37) NOT NULL,
    foreign key (id_ong) references ong(id_ong),
    raca CHAR(1) NOT NULL
);
CREATE TABLE IF NOT EXISTS endereco(
	id_endereco INT AUTO_INCREMENT PRIMARY KEY,
    id_ong INT NOT NULL,
    cep CHAR(9) NOT NULL,
    numero INT NOT NULL,
    foreign key (id_ong) references ong(id_ong),
    complemento VARCHAR(20) NOT NULL,
    referencia VARCHAR (50) NOT NULL
);
CREATE TABLE IF NOT EXISTS contato(
	id_contato INT AUTO_INCREMENT PRIMARY KEY,
    id_ong INT NOT NULL,
    facebook VARCHAR(50) NOT NULL,
    instagram VARCHAR(50) NOT NULL,
    email VARCHAR(80) NOT NULL,
    whatsapp CHAR(11) NOT NULL,
    foreign key (id_ong) references ong(id_ong),
    tel_fixo CHAR(10) NOT NULL
);
CREATE TABLE IF NOT EXISTS raca(
	id_raca INT AUTO_INCREMENT PRIMARY KEY,
    raca VARCHAR (15)
);
CREATE TABLE IF NOT EXISTS vacina(
	id_vacina INT AUTO_INCREMENT PRIMARY KEY,
    vacina VARCHAR(20)
);
CREATE TABLE IF NOT EXISTS vacina_animal(
	id_vacina_animal INT AUTO_INCREMENT PRIMARY KEY,
    id_animal INT NOT NULL,
    id_vacina INT NOT NULL,
    foreign key (id_animal) references animal(id_animal),
    foreign key (id_vacina) references vacina(id_vacina)
);

