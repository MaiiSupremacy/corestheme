<?php
/**
 * The template for displaying archive pages
 *
 * This is the template that displays an archive page (e.g., category, tag, author).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <div class="page-container" style="padding-top: 140px; padding-bottom: 6rem; background: var(--white);">
        <div class="content-wrapper" style="max-width: 1200px; margin: 0 auto; padding: 2rem;">

            <header class="archive-header" style="margin-bottom: 3rem; border-bottom: 2px solid var(--accent); padding-bottom: 1.5rem;">
                <?php
                // This function displays the title of the archive, e.g., "Category: News"
                the_archive_title( '<h1 class="archive-title" style="font-size: 2.5rem; color: var(--primary);">', '</h1>' );
                the_archive_description( '<div class="archive-description" style="color: var(--dark); margin-top: 1rem;">', '</div>' );
                ?>
            </header><!-- .archive-header -->

            <?php if ( have_posts() ) : ?>

                <!-- 
                  This uses the same grid structure as your homepage's "News" section
                  for a consistent look and feel.
                -->
                <div class="news-grid">

                    <?php
                    // Start the Loop
                    while ( have_posts() ) :
                        the_post();
                        ?>

                        <!-- 
                          This markup is identical to the .news-item from index.php
                        -->
                        <div class="news-item fade-in visible">
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="news-image" style="background-image: url('<?php the_post_thumbnail_url( 'large' ); ?>');"></div>
                            <?php else : ?>
                                <!-- Fallback if no featured image is set -->
                                <div class="news-image" style="background-image: url('https://picsum.photos/seed/news_fallback/600/400.jpg');"></div>
                            <?php endif; ?>
                            
                            <div class="news-content">
                                <div class="news-date"><?php echo get_the_date(); ?></div>
                                
                                <!-- Post title with a link to the single.php template -->
                                <a href="<?php the_permalink(); ?>" style="text-decoration: none;">
                                    <h4 style="color: var(--dark); margin-bottom: 1rem; font-size: 1.3rem;"><?php the_title(); ?></h4>
                                </a>
                                
                                <div class="news-excerpt" style="color: var(--dark); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">
                                    <?php the_excerpt(); // Displays a short summary of the post ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <?php
                    endwhile; // End of the loop
                    ?>

                </div><!-- .news-grid -->

                <?php
                // Adds "Older posts" and "Newer posts" navigation
                the_posts_navigation( array(
                    'prev_text' => __( 'Older posts', 'corestheme' ),
                    'next_text' => __( 'Newer posts', 'corestheme' ),
                    'screen_reader_text' => ' ' // Hides the "Posts navigation" text
                ) );
                ?>

            <?php else : ?>

                <!-- 
                  This section will display if there are no posts found
                  in this archive.
                -->
                <section class="no-results not-found">
                    <header class="page-header">
                        <h2 class="page-title" style="color: var(--primary);"><?php esc_html_e( 'Nothing Found', 'corestheme' ); ?></h2>
                    </header>
                    <div class="page-content">
                        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'corestheme' ); ?></p>
                        <?php // get_search_form(); // Optionally add a search form here ?>
                    </div>
                </section>

            <?php endif; ?>

        </div><!-- .content-wrapper -->
    </div><!-- .page-container -->

<?php
get_footer(); // This will include the footer.php file
?>