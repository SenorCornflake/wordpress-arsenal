<form action="<?php echo esc_url(admin_url("admin-post.php")); ?>" id="bkr_contacts_form" method="post">
	<?php
		BKR_Contacts::display_edit_contacts_form_contents();
	?>
</form>

