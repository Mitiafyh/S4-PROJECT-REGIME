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
    valeur float DEFAULT 50,
    status varchar(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Settings(
    id int AUTO_INCREMENT PRIMARY KEY,
    gold_discount float NOT NULL DEFAULT 0.15,
    gold_price float NOT NULL DEFAULT 10000,
    gold_currency varchar(10) NOT NULL DEFAULT 'Ar',
    promo_default_value float NOT NULL DEFAULT 50,
    promo_bonus_percent float NOT NULL DEFAULT 0,
    low_balance_threshold float NOT NULL DEFAULT 0,
    general_currency varchar(10) NOT NULL DEFAULT 'Ar',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE Regime(
    id int AUTO_INCREMENT PRIMARY KEY,
    nom varchar(255) NOT NULL,
    pourcentage_viande float NOT NULL,
    pourcentage_poisson float NOT NULL,
    pourcentage_volaille float NOT NULL,
    constatation float NOT NULL,
    duree_semaines int NOT NULL DEFAULT 4,
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
    image varchar(255) DEFAULT NULL,
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




INSERT INTO Info_Sante (user_id, poids, taille, genre)
VALUES
(1, 72.5, 1.78, 'Homme'),
(2, 61.0, 1.68, 'Femme');

INSERT INTO Regime (nom, pourcentage_viande, pourcentage_poisson, pourcentage_volaille, constatation, duree_semaines, prixParSemaine, image)
VALUES
('Plat de Steak', 40, 15, 45, 0.35, 4, 6000, 'steak-boeuf.jpg'),
('Plat de Poisson', 35, 20, 45, 0.45, 6, 7000, 'steak_saumon.jpg'),
('Plat de poulet', 20, 20, 45, 0.45, 6, 9000, 'poitrineDEpoulet.jpg'),
('Plat de Viande', 35, 20, 45, 0.45, 6, 8000, 'viande_de_poulet_grill.jpg'),
('Plat de mixer', 35, 20, 45, 0.45, 6, 10000, 'mix.jpg');

INSERT INTO Activite_Physique (type, duree, repetition, depense_calorique)
VALUES
('Musculation hypertrophie', 60, 4, 320),
('Courrir', 75, 5, 420),
('Musculation prise de masse', 3, 3, 300),
('Jumping Jack', 3, 5, 420),
('Yoga', 15, 5, 200);


-- MOT DE PASSE POUR LES UTILISATEURS :SONT HASHES DU COUP ON L'INSERT DANS LA PAGE D'INSCRIPTION
INSERT INTO User (username, email, password, role)
VALUES
('admin', 'admin@local.com', 'adminpass', 'admin');

INSERT INTO Settings (gold_discount, gold_price, gold_currency, promo_default_value, promo_bonus_percent, low_balance_threshold, general_currency)
VALUES
(0.15, 10000, 'Ar', 50, 0, 0, 'Ar');

INSERT INTO Codes (code, valeur, status)
VALUES
('PROMO50', 5000, 'active'),
('PROMO20', 2000, 'active'),
('PROMO10', 1000, 'active'),
('VIP100', 100000, 'active'),
('VVIP', 200000, 'active'),
('GOLD50', 50000, 'active'),
('GOLD10', 10000, 'active'),
('GOLD20', 20000, 'active'),
('GOLD30', 30000, 'active'),
('GOLD40', 40000, 'active'),
('GOLD60', 60000, 'active'),
('GOLD70', 70000, 'active'),
('GOLD80', 80000, 'active'),
('GOLD90', 90000, 'active'),
('GOLDENVIP', 250000, 'active');