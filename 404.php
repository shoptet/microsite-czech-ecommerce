<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package ceskaecommerce
 */

get_header();
?>

	<div id="main" class="main">
		<div class="row-main">
			<div class="b-content">
				<h1>404</h1>
				<p>
					Hledali jsme, ale tuhle stránku jsme nenašli.<br />
					Nejlepší bude začít od začátku.
				</p>
				<p><a href="<?php echo home_url(); ?>" class="btn"><span class="btn__text">Jít na úvod</span></a></p>
			</div>
		</div>
	</div>

<?php
get_footer();
?>
