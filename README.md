# Wordpress Arsenal
I use this repositiry to store all my custom made wordpress plugins.

## List
1. BKR-contacts: Displays contact links such as your email, contact number and other social media like twitter or instagram
2. BKR-hook-snippets: Adds a post type whose content will be displayed at whatever hook is provided.
3. BKR-post-series: Adds a taxonomy used to group posts in a multipart series.
3. BKR-taxonomy-images: Adds an image setting in all taxonomies' edit and add page.
4. bkr-gallery-block: Adds an image slider block to gutenberg

## How to use ( only for plugins that require explanation )
### BKR-contact-links
Register a zone for your theme using the function `BKR_Contact::register_zone($slug, $name)` in the `after_setup_theme` hook, then call the hook `bkr_contacts_zone` with the zone's slug as a parameter wherever you want to display it in your theme.
