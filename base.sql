CREATE DATABASE IF NOT EXISTS RegimeSante;
USE RegimeSante;

CREATE TABLE User(
    id int AUTO_INCREMENT PRIMARY KEY,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role varchar(50) default 'user',
    modeGold BOOLEAN DEFAULT FALSE,
    argent float DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Info_Sante(
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id int NOT NULL,
    poids float NOT NULL,
    taille float NOT NULL,
    genre varchar(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE
);
CREATE TABLE Codes(
    id int AUTO_INCREMENT PRIMARY KEY,
    code varchar(255) NOT NULL,
    status varchar(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Regime(
    id int AUTO_INCREMENT PRIMARY KEY,
    pourcentage_viande float NOT NULL,
    pourcentage_poisson float NOT NULL,
    pourcentage_volaille float NOT NULL,
    constatation float NOT NULL,
    prixParSemaine float NOT NULL,
    image varchar(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Activite_Physique(
    id int AUTO_INCREMENT PRIMARY KEY,
    type varchar(255) NOT NULL,
    duree int NOT NULL,
    repetition int NOT NULL,
    depense_calorique int NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Objectif(
    id int AUTO_INCREMENT PRIMARY KEY,
    description varchar(255) NOT NULL,
    image varchar(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Regime_Activite_User_Objectif(
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id int NOT NULL,
    regime_id int NOT NULL,
    activite_id int NOT NULL,
    objectif_id int NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (regime_id) REFERENCES Regime(id) ON DELETE CASCADE,
    FOREIGN KEY (activite_id) REFERENCES Activite_Physique(id) ON DELETE CASCADE,
    FOREIGN KEY (objectif_id) REFERENCES Objectif(id) ON DELETE CASCADE
);



INSERT INTO Objectif (description, image) VALUES
('Perte de poids', 'perte-poids.svg'),
('Prise de masse', 'prise-masse.svg'),
('Maintien du poids Avec IMC normal', 'maintien-poids.svg');

-- Donnees exemple pour une prise de masse
INSERT INTO User (username, email, password, role)
VALUES
('adem_b', 'adem.benali@example.com', 'motdepasse123', 'user'),
('sara_m', 'sara.mekki@example.com', 'motdepasse123', 'user');

INSERT INTO Info_Sante (user_id, poids, taille, genre)
VALUES
(1, 72.5, 1.78, 'Homme'),
(2, 61.0, 1.68, 'Femme');

INSERT INTO Regime (pourcentage_viande, pourcentage_poisson, pourcentage_volaille, constatation, prixParSemaine, image)
VALUES
(40, 15, 45, 0.35, 72.00, 'regime-1.svg'),
(35, 20, 45, 0.45, 68.50, 'regime-2.svg');

INSERT INTO Activite_Physique (type, duree, repetition, depense_calorique)
VALUES
('Musculation hypertrophie', 60, 4, 320),
('Musculation prise de masse', 75, 5, 420);

INSERT INTO User (username, email, password, role)
VALUES
('admin', 'admin@local.com', 'adminpass', 'admin');

