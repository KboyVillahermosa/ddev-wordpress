<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-text-main antialiased font-sans flex flex-col min-h-screen'); ?>>
<?php wp_body_open(); ?>

<div class="site-wrapper flex-grow flex flex-col">
    <header class="site-header bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center relative z-20 bg-white">
            
            <!-- Logo Section -->
            <div class="site-branding flex-shrink-0 flex items-center">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : 
                    $logo_url = get_template_directory_uri() . '/assets/images/logo.png';
                    if ( file_exists( get_template_directory() . '/assets/images/logo.png' ) ) : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link block" rel="home">
                            <img src="<?php echo esc_url( $logo_url ); ?>" aria-label="<?php bloginfo( 'name' ); ?>" class="h-16 w-auto object-contain">
                        </a>
                    <?php else : ?>
                        <h1 class="text-2xl font-heading font-bold text-primary">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="hover:opacity-80 transition"><?php bloginfo( 'name' ); ?></a>
                        </h1>
                    <?php endif;
                endif; ?>
            </div>

            <!-- Navigation Menu -->
            <nav class="hidden md:flex flex-grow justify-center px-8 h-full">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex space-x-2 items-center h-full font-medium text-dark',
                    'fallback_cb'    => false,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ) );
                ?>
            </nav>

            <!-- Search Toggle Button -->
            <div class="flex-shrink-0 flex items-center">
                <button id="search-toggle-btn" class="p-2 text-dark hover:text-primary transition-colors focus:outline-none" aria-label="Open Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
                
                <!-- Mobile Menu Button (Hamburger) -->
                <button class="md:hidden ml-4 p-2 text-dark hover:text-primary focus:outline-none mobile-menu-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- SEARCH OVERLAY (Corrected: White Background, Gray Search Box) -->
        <div id="search-overlay" class="absolute inset-0 bg-white z-50 flex items-center hidden">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative flex items-center w-full bg-[#F5F6F8] rounded-[4px] h-12 px-4 selection:bg-gray-200">
                    <form role="search" method="get" class="flex-grow flex items-center h-full w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="search" 
                               name="s" 
                               class="flex-grow w-full h-full bg-transparent border-none text-gray-800 text-sm font-sans placeholder-gray-500 focus:ring-0 outline-none focus:outline-none px-0 appearance-none" 
                               placeholder="Enter keyword to start searching" 
                               value="<?php echo get_search_query(); ?>"
                               autocomplete="off"
                               style="-webkit-appearance: none;" 
                        >
                        <!-- Icons Group with precise spacing -->
                        <div class="flex items-center space-x-3 ml-2">
                            <button type="submit" class="text-black hover:text-gray-600 focus:outline-none flex-shrink-0 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </button>
                            
                            <!-- Close Button (Thin Black Line 'X') -->
                            <button type="button" id="search-close-btn" class="text-black hover:text-gray-600 focus:outline-none flex-shrink-0 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <style>
                input[type="search"]::-webkit-search-decoration,
                input[type="search"]::-webkit-search-cancel-button,
                input[type="search"]::-webkit-search-results-button,
                input[type="search"]::-webkit-search-results-decoration { display: none; }
            </style>
        </div>

        <!-- MOBILE MENU SIDEBAR -->
        <!-- Backdrop Overlay -->
        <div id="mobile-menu-backdrop" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300"></div>
        
        <!-- Sidebar Panel -->
        <div id="mobile-menu" class="md:hidden fixed top-0 left-0 h-full w-80 bg-white shadow-2xl z-50 transform -translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
            <!-- Sidebar Header -->
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <div class="sidebar-branding">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="h-10 w-auto [&>a>img]:h-10 [&>a>img]:w-auto [&>a>img]:object-contain">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : 
                        $logo_url = get_template_directory_uri() . '/assets/images/logo.png'; ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo esc_url( $logo_url ); ?>" class="h-10 w-auto object-contain">
                        </a>
                    <?php endif; ?>
                </div>
                <button id="mobile-menu-close" class="p-2 text-[#1a3d46] hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="p-4">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'space-y-2',
                    'fallback_cb'    => false,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ) );
                ?>
            </nav>
        </div>
    </header>

    <main class="site-main flex-grow bg-white">
