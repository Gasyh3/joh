USE influmatch;

INSERT INTO types (nom) VALUES
('Post Instagram'),
('Story Instagram'),
('Video TikTok'),
('Placement YouTube');

INSERT INTO marques (nom, adresse) VALUES
('GlowLab', '12 rue des Lilas, Paris'),
('UrbanStep', '88 avenue République, Lyon'),
('GreenPulse', '5 boulevard Victor, Marseille');

INSERT INTO propositions (montant, description, marque_id, type_id, image_pitch) VALUES
(500.00, 'Campagne printemps pour nouvelle gamme', 1, 1, NULL),
(300.00, 'Mise en avant d une paire exclusive', 2, 2, NULL),
(1200.00, 'Video test produit et avis honnête', 3, 4, NULL),
(750.00, 'Routine skincare en video courte', 1, 3, NULL);
