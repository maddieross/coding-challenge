USE heroku_27a5636b1b521da;
CREATE TABLE users (
    userID INT NOT NULL PRIMARY KEY,
    userName VARCHAR(100) NOT NULL,
	email VARCHAR(32) NOT NULL,
    pw VARCHAR(32) NOT NULL
);