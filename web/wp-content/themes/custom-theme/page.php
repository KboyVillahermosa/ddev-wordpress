<?php
/**
 * Page Template (Tailwind Version)
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

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto py-12' ); ?>>
            <header class="mb-12 text-center">
                <?php the_title( '<h1 class="text-4xl md:text-5xl font-bold font-heading text-dark mb-6">', '</h1>' ); ?>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="mb-12 rounded-2xl overflow-hidden shadow-lg">
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
        </article>

    <?php
    endwhile;
    ?>
</div>

<?php
get_footer();
