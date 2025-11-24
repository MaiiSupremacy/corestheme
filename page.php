<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <!-- 
      This is a simple wrapper to style the static page content.
      The inline style is just a basic setup. You can move this to style.css
      later under a .page-container class if you want.
    -->
    <div class="page-container" style="padding-top: 140px; padding-bottom: 6rem; background: var(--white);">
        <div class="content-wrapper" style="max-width: 900px; margin: 0 auto; padding: 2rem; background: #ffffff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">

            <?php
            // Start the WordPress Loop
            while ( have_posts() ) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <!-- Display the page title -->
                        <?php the_title( '<h1 class="entry-title" style="font-size: 2.5rem; color: var(--primary); margin-bottom: 2rem;">', '</h1>' ); ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <!-- Display the page content (from the WordPress editor) -->
                        <?php
                        the_content();

                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'corestheme' ),
                                'after'  => '</div>',
                            )
                        );
                        ?>
                    </div><!-- .entry-content -->

                </article><!-- #post-<?php the_ID(); ?> -->

                <?php
            endwhile; // End of the loop.
            ?>

        </div><!-- .content-wrapper -->
    </div><!-- .page-container -->

<?php
get_footer(); // This will include the footer.php file
?>