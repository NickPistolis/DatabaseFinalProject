DROP DATABASE IF EXISTS challenge4;
CREATE DATABASE challenge4;
USE challenge4;



CREATE TABLE library(
    isbn VARCHAR(13) Primary Key,
    name VARCHAR(255),
    author VARCHAR(255),
    publisher VARCHAR(255),
    year year(4),
    edition VARCHAR(255),
    type BOOLEAN,
    inStock BOOLEAN
    
    
);
