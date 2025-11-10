<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until the main content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CORES_Theme
 */
?>
<!DOCTYPE html>
<!-- Set the language attributes for the site -->
<html <?php language_attributes(); ?>>
<head>
    <!-- Set the proper charset -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- Responsive viewport meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- 
      This is a critical WordPress function.
      It will add all enqueued styles, scripts, and other meta info.
      This is how your style.css, Google Fonts, Font Awesome, etc., get loaded.
    -->
    <?php wp_head(); ?>
</head>
<!-- 
  Adds dynamic classes to the body tag,
  which can be useful for styling different pages.
-->
<body <?php body_class(); ?>>
    
    <!-- 
      This function is for accessibility, allowing screen readers
      to skip directly to the main content.
    -->
    <?php wp_body_open(); ?>

    <!-- Custom Cursor -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>

    <!-- 
      The loader is now managed by js/main.js.
      No PHP is needed here.
    -->
    <div class="loader" id="loader">
        <div class="loader-content">
            <div class="wave-loader">
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave-icon">
                    <i class="fas fa-water"></i>
                </div>
            </div>
            <div class="loader-text">LOADING</div>
            <div class="loader-progress">
                <div class="loader-progress-bar"></div>
            </div>
        </div>
    </div>

    <nav id="navbar">
        <div class="logo-container">
            <!-- 
              We use get_template_directory_uri() to create a dynamic and correct
              path to the logo in the theme's folder.
              
              We also use home_url() to ensure the logo always links to the homepage.
            -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/Logo-Cores-UB-revisi-transparan@2x.png' ); ?>" alt="CORES Logo" class="logo">
            </a>
            
            <!-- 
              *** FIX #2 ***
              Replaced dynamic bloginfo('name') with hardcoded "CORES"
              as you requested.
            -->
            <div class="logo-text">CORES</div>
        </div>

        <!-- 
          *** FIX #4 ***
          This is the main WordPress navigation menu.
          It's now set to use the 'fallback_cb' we defined in functions.php.
          This will show your full, correct menu even if you haven't set it 
          up in Appearance > Menus yet.
        -->
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary-menu',      // Looks for the "Primary Menu" location
                'container'      => 'ul',                 // Renders the menu as a <ul>
                'menu_class'     => 'main-nav-ul',        // Custom class for the <ul>
                'fallback_cb'    => 'cores_menu_fallback',// *** Uses our new fallback function ***
            )
        );
        ?>
        
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <div class="slide-menu" id="slideMenu">
        <div class="menu-close" id="menuClose">
            <i class="fas fa-times"></i>
        </div>
        <div class="slide-menu-content">
            <h2 style="margin-bottom: 2rem;">Menu</h2>
            
            <!-- 
              This is the slide-out (mobile) WordPress navigation menu.
              It uses the *same* 'primary-menu' location and fallback
              to ensure your menus are always identical.
            -->
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary-menu',
                    'container'      => 'ul',
                    'menu_class'     => 'mobile-nav-ul',
                    'fallback_cb'    => 'cores_menu_fallback', // *** Also uses the fallback ***
                )
            );
            ?>

            <div style="margin-top: 3rem;">
                <h3>Quick Contact</h3>
                <p style="margin-top: 1rem;">Email: coastalresearchers@gmail.com</p>
                <p>Phone: +62 821 4279 3179</p>
            </div>
            <div class="social-icons" style="margin-top: 2rem;">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    
    <!-- 
      The header.php file intentionally does not close the body or html tags.
      It leaves an opening for the page content (e.g., index.php, page.php).
      The footer.php file will close these tags.
    -->