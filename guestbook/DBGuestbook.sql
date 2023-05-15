CREATE DATABASE Guestbook;

USE Guestbook;

CREATE TABLE Guestbook_Administrators(
    UserAdmin VARCHAR(32) PRIMARY KEY NOT NULL,
    Nome VARCHAR(32) NOT NULL,
    Cognome VARCHAR(32) NOT NULL,
    Email VARCHAR(64) NOT NULL,
    Pword CHAR(60) NOT NULL
);

CREATE TABLE Guestbook_Users(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(32) NOT NULL,
    Cognome VARCHAR(32) NOT NULL,
    Email VARCHAR(64) NOT NULL,
    Pword CHAR(60) NOT NULL,
    NewsOK BOOLEAN NOT NULL,
    Attivo BOOLEAN NOT NULL
);

CREATE TABLE Guestbook_Newsletters(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Titolo TEXT,
    MessaggioNews TEXT,
    UserAdmin VARCHAR(32),
    FOREIGN KEY(UserAdmin) REFERENCES Guestbook_Administrators(UserAdmin)
);

CREATE TABLE Guestbook_SendedNews(
    IDNewsletter INT,
    IDUser INT,
    PRIMARY KEY(IDNewsletter, IDUser),
    FOREIGN KEY(IDNewsletter) REFERENCES Guestbook_Newsletters(ID),
    FOREIGN KEY(IDUser) REFERENCES Guestbook_Users(ID)
);

CREATE TABLE Guestbook_Comments(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    IDNewsletter INT,
    IDUser INT,
    Comment TEXT,
    FOREIGN KEY(IDNewsletter) REFERENCES Guestbook_Newsletters(ID),
    FOREIGN KEY(IDUser) REFERENCES Guestbook_Users(ID)
);

CREATE TABLE Guestbook_Likes(
    IDNewsletter INT,
    IDUser INT,
    PRIMARY KEY(IDNewsletter, IDUser),
    FOREIGN KEY(IDNewsletter) REFERENCES Guestbook_Newsletters(ID),
    FOREIGN KEY(IDUser) REFERENCES Guestbook_Users(ID)
);