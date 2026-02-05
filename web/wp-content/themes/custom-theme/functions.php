    <?php
/**
 * Custom Theme Functions
 * 
 * @package Custom_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme Setup
 */
function custom_theme_setup() {
    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    
    // Gutenberg Block Supports
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    
    // Add custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    
    // Register navigation menu
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'custom-theme' ),
        'footer'  => __( 'Footer Menu', 'custom-theme' ),
    ) );
    
    // Set content width
    if ( ! isset( $content_width ) ) {
        $content_width = 1200;
    }
}
add_action( 'after_setup_theme', 'custom_theme_setup' );

/**
 * Enqueue Styles and Scripts
 */
function custom_theme_scripts() {
    // Google Fonts
    wp_enqueue_style( 
        'custom-theme-fonts', 
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );
    
    // Tailwind CSS (CDN for development)
    wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', array(), '3.4.1', false );
    
    // Tailwind Config
    wp_add_inline_script( 'tailwindcss', "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1a9ba5',
                        'primary-dark': '#158a93',
                        secondary: '#2ab4bf',
                        dark: '#1a1a1a',
                        light: '#f8f9fa',
                        'text-main': '#4a5568',
                        'footer-bg': '#020024',
                        'cta-bg': '#d6f0f3',
                        'brand-teal': '#00909e',
                        'input-bg': '#2b2d5c',
                        'card-blue': '#d9eff2',
                        'card-beige': '#f0ebd8',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    " );

    // Main JavaScript
    wp_enqueue_script(
        'custom-theme-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'), // Added jQuery dependency just in case, though we'll use Vanilla JS
        wp_get_theme()->get( 'Version' ),
        true
    );
    
    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );

/**
 * Register Widget Areas
 */
function custom_theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'custom-theme' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'custom-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => __( 'Footer', 'custom-theme' ),
        'id'            => 'footer-1',
        'description'   => __( 'Add widgets here to appear in your footer.', 'custom-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'custom_theme_widgets_init' );

/**
 * Custom Excerpt Length
 */
function custom_theme_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'custom_theme_excerpt_length' );

/**
 * Custom Excerpt More
 */
function custom_theme_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'custom_theme_excerpt_more' );

/**
 * Add Custom Image Sizes
 */
add_image_size( 'custom-featured', 800, 400, true );
add_image_size( 'custom-thumbnail', 400, 300, true );

/**
 * Customize Post Meta
 */
function custom_theme_posted_on() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    
    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );
    
    echo '<span class="posted-on">' . $time_string . '</span>';
}

function custom_theme_posted_by() {
    echo '<span class="posted-by">By ' . esc_html( get_the_author() ) . '</span>';
}

/**
 * Add Body Classes
 */
function custom_theme_body_classes( $classes ) {
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    
    if ( is_page_template( 'page-templates/full-width.php' ) ) {
        $classes[] = 'full-width-template';
    }
    
    return $classes;
}
add_filter( 'body_class', 'custom_theme_body_classes' );

/**
 * Add Social Media Settings to Customizer
 */
function custom_theme_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'custom_theme_social_section', array(
        'title'    => __( 'Social Media Links', 'custom-theme' ),
        'priority' => 30,
    ) );

    $socials = array( 'rss', 'twitter', 'linkedin', 'youtube', 'other' );
    foreach ( $socials as $social ) {
        $wp_customize->add_setting( 'social_' . $social, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( 'social_' . $social, array(
            'label'    => ucfirst( $social ) . ' Link',
            'section'  => 'custom_theme_social_section',
            'type'     => 'url',
        ) );
    }

    // Add Newsletter Setting
    $wp_customize->add_setting( 'newsletter_action', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'newsletter_action', array(
        'label'    => 'Newsletter Form Action URL',
        'section'  => 'custom_theme_social_section',
        'type'     => 'url',
        'description' => 'Paste your Mailchimp or newsletter service URL here.',
    ) );

    // Newsletter Title
    $wp_customize->add_setting( 'newsletter_title', array(
        'default'           => 'Sign-up for our global newsletter',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'newsletter_title', array(
        'label'    => 'Newsletter Title',
        'section'  => 'custom_theme_social_section',
        'type'     => 'text',
    ) );

    // Newsletter Placeholder
    $wp_customize->add_setting( 'newsletter_placeholder', array(
        'default'           => 'Your email address',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'newsletter_placeholder', array(
        'label'    => 'Newsletter Placeholder',
        'section'  => 'custom_theme_social_section',
        'type'     => 'text',
    ) );

    // Newsletter Button Text
    $wp_customize->add_setting( 'newsletter_button', array(
        'default'           => 'Subscribe',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'newsletter_button', array(
        'label'    => 'Newsletter Button Text',
        'section'  => 'custom_theme_social_section',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'custom_theme_customize_register' );

/**
 * Register Block Patterns
 */
function custom_theme_register_block_patterns() {
    register_block_pattern_category(
        'custom-theme',
        array( 'label' => __( 'Custom Theme', 'custom-theme' ) )
    );

    register_block_pattern(
        'custom-theme/cta-section',
        array(
            'title'       => __( 'CTA Section with Report', 'custom-theme' ),
            'description' => _x( 'A call to action section for reports.', 'Block pattern description', 'custom-theme' ),
            'categories'  => array( 'custom-theme' ),
            'content'     => '<!-- wp:group {"className":"bg-cta-bg py-16 px-8 md:px-16 text-center max-w-6xl mx-auto shadow-sm rounded-sm"} -->
                            <div class="wp-block-group bg-cta-bg py-16 px-8 md:px-16 text-center max-w-6xl mx-auto shadow-sm rounded-sm">
                                <!-- wp:heading {"className":"text-3xl md:text-3xl font-bold text-brand-teal mb-4 font-heading"} -->
                                <h2 class="text-3xl md:text-3xl font-bold text-brand-teal mb-4 font-heading">Mixed Migration Review 2025</h2>
                                <!-- /wp:heading -->
                                <!-- wp:paragraph {"className":"text-gray-600 max-w-3xl mx-auto mb-8 text-lg leading-relaxed"} -->
                                <p class="text-gray-600 max-w-3xl mx-auto mb-8 text-lg leading-relaxed">Explore in-depth analysis, data, and stories on mixed migration dynamics...</p>
                                <!-- /wp:paragraph -->
                                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                                <div class="wp-block-buttons">
                                    <div class="wp-block-button"><a class="wp-block-button__link bg-brand-teal text-white py-3 px-8 rounded">Browse Online</a></div>
                                </div>
                                <!-- /wp:buttons -->
                            </div>
                            <!-- /wp:group -->',
        )
    );
}
add_action( 'init', 'custom_theme_register_block_patterns' );
