<?php
/**
 * Template Name: Full-width Template
 *
 * This is the template that displays a full-width page without a sidebar.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <!-- 
      This is a simple wrapper for the full-width content.
      It's similar to page.php but with a wider max-width.
    -->
    <div class="page-container" style="padding-top: 140px; padding-bottom: 6rem; background: var(--white);">
        <!-- Note the max-width is 1200px (like the archive) instead of 900px (like the default page) -->
        <div class="content-wrapper" style="max-width: 1200px; margin: 0 auto; padding: 2rem; background: #ffffff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">

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