DROP DATABASE IF EXISTS Mediator;
CREATE DATABASE Mediator;
USE Mediator;

DROP TABLE IF EXISTS Persons;
CREATE TABLE Persons
(
    PersonID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(255),
    LastName VARCHAR(255),
    BirthDate DATE,
    BirthPlace VARCHAR(255),
    DeathDate DATE,
    DeathPlace VARCHAR(255),
    Biography TEXT,
    Awards VARCHAR(255),
    PicturePath VARCHAR(255)
);

DROP TABLE IF EXISTS Movies;
CREATE TABLE Movies
(
    MovieID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(255),
    Rating VARCHAR(255),
    ReleaseDate DATE,
    Duration INT,
    Genres VARCHAR(255),
    Grade FLOAT,
    Synopsis TEXT,
    Review TEXT,
    PosterPath VARCHAR(255),
    BackdropPath VARCHAR(255),
    TrailerPath VARCHAR(255),
    Requester INT,
    RequestDate DATETIME,
    AddDate DATETIME
);

DROP TABLE IF EXISTS Series;
CREATE TABLE Series
(
    SeriesID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(255),
    StartYear YEAR,
    EndYear YEAR,
    Genres VARCHAR(255),
    Grade INT,
    Synopsis TEXT,
    Review TEXT,
    PosterPath VARCHAR(255),
    BackdropPath VARCHAR(255),
    TrailerPath VARCHAR(255),
    Requester INT,
    RequestDate DATETIME,
    AddDate DATETIME
);

DROP TABLE IF EXISTS Roles;
CREATE TABLE Roles
(
    PersonID INT NOT NULL,
    TypeID INT NOT NULL,
    ContentID INT NOT NULL,
    PRIMARY KEY (PersonID, TypeID, ContentID)
);


INSERT INTO Movies
    (Title, Rating, ReleaseDate, Duration, Genres, Grade, Synopsis, PosterPath, TrailerPath, Requester, RequestDate, AddDate)
VALUES
    ("Joker", "Interdit aux moins de 12 ans avec avertissement", "2019-10-09", 122, "Drame", 84.67, "Le film, qui relate une histoire originale inédite sur grand écran, se focalise sur la figure emblématique de l’ennemi juré de Batman. Il brosse le portrait d’Arthur Fleck, un homme sans concession méprisé par la société.", "https://fr.web.img6.acsta.net/c_215_290/pictures/19/09/03/12/02/4765874.jpg", "https://youtube.com/watch?v=zAGVQLHvwOY", 1, NOW(), NOW()),
    ("Ad Astra", "Tous publics", "2019-09-18", 124, "Science-fiction, Drame", 64, "L’astronaute Roy McBride s’aventure jusqu’aux confins du système solaire à la recherche de son père disparu et pour résoudre un mystère qui menace la survie de notre planète. Lors de son voyage, il sera confronté à des révélations mettant en cause la nature même de l’existence humaine, et notre place dans l’univers.", "https://fr.web.img2.acsta.net/c_215_290/pictures/19/08/13/14/44/4638430.jpg", "https://youtube.com/watch?v=P6AaSMfXHbA", 1, NOW(), NOW());

INSERT INTO Series
    (Title, StartYear, EndYear, Genres, Grade, Synopsis, PosterPath, TrailerPath, Requester, RequestDate, AddDate)
VALUES 
    ("Game of Thrones", 2011, 2019, "Drame, Fantastique", 89.67, "Il y a très longtemps, à une époque oubliée, une force a détruit l'équilibre des saisons. Dans un pays où l'été peut durer plusieurs années et l'hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes. La confrérie de la Garde de Nuit, protégeant le Royaume de toute créature pouvant provenir d'au-delà du Mur protecteur, n'a plus les ressources nécessaires pour assurer la sécurité de tous. Après un été de dix années, un hiver rigoureux s'abat sur le Royaume avec la promesse d'un avenir des plus sombres. Pendant ce temps, complots et rivalités se jouent sur le continent pour s'emparer du Trône de Fer, le symbole du pouvoir absolu.", "http://fr.web.img3.acsta.net/c_216_288/pictures/19/03/21/17/05/1927893.jpg", "https://youtube.com/watch?v=BpJYNVhGf1s", 1, NOW(), NOW()),
    ("Breaking Bad", 2008, 2013, "Drame", 91, "Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour subvenir aux besoins de Skyler, sa femme enceinte, et de Walt Junior, son fils handicapé, il est obligé de travailler doublement. Son quotidien déjà morose devient carrément noir lorsqu'il apprend qu'il est atteint d'un incurable cancer des poumons. Les médecins ne lui donnent pas plus de deux ans à vivre. Pour réunir rapidement beaucoup d'argent afin de mettre sa famille à l'abri, Walter ne voit plus qu'une solution : mettre ses connaissances en chimie à profit pour fabriquer et vendre du crystal meth, une drogue de synthèse qui rapporte beaucoup. Il propose à Jesse, un de ses anciens élèves devenu un petit dealer de seconde zone, de faire équipe avec lui. Le duo improvisé met en place un labo itinérant dans un vieux camping-car. Cette association inattendue va les entraîner dans une série de péripéties tant comiques que pathétiques.", "http://fr.web.img2.acsta.net/c_216_288/pictures/19/06/18/12/11/3956503.jpg", "https://youtube.com/watch?v=HhesaQXLuRY", 1, NOW(), NOW());
