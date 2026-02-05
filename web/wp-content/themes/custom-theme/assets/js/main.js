/**
 * Main JavaScript File (Updated for Tailwind & Search Overlay)
 * 
 * @package Custom_Theme
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        // --- Search Toggles ---
        const searchToggleBtn = document.getElementById('search-toggle-btn');
        const searchCloseBtn = document.getElementById('search-close-btn');
        const searchOverlay = document.getElementById('search-overlay');
        const searchInput = searchOverlay ? searchOverlay.querySelector('input') : null;

        if (searchToggleBtn && searchOverlay) {
            searchToggleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                // Show overlay instantly
                searchOverlay.classList.remove('hidden');

                // Focus input
                if (searchInput) {
                    setTimeout(() => searchInput.focus(), 10);
                }
            });
        }

        if (searchCloseBtn && searchOverlay) {
            searchCloseBtn.addEventListener('click', function (e) {
                e.preventDefault();
                // Hide overlay instantly
                searchOverlay.classList.add('hidden');
            });
        }

        // Close search on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && searchOverlay && !searchOverlay.classList.contains('hidden')) {
                searchCloseBtn.click();
            }
        });

        // --- Mobile Menu Sidebar Toggle ---
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
        const mobileMenuClose = document.getElementById('mobile-menu-close');

        // Function to open sidebar
        function openMobileSidebar() {
            if (mobileMenu && mobileMenuBackdrop) {
                // Show backdrop
                mobileMenuBackdrop.classList.remove('hidden');

                // Slide in sidebar from left
                setTimeout(() => {
                    mobileMenu.classList.remove('-translate-x-full');
                }, 10);

                // Prevent body scroll
                document.body.style.overflow = 'hidden';
            }
        }

        // Function to close sidebar
        function closeMobileSidebar() {
            if (mobileMenu && mobileMenuBackdrop) {
                // Slide out sidebar to left
                mobileMenu.classList.add('-translate-x-full');

                // Hide backdrop after animation
                setTimeout(() => {
                    mobileMenuBackdrop.classList.add('hidden');
                }, 300);

                // Restore body scroll
                document.body.style.overflow = '';
            }
        }

        // Open sidebar when hamburger is clicked
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function (e) {
                e.preventDefault();
                openMobileSidebar();
            });
        }

        // Close sidebar when close button is clicked
        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', function (e) {
                e.preventDefault();
                closeMobileSidebar();
            });
        }

        // Close sidebar when backdrop is clicked
        if (mobileMenuBackdrop) {
            mobileMenuBackdrop.addEventListener('click', function () {
                closeMobileSidebar();
            });
        }

        // --- Mobile Dropdown Toggles ---
        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const dropdown = this.closest('.mobile-dropdown');
                const content = dropdown.querySelector('.mobile-dropdown-content');
                const icon = dropdown.querySelector('.mobile-dropdown-icon');

                // Toggle content
                content.classList.toggle('hidden');

                // Rotate icon
                if (content.classList.contains('hidden')) {
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });

        // --- Smooth Scroll ---
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        anchorLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#' || href === '') return;
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // --- Back to Top ---
        const backToTop = document.createElement('button');
        // Tailwind classes for button
        backToTop.className = 'fixed bottom-8 right-8 bg-primary text-white p-3 rounded-full shadow-lg opacity-0 transition-opacity duration-300 z-40 hover:bg-primary-dark translate-y-10 focus:outline-none';

        backToTop.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        `;
        document.body.appendChild(backToTop);

        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 300) {
                backToTop.classList.remove('opacity-0', 'translate-y-10');
            } else {
                backToTop.classList.add('opacity-0', 'translate-y-10');
            }
        });

        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

    });

})();
