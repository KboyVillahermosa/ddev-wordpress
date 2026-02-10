<?php
/**
 * Dynamic Post List Block Render Template
 */

$post_type      = isset( $attributes['postType'] ) ? $attributes['postType'] : 'post';
$tax_selections = isset( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
$posts_per_page = isset( $attributes['postsPerPage'] ) ? $attributes['postsPerPage'] : 3;

$args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $posts_per_page,
	'post_status'    => 'publish',
);

// Group taxonomies for query
if ( ! empty( $tax_selections ) ) {
	$tax_query = array( 'relation' => 'AND' );
	$grouped   = array();

	foreach ( $tax_selections as $selection ) {
		$tax = $selection['taxonomy'];
		$id  = $selection['termId'];
		if ( ! isset( $grouped[ $tax ] ) ) {
			$grouped[ $tax ] = array();
		}
		$grouped[ $tax ][] = $id;
	}

	foreach ( $grouped as $tax_slug => $ids ) {
		$tax_query[] = array(
			'taxonomy' => $tax_slug,
			'field'    => 'term_id',
			'terms'    => $ids,
			'operator' => 'IN',
		);
	}
	$args['tax_query'] = $tax_query;
}

$query = new WP_Query( $args );

$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'dynamic-posts-wrapper' ) );
?>

<div <?php echo $wrapper_attributes; ?>>
	<?php if ( $query->have_posts() ) : ?>
		<div class="dynamic-posts-grid">
			<?php while ( $query->have_posts() ) : $query->the_post(); 
				$price = function_exists('get_field') ? get_field('book_price') : '';
				$rating_terms = get_the_terms( get_the_ID(), 'book-rating' );
				$fiction_terms = get_the_terms( get_the_ID(), 'fictions' );
			?>
				<article class="post-card">
					<div class="post-card-image">
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium_large' ); ?>
							<?php else : ?>
								<div class="placeholder-image"><span><?php the_title(); ?></span></div>
							<?php endif; ?>
						</a>
						<?php if ( ! empty( $price ) ) : ?>
							<span class="post-card-price"><?php echo esc_html( $price ); ?></span>
						<?php endif; ?>
					</div>
					
					<div class="post-card-content">
						<div class="post-card-badges">
							<?php 
							if ( $fiction_terms && ! is_wp_error( $fiction_terms ) ) {
								foreach ( $fiction_terms as $term ) {
									echo '<span class="badge badge-fiction">' . esc_html( $term->name ) . '</span>';
								}
							}
							if ( $rating_terms && ! is_wp_error( $rating_terms ) ) {
								foreach ( $rating_terms as $term ) {
									echo '<span class="badge badge-rating">⭐ ' . esc_html( $term->name ) . '</span>';
								}
							}
							?>
						</div>
						
						<h3 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						
						<div class="post-card-excerpt">
							<?php echo wp_trim_words( get_the_excerpt(), 15 ); ?>
						</div>
						
						<a href="<?php the_permalink(); ?>" class="post-card-link"><?php _e( 'Read More', 'my-custom-blocks' ); ?> →</a>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<div class="no-posts-found">
			<p><?php _e( 'No items found matching your selection.', 'my-custom-blocks' ); ?></p>
		</div>
	<?php endif; ?>
</div>

