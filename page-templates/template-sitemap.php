<?php
/**
 * Template Name: Sitemap
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php
				/*
				 * Prevents adding empty #before-content div
				 */
				if ( has_action( 'thsp_before_content' ) ) { ?>
				<div id="before-content" class="clearfix">
					<?php do_action( 'thsp_before_content' ); ?>
				</div><!-- #before-content -->
				<?php }
			?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php get_template_part( 'post', 'lead' ); ?>
				
					<div class="entry-inner">
						<?php get_template_part( 'post', 'header' ); ?>
					
						<div class="entry-content">
							<?php the_content(); ?>
							
							<!-- Sitemap template code -->
							<h2><?php _e( 'Pages', 'cazuela' ); ?></h2>
							<ul id="sitemap-pages" class="sitemap-list"><?php wp_list_pages( 'title_li=' ); ?></ul>
							
							<h2><?php _e( 'Categories', 'cazuela' ); ?></h2>
							<ul id="sitemap-categories" class="sitemap-list"><?php wp_list_categories( 'title_li=' ); ?></ul>

							<h2><?php _e( 'Latest Posts', 'cazuela' ); ?></h2>
							<ul id="sitemap-posts" class="sitemap-list">
							<?php
								// Get 25 latest posts
								$args = array(
									'posts_per_page' => 25
								);
								$recent_posts = get_posts( $args );
								foreach( $recent_posts as $recent_post ) {
									echo '<li><a href="' . get_permalink( $recent_post->ID ) . '" title="Permalink to  ' . esc_attr( $recent_post->post_title ) . '">' . $recent_post->post_title . '</a></li>';
								}								
							?>
							</ul>
							<!-- End sitemap template code -->
							
							
							<?php edit_post_link( __( 'Edit', 'cazuela' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-content -->
					</div><!-- .entry-inner -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php
				/*
				 * Prevents adding empty #after-content div
				 */
				if ( has_action( 'thsp_after_content' ) ) { ?>
				<div id="after-content" class="clearfix">
					<?php do_action( 'thsp_after_content' ); ?>
				</div><!-- #after-content -->
				<?php }
			?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>