    </main><!-- .site-main -->

    <!-- Top CTA Section -->
    <div class="container mx-auto px-4 relative z-20">
        <div class="bg-cta-bg py-16 px-8 md:px-16 text-center max-w-6xl mx-auto shadow-sm rounded-sm">
            <h2 class="text-3xl md:text-3xl font-bold text-brand-teal mb-4 font-heading">Mixed Migration Review 2025</h2>
            <p class="text-gray-600 max-w-3xl mx-auto mb-8 text-lg leading-relaxed">
                Explore in-depth analysis, data, and stories on mixed migration dynamics, featuring regional overviews, migrant voices, and expert insights.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#" class="bg-brand-teal hover:bg-[#007a85] text-white font-semibold py-3 px-8 rounded shadow-sm transition ease-in-out duration-300">Browse Online</a>
                <a href="#" class="bg-transparent border border-gray-800 hover:border-black text-gray-900 font-semibold py-3 px-8 rounded transition ease-in-out duration-300">Download the Report</a>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="bg-footer-bg text-white pt-40 pb-10 relative overflow-hidden font-sans -mt-24">
        <!-- Background lines element could go here -->
        
        <div class="container mx-auto px-6 md:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-16">
                <!-- Logos Column -->
                <div class="lg:col-span-5 flex flex-col justify-start">
                    <div class="flex items-center gap-6 mb-8">
                        <!-- Logos -->
                        <div class="flex items-center">
                            <!-- MMC Logo (Dynamic) -->
                            <?php if ( has_custom_logo() ) : ?>
                                <div class="h-24 w-auto brightness-0 invert object-contain [&>a>img]:h-24 [&>a>img]:w-auto">
                                    <?php the_custom_logo(); ?>
                                </div>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Mixed Migration Centre" class="h-24 w-auto brightness-0 invert object-contain">
                            <?php endif; ?>
                            
                            <!-- Divider -->
                            <div class="h-20 w-px bg-gray-500 mx-8 rotate-12"></div>
                            
                            <!-- DRC Logo -->
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/danishlogo.png" alt="Danish Refugee Council" class="h-20 w-auto brightness-0 invert object-contain">
                        </div>
                    </div>
                </div>

                <!-- Links Section -->
                <div class="lg:col-span-7 lg:pl-12">
                    <h4 class="text-brand-teal text-xs font-bold uppercase tracking-widest mb-8">Quick Links</h4>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4 text-base font-semibold',
                        'fallback_cb'    => false,
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    ) );
                    ?>
                </div>
            </div>

            <!-- Bottom Section: Newsletter & Socials -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end mb-24">
                <!-- Newsletter (Dynamic) -->
                <div class="lg:col-span-5">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    <?php else : ?>
                        <h4 class="text-brand-teal text-xs font-bold uppercase tracking-widest mb-4">
                            <?php echo esc_html(get_theme_mod('newsletter_title', 'Sign-up for our global newsletter')); ?>
                        </h4>
                        <form action="<?php echo esc_url(get_theme_mod('newsletter_action', '#')); ?>" method="POST" class="flex w-full">
                            <input type="email" name="EMAIL" 
                                placeholder="<?php echo esc_attr(get_theme_mod('newsletter_placeholder', 'Your email address')); ?>" 
                                class="bg-input-bg text-gray-200 px-4 py-3 w-full border-none focus:outline-none focus:ring-1 focus:ring-brand-teal rounded-l-sm placeholder-gray-400 text-sm" required>
                            <button type="submit" class="bg-brand-teal text-white font-bold px-6 py-3 rounded-r-sm hover:bg-[#007a85] transition text-sm">
                                <?php echo esc_html(get_theme_mod('newsletter_button', 'Subscribe')); ?>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

                <!-- Social Icons (Dynamic) -->
                <div class="lg:col-span-7 flex flex-col md:flex-row md:items-center gap-6 lg:pl-12">
                     <span class="text-brand-teal text-xs font-bold uppercase tracking-widest">Connect with us</span>
                     <div class="flex gap-6">
                        <?php 
                        $rss = get_theme_mod('social_rss');
                        $twitter = get_theme_mod('social_twitter');
                        $linkedin = get_theme_mod('social_linkedin');
                        $youtube = get_theme_mod('social_youtube');
                        $other = get_theme_mod('social_other');
                        ?>

                        <?php if($rss): ?>
                        <a href="<?php echo esc_url($rss); ?>" class="text-white hover:text-brand-teal transition bg-transparent">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M6.18 15.64a2.18 2.18 0 0 1 2.18 2.18C8.36 19 7.38 20 6.18 20 5 20 4 19 4 17.82a2.18 2.18 0 0 1 2.18-2.18M4 4.44A15.56 15.56 0 0 1 19.56 20h-3.37A12.19 12.19 0 0 0 4 7.82V4.44m0 6.67A8.89 8.89 0 0 1 12.89 20H9.52A5.56 5.56 0 0 0 4 14.44v-3.33z"/></svg>
                        </a>
                        <?php endif; ?>

                        <?php if($twitter): ?>
                        <a href="<?php echo esc_url($twitter); ?>" class="text-white hover:text-brand-teal transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <?php endif; ?>

                        <?php if($linkedin): ?>
                        <a href="<?php echo esc_url($linkedin); ?>" class="text-white hover:text-brand-teal transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <?php endif; ?>

                        <?php if($youtube): ?>
                        <a href="<?php echo esc_url($youtube); ?>" class="text-white hover:text-brand-teal transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <?php endif; ?>

                        <?php if($other): ?>
                        <a href="<?php echo esc_url($other); ?>" class="text-white hover:text-brand-teal transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                        </a>
                        <?php endif; ?>
                     </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between text-xs text-gray-400 items-center">
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    <span>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All right reserved.</span>
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Use</a>
                    <a href="#" class="hover:text-white transition">Cookie Policy (EU)</a>
                </div>
                <div class="mt-4 md:mt-0">
                    Website by <span class="font-bold text-white">Marameo Design</span>
                </div>
            </div>
        </div>
    </footer>
</div><!-- .footer-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
