<?php
get_header();
the_post();
?>
<div class="container">
	<div class="inner-container">
		<div id="swup" class="main-content transition-in">
			<section class="introduction">
				<div class="-inner">
					<div class="description">
						<?php the_content(); ?>
					</div>
					<div class="last-thought">
		<!-- BEGIN: Last Writings Post -->
		<?php
			$latest_post = new WP_Query([
				'posts_per_page' => 1
			]);
			if ( $latest_post->have_posts() ) : while ( $latest_post->have_posts() ) : $latest_post->the_post(); ?>
			<article class="-article">
			<a href="<?php the_permalink(); ?>">
				<h1><?php the_title(); ?></h1>
			</a>
			<div class="-header">
				<time datetime="<?php the_time('c'); ?>"><?php the_time('jS F'); ?></time>
				<a href="<?php echo esc_attr_x('/writings/', 'url seccion', 'chopan_2019'); ?>"><?php echo esc_html_x('See my blog', 'link home', 'chopan_2019'); ?></a>
			</div>
			</article>
		<?php endwhile; endif; ?>
						<!-- END: Last Writings Post -->
					</div>
				</div>
			</section>

			<section class="what-i-do">
				<div class="-inner">
					<h1><?php echo esc_html_x('This is what I do', 'seccion home', 'chopan_2019'); ?></h1>
				</div>
				<div class="-inner">
					<div class="--discovering">
						<div>
							<h2 class="-title wp-customize-discovering__title" data-aos="fade-in"><?php echo chopan_theme_custom('what_i_do__discovering_title', 'Discovering'); ?></h2>
							<p data-aos="fade-in" class="wp-customize-discovering__title">
								<?php echo chopan_theme_custom('what_id_do__discovering_description', 'Tools and methodologies applied to rise insights collaboratively with users and stakeholders. Workshops and cultural probes to collect information regarding pains and user behavior.'); ?>
							</p>
							<div class="-showcase">
								<div class="-gallery">
									<div class="-image" data-aos="fade-in"></div>
									<div class="-image" data-aos="fade-in"></div>
									<div class="-image" data-aos="fade-in"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="--defining">
						<div>
							<h2 class="-title wp-customize-defining__title" data-aos="fade-in"><?php echo chopan_theme_custom('what_i_do__defining_title', 'Defining' ); ?></h2>
							<p data-aos="fade-in" class="wp-customize-defining__description">
								<?php echo chopan_theme_custom('what_i_do__defininig_description', 'Conceptualization of ideas and definitions into maps and models to enable service decisions. Fast prototyping and controlled environment implementations to probe hypothesis.'); ?>
							</p>
							<div class="-showcase">
								<div class="-gallery">
									<div class="-image" data-aos="fade-in"></div>
									<div class="-image" data-aos="fade-in"></div>
									<div class="-image" data-aos="fade-in"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="--developing">
						<div>
							<h2 class="-title wp-customize-developing__title" data-aos="fade-in"><?php echo chopan_theme_custom('what_i_do__developing_title', 'Developing'); ?></h2>
							<p data-aos="fade-in" class="wp-customize-developing__description">
								<?php echo chopan_theme_custom('what_i_do__developing_description', 'Creation and test of digital products and design systems by mockups and prototypes. Usability, guerrilla, and heuristic tests to detect design problems.'); ?>
							</p>
							<div class="-showcase">
								<div class="-gallery">
									<div class="-image" data-aos="fade-in"></div>
									<div class="-image" data-aos="fade-in"></div>
									<div class="-image" data-aos="fade-in"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="-inner">
					<div class="-showcase --desktop">
						<div class="-gallery --discovering --fade-in">
							<div class="-image"></div>
							<div class="-image"></div>
							<div class="-image"></div>
						</div>
						<div class="-gallery --defining">
							<div class="-image"></div>
							<div class="-image"></div>
							<div class="-image"></div>
						</div>
						<div class="-gallery --developing">
							<div class="-image"></div>
							<div class="-image"></div>
							<div class="-image"></div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<?php get_footer(); ?>