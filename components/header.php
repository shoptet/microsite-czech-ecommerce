<?php
/*
 * Header component
 */
?>

<header role="banner" class="header">

	<?php
		// BRANDING
		include( locate_template( 'components/header/branding.php', false, false ) );

		// MENU
		include( locate_template( 'components/header/menu.php', false, false ) );
	?>

</header>
