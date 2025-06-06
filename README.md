# Simple Maillage SEO

Ce plugin WordPress permet de créer facilement des liens internes sur tout le site.
Il ajoute un tableau de bord dans l'administration pour définir des couples **mot clef / URL**. Chaque fois qu'un mot clef est trouvé dans un contenu, il est automatiquement remplacé par un lien vers l'URL définie.

Les fichiers du plugin se trouvent directement à la racine de ce dépôt : `simple-maillage-seo.php`, le dossier `admin` et le dossier `includes`.

## Installation

1. Copiez ce dossier dans `wp-content/plugins/simple-maillage-seo/` de votre site WordPress.
2. Activez l'extension **Simple Maillage SEO** depuis l'administration WordPress.
3. Assurez-vous que l'extension PHP **DOM** est installée : elle est nécessaire pour analyser le contenu et insérer les liens.

## Utilisation

- Dans le menu "Maillage SEO", saisissez un mot clef et l'URL cible puis cliquez sur **Valider**.
- Le mot clef apparaît dans la liste et peut être supprimé à tout moment.
- L'URL est automatiquement liée à la première occurrence du mot clef présente dans vos articles et pages existants.
- Le plugin évite de créer des liens dans les titres, le sommaire ou le fil d'Ariane afin de privilégier le contenu principal.
