<?php
/**
 * Template Name: Sobre mí
 */
get_header(); ?>
<div id="swup" class="main-content transition-in">
	<section class="me">
		<div class="-inner">
			<div class="-left">
				<?php the_post_thumbnail( 'full', ['id' => 'floater'] ); ?>
			</div>
			<div class="-right">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>