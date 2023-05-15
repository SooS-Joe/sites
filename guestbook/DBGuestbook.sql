CREATE TABLE guestbook_administrators(
    UserAdmin VARCHAR(32) PRIMARY KEY NOT NULL,
    Nome VARCHAR(32) NOT NULL,
    Cognome VARCHAR(32) NOT NULL,
    Email VARCHAR(64) NOT NULL,
    Pword CHAR(60) NOT NULL
);

CREATE TABLE guestbook_users(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(32) NOT NULL,
    Cognome VARCHAR(32) NOT NULL,
    Email VARCHAR(64) NOT NULL,
    Pword CHAR(60) NOT NULL,
    NewsOK BOOLEAN NOT NULL,
    Attivo BOOLEAN NOT NULL
);

CREATE TABLE guestbook_newsletters(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Titolo TEXT,
    MessaggioNews TEXT,
    DataPubblicazione DATE,
    UserAdmin VARCHAR(32),
    FOREIGN KEY(UserAdmin) REFERENCES guestbook_administrators(UserAdmin) ON DELETE SET NULL
);

CREATE TABLE guestbook_sendednews(
    IDNewsletter INT,
    IDUser INT,
    DataInvio DATE,
    PRIMARY KEY(IDNewsletter, IDUser),
    FOREIGN KEY(IDNewsletter) REFERENCES guestbook_newsletters(ID) ON DELETE SET NULL,
    FOREIGN KEY(IDUser) REFERENCES guestbook_users(ID) ON DELETE SET NULL
);

CREATE TABLE guestbook_comments(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    IDNewsletter INT,
    IDUser INT,
    Comment TEXT,
    DataInvio DATE,
    FOREIGN KEY(IDNewsletter) REFERENCES guestbook_newsletters(ID) ON DELETE CASCADE,
    FOREIGN KEY(IDUser) REFERENCES guestbook_users(ID) ON DELETE CASCADE
);

CREATE TABLE guestbook_likes(
    IDNewsletter INT,
    IDUser INT,
    PRIMARY KEY(IDNewsletter, IDUser),
    FOREIGN KEY(IDNewsletter) REFERENCES guestbook_newsletters(ID) ON DELETE CASCADE,
    FOREIGN KEY(IDUser) REFERENCES guestbook_users(ID) ON DELETE CASCADE
);

CREATE TABLE guestbook_activationcodes(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Codice CHAR(10),
    IDUser INT,
    FOREIGN KEY(IDUser) REFERENCES guestbook_users(ID) ON DELETE CASCADE
);