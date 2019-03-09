<?php
/**
 * Template Name: Escritos
 */
get_header(); ?>
<div class="container">
	<div class="inner-container">
		<div id="swup" class="main-content">
			<section class="writings blog">
				<div class="-inner">
					<div class="-left">
						<div class="-white-bg"></div>
						<div class="-posts transition-in">
							<!-- BEGIN: Work Post Content -->
							<!--
								- First post must have class '--active'
								- 'href' attribute to be replaced to the actual post URL
								- All posts must have 'data-post' attribute starting with '0' and so on
							-->
							<?php
							$writings = new WP_Query([
							'posts_per_page' => 25
							]);
							$i = 0;
							if ( $writings->have_posts() ) : while ( $writings->have_posts() ) : $writings->the_post();
							?>
							<a class="-post<?php echo $i === 0 ? ' --active' : ''; ?>" data-post="<?php echo $i; ?>" href="<?php the_permalink(); ?>">
								<h1>
									<?php the_title(); ?>
								</h1>
								<?php the_excerpt(); ?>
								<time>
									<?php the_time('F jS'); ?>
								</time>
							</a>
							<?php ++$i; endwhile; endif; ?>
						</div>
					</div>
					<div class="-right">
						<div class="-slider-hidden"></div>
						<div class="-slider">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<!-- Slides -->
									<!-- BEGIN: Writings Post Image -->
									<!--
										- 'href' attribute to be replaced to the actual post URL
										- All posts must have 'data-post' attribute starting with '0' and so on
									-->
									<?php
									$i = 0;
									if ( $writings->have_posts() ) : while ( $writings->have_posts() ) : $writings->the_post();
									?>
									<a href="<?php the_permalink(); ?>" data-post="<?php echo $i; ?>" class="swiper-slide">
										<div class="-image" style="filter:grayscale(1); background-image:url(<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'single__featured' ) ?>)"></div>
									</a>
									<?php ++$i; endwhile; endif; ?>
								</div>

								<div class="swiper-scrollbar"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<?php get_footer(); ?>