# Architecture du mini-site

## Plan des pages

- `index.php` : presentation du sujet, des donnees et des objectifs.
- `indicateurs.php` : affichage des indicateurs principaux (KPI + tableaux).
- `analyse.php` : formulaire de filtrage et resultats personnalises.
- `graphiques.php` : visualisations dynamiques via Chart.js.

## Composants communs

- `includes/header.php` : structure HTML de base + chargement CSS.
- `includes/menu.php` : navigation principale entre les 4 pages.
- `includes/footer.php` : pied de page + chargement JS.
- `includes/db.php` : connexion PDO MySQL via variables `.env`.

## Assets front-end

- `assets/css/style.css` : styles globaux et mise en page responsive.
- `assets/js/main.js` : effets de chargement legers.
- `assets/js/charts.js` : construction des graphiques.

## Flux d'execution

1. L'utilisateur ouvre une page.
2. La page charge `header`, `menu`, puis son contenu.
3. Les pages dynamiques executent des requetes SQL via `db.php`.
4. `footer` injecte les scripts JS communs et, si besoin, Chart.js.

