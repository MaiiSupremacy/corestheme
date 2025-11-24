<?php
/**
 * The footer for our theme
 *
 * Contains the closing of the main content and all footer content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CORES_Theme
 */
?>

    <!-- The main content ends before this -->

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About CORES</h3>
                <p>We are a dedicated team of researchers focused on advancing coastal science through innovative research, cutting-edge technology, and collaborative partnerships.</p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <!-- You can replace this with a dynamic WordPress footer menu later if you wish -->
                <ul>
                    <li><a href="#home" class="footer-link">Home</a></li>
                    <li><a href="#research" class="footer-link">Research</a></li>
                    <li><a href="#team" class="footer-link">Team</a></li>
                    <li><a href="#publications" class="footer-link">Publications</a></li>
                    <li><a href="#news" class="footer-link">News</a></li>
                    <li><a href="#contact" class="footer-link">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Research Areas</h3>
                <ul>
                    <li><a href="#" class="footer-link">Coastal Dynamics</a></li>
                    <li><a href="#" class="footer-link">Data Analysis</a></li>
                    <li><a href="#" class="footer-link">Remote Sensing</a></li>
                    <li><a href="#" class="footer-link">Ecosystem Studies</a></li>
                    <li><a href="#" class="footer-link">Topographic Mapping</a></li>
                    <li><a href="#" class="footer-link">Sediment Analysis</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Newsletter</h3>
                <p>Subscribe to our newsletter for the latest research updates and news.</p>
                <form style="margin-top: 1rem;">
                    <input type="email" placeholder="Your email" style="padding: 0.5rem; border-radius: 5px; border: none; width: 100%; margin-bottom: 0.5rem;">
                    <button type="submit" class="cta-button" style="width: 100%; padding: 0.5rem;">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <!-- Use WordPress dynamic functions for site name and year -->
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved. | <a href="#" style="color: var(--light);">Privacy Policy</a> | <a href="#" style="color: var(--light);">Terms of Service</a></p>
        </div>
    </footer>

    <div class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </div>

    <!-- 
      This is the most important function in this file.
      It tells WordPress to inject all enqueued footer scripts.
      This is where js/main.js, leaflet.js, and chart.js will be loaded.
    -->
    <?php wp_footer(); ?>

</body>
</html>