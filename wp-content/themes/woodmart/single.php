<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 */

get_header();

// Get content width and sidebar position.
$content_class = woodmart_get_content_class();
?>

<div class="site-content <?php echo esc_attr( $content_class ); ?>" role="main">

		<?php /* The loop */ ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<div class="wd-single-footer"><?php if ( get_the_tag_list( '', ', ' ) ) : ?>
					<div class="single-meta-tags">
						<span class="tags-title"><?php esc_html_e( 'Tags', 'woodmart' ); ?>:</span>
						<div class="tags-list">
							<?php echo get_the_tag_list( '', ', ' ); ?>
						</div>
					</div>
				<?php endif; ?><?php if ( woodmart_get_opt( 'blog_share' ) && woodmart_is_social_link_enable( 'share' ) ) : ?>
					<div class="single-post-social">
						<?php
						if ( function_exists( 'woodmart_shortcode_social' ) ) {
							echo woodmart_shortcode_social(
								array(
									'type'    => 'share',
									'tooltip' => 'no',
									'style'   => 'colored',
								)
							);}
						?>
					</div>
				<?php endif ?></div>

			<?php
			if ( woodmart_get_opt( 'blog_navigation' ) ) {
				woodmart_posts_navigation();}
			?>

				<?php

				if ( woodmart_get_opt( 'blog_related_posts' ) ) {
					$args = woodmart_get_related_posts_args( $post->ID );

					$query  = new WP_Query( $args );
					$design = woodmart_get_opt( 'blog_design' );

					woodmart_enqueue_inline_style( 'blog-base' );
					if ( 'meta-image' === $design ) {
						woodmart_enqueue_inline_style( 'blog-loop-base' );
						woodmart_enqueue_inline_style( 'blog-loop-design-' . $design );
					} else {
						woodmart_enqueue_inline_style( 'blog-loop-base-old' );
						woodmart_enqueue_inline_style( 'blog-loop-design-masonry' );
					}

					if ( function_exists( 'woodmart_generate_posts_slider' ) ) {
						echo woodmart_generate_posts_slider( //phpcs:ignore.
							array(
								'title'                => esc_html__( 'Related Posts', 'woodmart' ),
								'blog_design'          => 'carousel',
								'blog_carousel_design' => 'meta-image' === $design ? $design : 'masonry',
								'wrapper_classes'      => ' related-posts-slider',
								'slides_per_view'      => 2,
								'parts_title'          => woodmart_get_opt( 'parts_title', true ),
								'parts_meta'           => woodmart_get_opt( 'parts_meta', true ),
								'parts_text'           => woodmart_get_opt( 'parts_text', true ),
								'parts_btn'            => woodmart_get_opt( 'parts_btn', true ),
								'spacing'              => 20,
							),
							$query
						);
					}
				}
				?>

				<?php comments_template(); ?>

		<?php endwhile; ?>

</div><!-- .site-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
