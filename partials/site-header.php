<header class="header">
	<div class="-inner">
		<div class="-left">
			<h1 class="-title">
				<a href="<?php echo function_exists('pll_home_url') ? pll_home_url() : site_url(); ?>">Francisco Vera</a>
			</h1>
			<nav>
				<a class="--writings <?php echo function_exists('pll_current_language') ? pll_current_language('slug') : ''; ?>" href="<?php echo esc_attr_x('/writings/', 'url seccion', 'chopan_2019'); ?>"><?php echo esc_html_x( 'Writings', 'header', 'chopan_2019' ); ?></a>
				<a class="--work <?php echo function_exists('pll_current_language') ? pll_current_language('slug') : ''; ?>" href="<?php echo esc_attr_x('/work/', 'url seccion', 'chopan_2019'); ?>"><?php echo esc_html_x( 'Work', 'header', 'chopan_2019' ); ?></a>
				<a class="--me <?php echo function_exists('pll_current_language') ? pll_current_language('slug') : ''; ?>" href="<?php echo esc_attr_x('/me/', 'url seccion', 'chopan_2019'); ?>"><?php echo esc_html_x( 'Me', 'header', 'chopan_2019' ); ?></a>
			</nav>
		</div>
		<div class="-right">
			<?php echo chopan_language_switch(); ?>
		</div>
	</div>
</header>