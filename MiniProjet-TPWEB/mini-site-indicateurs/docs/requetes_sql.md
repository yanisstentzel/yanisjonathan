# Requetes SQL principales

## KPI globaux

```sql
SELECT COUNT(*) AS total_solves,
			 AVG(fastest_solve) AS avg_fastest,
			 MIN(fastest_solve) AS best_fastest
FROM solves;
```

## Top pays

```sql
SELECT country, COUNT(*) AS nb_solves
FROM solves
GROUP BY country
ORDER BY nb_solves DESC, country ASC
LIMIT 10;
```

## Top personnes

```sql
SELECT person, country, COUNT(*) AS nb_entries, MIN(fastest_solve) AS best_time
FROM solves
GROUP BY person, country
ORDER BY nb_entries DESC, best_time ASC
LIMIT 10;
```

## Analyse filtre utilisateur

```sql
SELECT result_rank, person, country, fastest_solve
FROM solves
WHERE country LIKE :country
	AND fastest_solve <= :max_fastest
ORDER BY fastest_solve ASC, result_rank ASC
LIMIT 100;
```

## Distribution des temps

```sql
SELECT CASE
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
```

