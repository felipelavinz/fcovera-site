<?php get_header(); ?>
<div id="swup" class="main-content">
	<section class="work blog">
		<div class="-inner">
			<div class="-left">
				<div class="-white-bg"></div>
				<div class="posts transition-in">
					<!-- BEGIN: Work Post Content -->
					<!--
						- First post must have class '--active'
						- 'href' attribute to be replaced to the actual post URL
						- All posts must have 'data-post' attribute starting with '0' and so on
					-->
					<?php
						$works = new WP_Query([
							'posts_per_page' => 25,
							'post_type' => 'jetpack-portfolio'
						]);
						$i=0;
						if ( $works->have_posts() ) : while ( $works->have_posts() ) : $works->the_post();
					?>
					<a href="<?php the_permalink(); ?>" data-post="<?php echo $i; ?>" class="-post<?php echo $i === 0 ? ' --active' : ''; ?>">
						<h1>
							<?php the_title(); ?>
						</h1>
						<small>
							ChileCompra
						</small>
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
							<!-- BEGIN: Work Post Image -->
							<!--
								- 'href' attribute to be replaced to the actual post URL
								- All posts must have 'data-post' attribute starting with '0' and so on
							-->
							<?php
								$i = 0;
								if ( $works->have_posts() ) : while ( $works->have_posts() ) : $works->the_post(); ?>
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
<?php get_footer(); ?>