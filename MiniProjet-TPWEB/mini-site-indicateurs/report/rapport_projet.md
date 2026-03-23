# Rapport de projet - Mini-site d'indicateurs Rubik

## 1. URL d'acces au site

- URL: `http://stentzey.etu-mysql.iut2.univ-grenoble-alpes.fr/Mini-Site/mini-site-indicateurs/web/index.php`

## 2. Sujet et donnees utilisees

Le mini-site porte sur l'analyse des 1000 résolutions les plus rapides de Rubik's Cube.

- Source: Kaggle - Top 1000 fastest Rubik's cube solves
- Lien source: https://www.kaggle.com/datasets/darshanvss/top-1000-fastest-rubiks-cube-solves/data
- Fichier de depart: `solves.csv`

### 2.1 Structure des donnees

La table principale `solves` contient:

- `result_rank`: rang du resultat
- `person`: nom du participant
- `solve_1` a `solve_5`: temps individuels (ms)
- `fastest_solve`: meilleur temps de la ligne (ms)
- `country`: pays du participant

### 2.2 Chargement en base

- Script schema: `database/01_schema.sql`
- Script import: `database/02_import_data.sql`
- Verification import: 1000 lignes dans `solves`

## 3. Liste des indicateurs et justification

Le projet privilegie des indicateurs simples, lisibles, et utiles pour un mini-site pedagogique.

### Indicateur 1 - Nombre total de solves

- Objectif: verifier le volume de donnees exploite.
- Interet: confirme la couverture globale des analyses.

### Indicateur 2 - Moyenne / minimum / maximum de `fastest_solve`

- Objectif: donner un niveau global de performance.
- Interet: met en evidence la tendance centrale et les extremes.

### Indicateur 3 - Top pays par nombre de solves

- Objectif: observer la repartition geographique.
- Interet: identifie les pays les plus representes dans le top.

### Indicateur 4 - Top personnes les plus presentes

- Objectif: detecter les competiteurs recurrents.
- Interet: montre quels profils reviennent souvent avec de bonnes performances.

### Indicateur 5 - Distribution par tranches de `fastest_solve`

- Objectif: segmenter les performances par niveau.
- Interet: facilite la lecture visuelle (graphiques) et la comparaison entre tranches.

### Indicateur 6 - Top 10 meilleurs `fastest_solve`

- Objectif: afficher les meilleures performances absolues.
- Interet: donne un classement direct des meilleurs temps.

## 4. Architecture du mini-site

Le site est compose de 4 pages principales conformes aux consignes:

- `index.php` (accueil)
- `indicateurs.php` (indicateurs SQL)
- `analyse.php` (formulaire de filtrage)
- `graphiques.php` (graphes dynamiques)

Composants partages:

- `includes/header.php`, `includes/menu.php`, `includes/footer.php`
- `includes/db.php` pour la connexion MySQL via `.env`

## 5. Requetes SQL des indicateurs

Les requetes sont centralisees dans:

- `database/03_indicateurs.sql`
- `docs/requetes_sql.md`

Resume des requetes utilisees:

- KPI globaux: `COUNT`, `AVG`, `MIN`
- Top pays: `GROUP BY country` + `ORDER BY`
- Top personnes: `GROUP BY person, country`
- Analyse utilisateur: requete preparee avec filtres `country` et `max_fastest`
- Distribution: `CASE WHEN` pour creer les tranches

## 6. Captures d'ecran a inserer

### Capture 1 - Page d'accueil

-  `report/captures/01_accueil.png`

### Capture 2 - Page indicateurs

- `report/captures/02_indicateurs.png`

### Capture 4 - Page analyse 

- `report/captures/03_analyse.png`

### Capture 5 - Page graphiques

- `report/captures/04_graphiques.png`


## 7. Bilan du projet

### 7.1 Apports personnels

- Consolidation SQL: agregations, filtres, groupements, tranches.
- Consolidation PHP/PDO: requetes preparees, securisation, affichage dynamique.
- Consolidation web: structuration en pages, composants communs, ergonomie.

### 7.2 Difficultes rencontrees

- Structuration initiale des scripts SQL (separer schema et import).
- Choix d'indicateurs pertinents sans surcharger le site.
- Création du style CSS + JS (utilisation de l'intelligence artificielle pour générer le tout et avoir un beau site)

### 7.3 Pistes d'amelioration

- Ajouter des filtres multi-criteres (pays + intervalle de rang).
- Ajouter un export CSV des resultats de la page analyse.
- Ajouter une page CRUD simple (insertion/modification/suppression).

