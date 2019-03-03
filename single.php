<?php
get_header();
the_post();
?>
<div id="swup" class="main-content">
	<section class="writings-post">
		<div class="-inner">
			<article>
				<?php if ( has_post_thumbnail() ) : ?>
				<figure>
					<!-- BEGIN: Writings Post Image -->
					<!--
						- Assign image in CSS with 'background-image: url('IMAGE_URL');'
					-->
					<div class="-image" style="filter:grayscale(1); background-image:url(<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'single__featured' ) ?>)"></div>
					<!-- END: Writings Post Image -->
					<figcaption class="transition-in">
						<?php echo get_the_title( get_post_thumbnail_id() ); ?>
					</figcaption>
				</figure>
				<?php endif; ?>
				<div class="-content transition-in">
					<h1><?php the_title(); ?></h1>
					<time><?php the_time('F jS'); ?></time>
					<?php the_content(); ?>
				</div>
			</article>
		</div>
	</section>
	<?php
		$previous = get_adjacent_post( false, '', true );
		if ( $previous ) :
	?>
	<section class="next-post transition-in">
		<!-- BEGIN: Next Writings Post - Replace 'href' attribute -->
		<a href="<?php echo get_permalink( $previous ); ?>" class="inner">
			<h3><?php echo esc_html_e('Previous Post', 'chopan_2019'); ?></h3>
			<h1>
				<?php echo get_the_title( $previous ); ?>
			</h1>
		</a>
		<!-- END: Next Writings Post -->
	</section>
	<?php endif; ?>
</div>
<?php get_footer(); ?>