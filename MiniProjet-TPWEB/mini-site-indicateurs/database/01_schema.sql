-- 01_schema.sql
-- Structure de l'entrepot de donnees

CREATE TABLE IF NOT EXISTS solves (
	result_rank INTEGER PRIMARY KEY,
	person VARCHAR(200) NOT NULL,
	solve_1 INTEGER NULL,
	solve_2 INTEGER NULL,
	solve_3 INTEGER NULL,
	solve_4 INTEGER NULL,
	solve_5 INTEGER NULL,
	fastest_solve INTEGER NOT NULL,
	country VARCHAR(100) NOT NULL
);
