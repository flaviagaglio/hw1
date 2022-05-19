create database HomeWork;

use HomeWork;

create table utente (
	nome varchar(20),
    cognome varchar(20),
    email varchar(30),
    nomeutente varchar(30) unique,
    pass varchar(30),
    id_utente integer auto_increment primary key
) Engine = 'InnoDB';

create table raccolta (
	titolo varchar(50),
    img_url varchar(256),
    id_raccolta integer auto_increment primary key,
    nome_utente varchar(30),
    index indice_nome(nome_utente),
	foreign key(nome_utente) references utente(nomeutente)
) Engine = 'InnoDB';

create table contenuto (
	id_contenuto integer auto_increment primary key,
    id_risorsa_spotify varchar(256),
    titolo varchar(100),
    img_url varchar(256),
    nome_album varchar(100),
    artisti varchar(256)
) Engine = 'InnoDB';

create table associazione (
	id_raccolta integer,
    id_contenuto integer,
    primary key(id_raccolta, id_contenuto),
    index indice_raccolta(id_raccolta),
    foreign key(id_raccolta) references raccolta(id_raccolta),
    index indice_contenuto(id_contenuto),
    foreign key(id_contenuto) references contenuto(id_contenuto)
) Engine = 'InnoDB';

