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
    
    // Tailwind Config & Gutenberg Bridge
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

    // Custom CSS for Gutenberg alignments and pagination
    wp_add_inline_style( 'custom-theme-fonts', "
        /* Fix for alignfull and alignwide to work with Tailwind container */
        .alignfull {
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }
        .alignwide {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
        /* Default spacing for standard blocks to keep them readable */
        .entry-content > *:not(.alignfull):not(.alignwide) {
            max-width: 1024px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        
        /* Grid Gap Fix */
        .wp-block-columns {
            display: flex;
            flex-wrap: wrap;
        }
        @media (min-width: 782px) {
            .wp-block-columns {
                flex-wrap: nowrap;
            }
        }
        
        /* Pagination Styling */
        .styled-pagination > span:not(.pagination-link) {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #1a9ba5;
            color: #ffffff;
            border-radius: 0.25rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }
        
        /* Heading Fixes for Frontend */
        .entry-content h1 { font-size: 3rem; line-height: 1; font-weight: 700; margin-bottom: 1.5rem; }
        .entry-content h2 { font-size: 2.25rem; line-height: 2.5rem; font-weight: 700; margin-bottom: 1.25rem; }

        /* HERO STATS IMPROVEMENTS */
        /* Make the Grid Gap bigger */
        .wp-block-columns.gap-12 { gap: 4rem !important; }
        .wp-block-columns.gap-4 { gap: 1.5rem !important; }

        /* Make Cards Bigger & Spacing Better */
        /* Target columns that have background styling (the cards) */
        .wp-block-column[class*='bg-'] {
            padding: 2.5rem !important; /* Bigger internal padding */
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            min-height: 220px; /* Force minimum height */
        }
        
        /* Make the numbers inside cards bigger */
        .wp-block-column[class*='bg-'] h3 {
            font-size: 2.5rem !important;
            margin-bottom: 0.5rem !important;
        }
        
        /* Make the text inside cards readable */
        .wp-block-column[class*='bg-'] p {
            font-size: 1rem !important;
            line-height: 1.4 !important;
        }
    " );
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


