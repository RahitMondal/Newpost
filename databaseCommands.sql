/*creating members table*/
create table if not exists members(
    user_id smallint unsigned auto_increment not null primary key,
    full_name varchar(60) not null,
    user_name varchar(20) unique not null,
    email_id varchar(30) unique not null,
    phone varchar(13),
    dob date,
    about varchar(255),
    address varchar(80),
    pic_name varchar(28),
    password mediumtext not null

);

alter table members add full_name varchar(60) not null;
alter table members drop column occupation;
alter table members add about varchar(255);
alter table members add dob date;

create table if not exists posts(
    post_id int unsigned auto_increment not null primary key,
    user_name varchar(20) not null,
    post_time timestamp default current_timestamp on update current_timestamp,
    post_description varchar(400)
)

alter table posts drop COLUMN post_owner;

SELECT pic_name, full_name, post_description, post_time
from members
inner join posts using(user_id)
order by post_time desc;

create table followers(
    followed_person varchar(20) not null,
    follower varchar(20) not null
);