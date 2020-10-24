# Wordpress Arsenal
I use this repositiry to store all my custom made wordpress plugins.

## List
1. BKR-contact-links: Displays contact links such as your email, contact number and other social media like twitter or instagram
2. BKR-hook-snippets: Adds a post type whose content will be displayed at whatever hook is provided.
3. BKR-post-series: Adds a taxonomy used to group posts in a multipart series.
3. BKR-taxonomy-images: Adds an image setting in all taxonomies' edit and add page.

## How to use
### BKR-contact-links
Call the hook `bkr_contact_links_display` with two arrays as arguments, the first contains the names of the social media to exclude and the second contains the the name of the social media to exclude their labels, only showing their icons.

Example: `do_action("bkr_contact_links_display", ["facebook", "twitter"], ["youtube", "instagram", "email"])`
