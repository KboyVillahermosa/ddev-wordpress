<?php
/**
 * Main Template File (Tailwind Version)
 * 
 * @package Custom_Theme
 */

get_header();
?>

<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <?php if ( have_posts() ) : ?>
        
        <div class="page-header py-12 text-center md:text-left border-b border-gray-100 mb-12">
            <?php
            if ( is_home() && ! is_front_page() ) :
                ?>
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-dark mb-4"><?php single_post_title(); ?></h1>
                <?php
            elseif ( is_archive() ) :
                the_archive_title( '<h1 class="text-4xl md:text-5xl font-heading font-bold text-dark mb-4">', '</h1>' );
                the_archive_description( '<div class="text-lg text-text-main max-w-2xl">', '</div>' );
            elseif ( is_search() ) :
                ?>
                <h1 class="text-3xl md:text-4xl font-heading font-bold text-dark mb-2">
                    <?php printf( __( 'Search Results for: %s', 'custom-theme' ), '<span class="text-primary">' . get_search_query() . '</span>' ); ?>
                </h1>
                <?php
            else :
                ?>
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-dark mb-4"><?php _e( 'Latest Posts', 'custom-theme' ); ?></h1>
                <?php
            endif;
            ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'group bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300' ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                            <a href="<?php the_permalink(); ?>" class="block h-64 overflow-hidden relative">
                                <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500' ) ); ?>
                                <div class="absolute inset-0 bg-dark opacity-0 group-hover:opacity-10 transition-opacity"></div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="p-6">
                        <header class="mb-4">
                            <?php
                            the_title( 
                                '<h2 class="text-xl font-bold font-heading mb-2 leading-tight"><a href="' . esc_url( get_permalink() ) . '" class="text-dark group-hover:text-primary transition-colors">', 
                                '</a></h2>' 
                            );
                            ?>
                            
                            <div class="flex items-center text-sm text-gray-500 space-x-2">
                                <span class="text-primary font-medium"><?php echo get_the_date(); ?></span>
                                <span>&bull;</span>
                                <span><?php the_author(); ?></span>
                            </div>
                        </header>

                        <div class="text-text-main mb-6 line-clamp-3">
                            <?php the_excerpt(); ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-sm font-semibold text-white bg-primary hover:bg-primary-dark px-5 py-2 rounded-lg transition-colors shadow-sm hover:shadow-md">
                            <?php _e( 'Read More', 'custom-theme' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </article>

                <?php
            endwhile;
            ?>
        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '← Previous', 'custom-theme' ),
                'next_text' => __( 'Next →', 'custom-theme' ),
                'class'     => 'flex space-x-2' // Check WP generic classes, usually requires wrapper adjustment or custom paginate links function for full Tailwind
            ) );
            ?>
        </div>

    <?php else : ?>

        <div class="text-center py-24 bg-gray-50 rounded-xl border border-gray-100">
            <h1 class="text-3xl font-bold text-dark mb-4"><?php _e( 'Nothing Found', 'custom-theme' ); ?></h1>
            <p class="text-text-main mb-8"><?php _e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'custom-theme' ); ?></p>
            <div class="max-w-md mx-auto">
                <?php get_search_form(); ?>
            </div>
        </div>

    <?php endif; ?>
</div>

<?php
get_footer();
