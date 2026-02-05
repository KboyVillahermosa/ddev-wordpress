<?php
/**
 * Single Post Template (Tailwind Version)
 * 
 * @package Custom_Theme
 */

get_header();
?>

<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto mt-12 mb-20' ); ?>>
            <header class="text-center mb-12">
                <div class="text-primary font-medium mb-4 uppercase tracking-wider text-sm">
                    <?php
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo esc_html( $categories[0]->name );
                    }
                    ?>
                </div>
                
                <?php the_title( '<h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-heading text-dark mb-6 leading-tight">', '</h1>' ); ?>
                
                <div class="flex items-center justify-center text-gray-500 space-x-4 text-sm md:text-base">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?php echo get_the_date(); ?>
                    </span>
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <?php echo get_the_author(); ?>
                    </span>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="mb-12 rounded-2xl overflow-hidden shadow-lg relative aspect-w-16 aspect-h-9">
                    <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
                </div>
            <?php endif; ?>

            <div class="prose prose-lg prose-slate mx-auto text-text-main">
                <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="mt-8 flex space-x-2"><span class="font-bold">Pages:</span>',
                    'after'  => '</div>',
                ) );
                ?>
            </div>

            <footer class="mt-16 pt-8 border-t border-gray-200">
                <?php
                $tags = get_the_tags();
                if ( $tags ) :
                    ?>
                    <div class="flex flex-wrap gap-2 mb-8">
                        <?php foreach($tags as $tag) : ?>
                            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary hover:text-white transition-colors">
                                #<?php echo esc_html( $tag->name ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php
                endif;
                ?>
                
                <!-- Post Navigation -->
                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    <div class="text-left">
                        <?php previous_post_link('%link', '<div class="text-xs text-gray-400 uppercase mb-1">Previous Post</div><div class="text-lg font-bold text-dark hover:text-primary transition-colors">%title</div>'); ?>
                    </div>
                    <div class="text-right">
                        <?php next_post_link('%link', '<div class="text-xs text-gray-400 uppercase mb-1">Next Post</div><div class="text-lg font-bold text-dark hover:text-primary transition-colors">%title</div>'); ?>
                    </div>
                </div>
            </footer>

            <!-- Comments -->
            <div class="mt-16">
                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </div>
        </article>
    <?php
    endwhile;
    ?>
</div>

<?php
get_footer();
