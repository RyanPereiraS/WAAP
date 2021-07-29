create database if not exists WAAP;
use WAAP;

create table if not exists ong(
id int primary key auto_increment,
nome varchar(50) not null,
certificado varchar(37) not null,
status int(1) not null
);

create table if not exists contato(
id int primary key auto_increment,
facebook varchar(50),
instagram varchar(50),
email varchar(80),
site varchar(80),
id_ong int,
foreign key (id_ong) references ong(id)
);

create table if not exists endereco(
id int primary key auto_increment,
cep char(9),
numero varchar(4),
complemento varchar(15),
id_ong int,
foreign key (id_ong) references ong(id)
);

create table if not exists telefone(
id int auto_increment primary key,
ddd char(3),
telefone varchar(10),
id_endereco int,
foreign key (id_endereco) references endereco(id)
);

create table if not exists animal(
id int primary key auto_increment,
nome varchar(20),
idade int(2),
porte char(1),
vacinado boolean,
medicado boolean,
foto varchar(37),
historia text,
status char(1),
id_ong int,
id_endereco int,
foreign key (id_ong) references ong(id),
foreign key (id_endereco) references endereco(id)
);

create table if not exists usuario(
id int primary key auto_increment,
nome varchar(80),
telefone varchar(11),
ddd char(3),
email varchar(80),
senha char(40),
nascimento date
);

create table if not exists adotados(
id int auto_increment primary key,
id_animal int,
id_usuario int,
foreign key (id_animal) references animal(id),
foreign key (id_usuario) references usuario(id)
);