# Simple Maillage SEO

Ce plugin WordPress permet de créer facilement des liens internes sur tout le site. Il ajoute un tableau de bord dans l'administration où vous pouvez définir des couples **mot clé / URL**. Chaque fois qu’un mot clé est trouvé dans un contenu, il est automatiquement remplacé par un lien vers l’URL définie.

Le dossier du plugin contient également une feuille de style `admin/css/admin.css` pour améliorer l'affichage du tableau de bord.

## Installation

1. Copier le dossier `simple-maillage-seo` dans le répertoire `wp-content/plugins/` de votre site WordPress.
2. Activer l'extension "Simple Maillage SEO" depuis l'administration WordPress.
3. Vérifiez que l'extension PHP **DOM** est installée : elle est nécessaire pour analyser le contenu et insérer les liens.

## Utilisation

- Dans le menu "Maillage SEO", saisissez un mot clé et l'URL cible puis cliquez sur **Valider**.
- Le mot clé apparaît dans la liste et peut être supprimé à tout moment.
- L'URL est automatiquement liée à la première occurrence du mot clé présente dans vos articles et pages existants.
- Le plugin évite de créer des liens dans les titres, le sommaire ou le fil d'ariane pour privilégier uniquement le contenu principal.
