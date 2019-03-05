<?php
get_header();
the_post();
?>
<div id="swup" class="main-content">
	<section class="work-post">
		<div class="-inner --intro">
			<div class="-left transition-in">
				<h1>
					<?php the_title(); ?>
				</h1>
				<?php if ( $post->portfolio_made_with ) : ?>
				<small>
					<?php echo esc_html( $post->portfolio_made_with ); ?>
				</small>
				<?php endif; ?>
			</div>
			<div class="-right">
				<!-- BEGIN: Work Post Image -->
				<figure>
					<div class="-image" style="background-image: url(<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'single__featured'); ?>);"></div>
				</figure>
				<!-- END: Work Post Image -->
			</div>
		</div>
		<div class="-inner --content transition-in">
			<div class="-left">
				<?php if ( $post->portfolio_client_name ) : ?>
				<h3>
					<?php esc_html_e("Project's Client", 'chopan_2019'); ?>
				</h3>
				<a href="<?php echo esc_url( $post->portfolio_client_url ); ?>">
					<?php echo esc_html( $post->portfolio_client_name ); ?>
				</a>
				<?php endif; ?>
				<?php if ( $post->portfolio_project_date ) : ?>
				<time>
					<?php echo mysql2date('F, Y', $post->portfolio_project_date ); ?>
				</time>
				<?php endif; ?>
				<?php if ( ! empty( get_post_meta( $post->ID, 'portfolio_equipo', false ) ) ) : ?>
				<h3>
					<?php esc_html_e('People Involved', 'chopan_2019'); ?>
				</h3>
				<ul>
					<?php foreach ( get_post_meta( $post->ID, 'portfolio_equipo', false ) as $person ) : ?>
					<li>
						<?php if ( ! empty( $person['team_member_url'] ) && filter_var( $person['team_member_url'], FILTER_VALIDATE_URL ) ) : ?>
						<a href="<?php echo esc_url( $person['team_member_url'] ); ?>"><?php echo esc_html( $person['team_member_name'] ); ?></a>
						<?php else : ?>
						<a href="#" class="--inactive"><?php echo esc_html( $person['team_member_name'] ); ?></a>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>
			<div class="-right">
				<?php the_content(); ?>
			</div>
		</div>
		<?php if ( ! empty( get_post_meta( $post->ID, 'portfolio_project_gallery', false ) ) ) : ?>
		<div class="-inner --gallery transition-in">
			<!-- BEGIN: Work Post Image Gallery -->
			<!--
				- Assign images in CSS with 'background-image: url('IMAGE_URL');'
			-->
			<?php $i=1; foreach ( get_post_meta( $post->ID, 'portfolio_project_gallery', false ) as $img_id ) : ?>
			<div class="-image work-post<?php echo $i; ?>" style="background-image:url(<?php echo wp_get_attachment_image_url($img_id, 'single__featured'); ?>)"></div>
			<?php ++$i; endforeach; ?>
		</div>
		<?php endif; ?>
	</section>

	<?php $previous_project = chopan_previous_work(); ?>
	<?php if ( $previous_project ) : ?>
	<section class="next-project transition-in">
		<!-- BEGIN: Next Project - Replace 'href' attribute -->
		<a href="<?php echo get_permalink( $previous_project->ID ); ?>" class="inner">
			<h3><?php _e('Previous Project', 'chopan_2019'); ?></h3>
			<h1>
				<?php echo $previous_project->post_title; ?>
			</h1>
		</a>
		<!-- END: Next Project -->
	</section>
	<?php endif; ?>
</div>
<?php get_footer(); ?>