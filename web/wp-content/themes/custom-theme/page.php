<?php
/**
 * Page Template (Tailwind Version)
 * 
 * @package Custom_Theme
 */

get_header();
?>

<div class="site-main-content py-8 h-full">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content w-full max-w-6xl mx-auto">
                <?php
                the_content();

                wp_link_pages( array(
                    'before'      => '<div class="styled-pagination mt-12 flex items-center justify-center gap-2 font-sans">',
                    'after'       => '</div>',
                    'link_before' => '<span class="pagination-link px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded hover:bg-gray-50 transition shadow-sm">',
                    'link_after'  => '</span>',
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
