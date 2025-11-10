<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <div class="page-container" style="padding-top: 140px; padding-bottom: 6rem; background: var(--white); text-align: center; min-height: 70vh; display: flex; align-items: center; justify-content: center;">
        
        <section class="error-404 not-found" style="max-width: 600px; padding: 2rem;">

            <header class="page-header">
                <h1 class="page-title" style="font-size: 5rem; color: var(--primary); margin-bottom: 1rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">404</h1>
                <h2 style="font-size: 2.5rem; color: var(--dark); margin-bottom: 1.5rem;">Page Not Found</h2>
            </header><!-- .page-header -->

            <div class="page-content">
                <p style="color: var(--dark); font-size: 1.1rem; margin-bottom: 2.5rem;">
                    We're sorry, but the page you are looking for does not exist or has been moved.
                </p>
                
                <!-- This button links back to the homepage -->
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cta-button">
                    Go Back Home
                </a>
            </div><!-- .page-content -->

        </section><!-- .error-404 -->

    </div><!-- .page-container -->

<?php
get_footer(); // This will include the footer.php file
?>