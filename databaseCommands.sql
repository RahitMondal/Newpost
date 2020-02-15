/*creating members table*/
create table if not exists members(
    user_id int unsigned auto_increment not null primary key,
    user_name varchar(20) unique not null,
    email_id varchar(30) unique not null,
    phone varchar(13),
    address varchar(255),
    likes varchar(255),
    occupation varchar(60),
    password varchar(32) not null

);

alter table members add full_name varchar(60) not null;
