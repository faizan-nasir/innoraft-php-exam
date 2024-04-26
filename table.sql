create table if not exists user (
  first_name varchar(50) not null,
  last_name varchar(50) not null,
  email varchar(50) primary key,
  password varchar(255) not null
  );

create table if not exists stocks (
  id int auto_increment primary key,
  email varchar(255) not null,
  stock varchar(50) not null,
  price int not null,
  created varchar(255),
  last_updated varchar(255),
  foreign key (email) references user(email) on delete cascade
);
