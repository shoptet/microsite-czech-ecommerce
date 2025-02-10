<div class="row-main" id="mainBrandingRow">

	<div class="header__table">
		<div class="header__cell header__cell--logos">
			<div class="header__logo">
                <a href="./"><img src="<?php echo THEME_WEB_ROOT; ?>/static/img/illust/content/logo-ceska-ecommerce.svg" alt="Česká e-commerce" width="500" height="56"></a>
			</div>
		</div>
		<div class="header__cell header__cell--claim">
		    <a href="https://www.shoptet.cz/" target="_new"><img src="<?php echo THEME_WEB_ROOT; ?>/static/img/illust/content/logo-shoptet.svg" alt="Shoptet" width="108" height="28"></a>
				<span class="header__word pl-10">přináší</span>
			<h1 class="header__claim"><a href="https://www.ceska-ecommerce.cz/">Stav e-commerce v&nbsp;ČR <span class="header__year">v roce <?php echo date("Y"); ?></span></a></h1>
		</div>
		<?php
			$contact_email = get_option( 'options_sk_global_email' );
			if ( !empty( $contact_email ) ) :
        /*
		<div class="header__cell text-right hide--tablet--max header__cell--btn">
			<a href="mailto:<?php echo esc_attr( antispambot( $contact_email ) ); ?>" class="header__btn">Kontakt pro média</a>
		</div>
        */
			endif;
		?>
	</div>

</div>
