-- 03_indicateurs.sql
-- Requetes d'indicateurs pour le mini-site

-- 1) Volume global
SELECT COUNT(*) AS total_solves FROM solves;

-- 2) Temps moyen, min, max du fastest_solve
SELECT
	AVG(fastest_solve) AS avg_fastest_ms,
	MIN(fastest_solve) AS min_fastest_ms,
	MAX(fastest_solve) AS max_fastest_ms
FROM solves;

-- 3) Top 10 pays par nombre de solves
SELECT country, COUNT(*) AS nb_solves
FROM solves
GROUP BY country
ORDER BY nb_solves DESC, country ASC
LIMIT 10;

-- 4) Top 10 personnes les plus presentes
SELECT
	person,
	country,
	COUNT(*) AS nb_entries,
	MIN(fastest_solve) AS best_fastest_ms
FROM solves
GROUP BY person, country
ORDER BY nb_entries DESC, best_fastest_ms ASC
LIMIT 10;

-- 5) Repartition du fastest_solve par tranches
SELECT
	CASE
		WHEN fastest_solve < 400 THEN 'lt400'
		WHEN fastest_solve BETWEEN 400 AND 449 THEN '400_449'
		WHEN fastest_solve BETWEEN 450 AND 499 THEN '450_499'
		WHEN fastest_solve BETWEEN 500 AND 549 THEN '500_549'
		ELSE 'gte550'
	END AS bucket,
	COUNT(*) AS nb
FROM solves
GROUP BY bucket
ORDER BY bucket;

-- 6) Top 10 meilleurs fastest_solve
SELECT result_rank, person, country, fastest_solve
FROM solves
ORDER BY fastest_solve ASC, result_rank ASC
LIMIT 10;

