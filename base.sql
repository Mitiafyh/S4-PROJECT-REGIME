CREATE TABLE User(
    id int AUTO_INCREMENT PRIMARY KEY,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role varchar(50) NOT NULL,
    genre varchar(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Info_Sante(
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id int NOT NULL,
    poids float NOT NULL,
    taille float NOT NULL,
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
    constatation float NOT NULL,// ex: + 0.2 kg par semaine ou - 0.2 kg par semaine
    prixParSemaine float NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Activite_Physique(
    id int AUTO_INCREMENT PRIMARY KEY,
    type varchar(255) NOT NULL,
    duree int NOT NULL, // en minutes
    repetition int NOT NULL, // nombre de fois par semaine
    depense_calorique int NOT NULL, // en calories
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);
avec 1Kcal => 0.00013 kg de poids perdu ou gagné
avec 

-- Donnees exemple pour une prise de masse
INSERT INTO User (username, email, password, role, genre)
VALUES
('adem_b', 'adem.benali@example.com', 'motdepasse123', 'user', 'Homme'),
('sara_m', 'sara.mekki@example.com', 'motdepasse123', 'user', 'Femme');

INSERT INTO Info_Sante (user_id, poids, taille)
VALUES
(1, 72.5, 1.78),
(2, 61.0, 1.68);

INSERT INTO Regime (pourcentage_viande, pourcentage_poisson, pourcentage_volaille, constatation, prixParSemaine)
VALUES
(40, 15, 45, 0.35, 72.00),
(35, 20, 45, 0.45, 68.50);

INSERT INTO Activite_Physique (type, duree, repetition, depense_calorique)
VALUES
('Musculation hypertrophie', 60, 4, 320),
('Musculation prise de masse', 75, 5, 420);

INSERT INTO User (username, email, password, role, genre)
VALUES
('admin', 'admin@local.com', 'adminpass', 'admin');

