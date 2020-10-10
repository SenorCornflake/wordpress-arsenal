<form action="options.php" method="post">
<?php
settings_fields( 'bkr_contact_links' );
do_settings_sections( 'bkr-contact-links-settings' );
submit_button();
?>
</form>
