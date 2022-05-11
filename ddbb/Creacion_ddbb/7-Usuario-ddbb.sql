
DROP USER IF EXISTS 'p-voca-user'@'localhost';
FLUSH PRIVILEGES;

CREATE USER 'p-voca-user'@'localhost' IDENTIFIED BY 'ALejandra2019';

REVOKE ALL PRIVILEGES ON *.* FROM 'p-voca-user'@'localhost'; 
REVOKE GRANT OPTION ON *.* FROM 'p-voca-user'@'localhost'; 
GRANT SELECT, INSERT, UPDATE ON `prueba-vocacional`.* TO 'p-voca-user'@'localhost' ;

FLUSH PRIVILEGES;
