INSERT INTO `role` (lib) VALUES ('admin'), ('gold'), ('user');

INSERT INTO
    `user` (email, mdp, `roleId`)
VALUES (
        'admin@gmail.com',
        '$2y$12$y0BXJsdNekN6xWnasg.N.eLo77Sb6jQaVAhj5cVCFxsSMLgJUOuwy',
        1
    );

INSERT INTO avantage (`roleId`, reduction) VALUES (2, 15);

INSERT INTO `code` (lib, `status`, userid) VALUES ('hd7t83', FALSE, 1);

INSERT INTO
    objectif (lib)
VALUES ('Perte de poids'),
    ('Prise de masse'),
    ('Atteindre mon IMC idéal');

INSERT INTO
    ingredients (lib, `prixG`)
VALUES ('Viande', 22),
    ('Poisson', 30),
    ('Volaille', 18);

INSERT INTO
    programme (
        nom,
        `objId`,
        `nombreJour`,
        poids
    )
VALUES ('Programme 1', 1, 90, 5),
    ('Programme 2', 2, 120, 20);

INSERT INTO
    regime (`nomPlat`, `poidsTotalPlat`)
VALUES ('Plat 1', 300),
    ('Plat 2', 500),
    ('Plat 3', 400),
    ('Plat 4', 450),
    ('Plat 5', 550);

-- Régime programme 1
INSERT INTO
    `progammeRegime` (
        `programmeId`,
        `regimeId`,
        jour
    )
VALUES (1, 1, 1),
    (1, 2, 2),
    (1, 1, 3),
    (1, 2, 4),
    (1, 1, 5),
    (1, 1, 6),
    (1, 2, 7);

-- Régime programme 2
INSERT INTO
    `progammeRegime` (
        `programmeId`,
        `regimeId`,
        jour
    )
VALUES (2, 3, 1),
    (2, 4, 2),
    (2, 3, 3),
    (2, 4, 4),
    (2, 3, 5),
    (2, 4, 6),
    (2, 5, 7);

INSERT INTO
    sport (exercices)
VALUES ('Marche'),
    ('Jumping jack'),
    ('Abdomnaux'),
    ('Pompes'),
    ('Squat');

-- Sport programme 1
INSERT INTO
    `programmeSport` (`programmeId`, sportid, jour)
VALUES (1, 1, 1),
    (1, 2, 1),
    (1, 4, 1),
    (1, 2, 2),
    (1, 5, 2),
    (1, 1, 3),
    (1, 3, 3),
    (1, 2, 4),
    (1, 1, 5),
    (1, 4, 5),
    (1, 2, 6),
    (1, 1, 6),
    (1, 3, 6),
    (1, 2, 7);

-- Sport programme 2
INSERT INTO
    `programmeSport` (`programmeId`, sportid, jour)
VALUES (2, 3, 1),
    (2, 4, 1),
    (2, 5, 1),
    (2, 3, 2),
    (2, 4, 2),
    (2, 5, 2),
    (2, 3, 3),
    (2, 4, 3),
    (2, 5, 3),
    (2, 3, 4),
    (2, 4, 4),
    (2, 5, 4),
    (2, 3, 5),
    (2, 4, 5),
    (2, 5, 5),
    (2, 3, 6),
    (2, 4, 6),
    (2, 5, 6),
    (2, 3, 7),
    (2, 4, 7),
    (2, 5, 7);

INSERT INTO
    `ingredientRegime` (
        `regimeId`,
        `ingredientId`,
        pourcentage
    )
VALUES (1, 1, 20),
    (1, 2, 80),
    (2, 1, 20),
    (2, 2, 20),
    (2, 3, 60),
    (3, 1, 30),
    (3, 2, 30),
    (3, 3, 40),
    (4, 1, 10),
    (4, 3, 90),
    (5, 2, 50),
    (5, 3, 50);