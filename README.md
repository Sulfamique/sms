# Simple Maillage SEO

Ce plugin WordPress permet de cr\u00e9er facilement des liens internes sur tout le site.
Il ajoute un tableau de bord dans l'administration pour d\u00e9finir des couples **mot clef / URL**. A
chaque fois qu'un mot clef est trouv\u00e9 dans un contenu, il est automatiquement remplac\u00e9 par un lien vers l'URL d\u00e9finie.

Les fichiers du plugin se trouvent directement \u00e0 la racine de ce d\u00e9p\u00f4t : `simple-maillage-seo.php`, le dossier `admin` et le dossier `includes`.

## Installation

1. Copiez le dossier du d\u00e9p\u00f4t dans `wp-content/plugins/simple-maillage-seo/` de votre site WordPress.
2. Activez l'extension **Simple Maillage SEO** depuis l'administration WordPress.
3. Assurez-vous que l'extension PHP **DOM** est install\u00e9e : elle est n\u00e9cessaire pour analyser le contenu et ins\u00e9rer les liens.

## Utilisation

- Dans le menu "Maillage SEO", saisissez un mot clef et l'URL cible puis cliquez sur **Valider**.
- Le mot clef appara\u00eet dans la liste et peut \u00eatre supprim\u00e9 \u00e0 tout moment.
- L'URL est automatiquement li\u00e9e \u00e0 la premi\u00e8re occurrence du mot clef pr\u00e9sente dans vos articles et pages existants.
- Le plugin \u00e9vite de cr\u00e9er des liens dans les titres, le sommaire ou le fil d'Ariane afin de privil\u00e9gier le contenu principal.
