drop database if exists democontact ;
create database democontact; 
use democontact ;

create table contact
(
	id int(10) not null auto_increment,
	nom varchar(128) not null,
	email varchar(128) not null,
	numtelephone varchar(35) not null, 
	date_creation date not null,
	primary key (id)	
);
