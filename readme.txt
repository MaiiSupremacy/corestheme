=== CORES Theme ===
Contributors: Mai, Gemini
Tags: custom-theme, coastal-research, academic, responsive
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A custom WordPress theme for the Coastal Researchers (CORES) website, based on the Main Page 3.html design.

== Description ==

This is a custom-built WordPress theme for the Coastal Researchers (CORES) academic group. It replicates the design of the "Main Page 3.html" static site, converting it into a dynamic, manageable WordPress theme.

It includes a custom homepage template, standard templates for posts and pages, and all 8 requested UI/UX improvements, including:

Animated SVG wave hero transition

Relocated scroll indicator

Clickable research milestones

Chart.js data visualization

Upgraded map pin icon

Fixes for initial content loading and team filter alignment

== Installation ==

Create a ZIP file of the theme folder (e.g., cores-theme.zip). The folder should contain style.css, index.php, functions.php, etc., at its root.

In your WordPress admin dashboard, navigate to Appearance > Themes.

Click Add New, then Upload Theme.

Choose the cores-theme.zip file you created and click Install Now.

After installation, click Activate.

== Setup ==

To get the theme working exactly like the demo, follow these steps:

Set Up the Homepage:

By default, the theme uses index.php to display your homepage content.

To make this your site's front page, go to Settings > Reading.

Under "Your homepage displays", select "Your latest posts". WordPress will automatically use index.php to display this, which contains your custom homepage layout.

Create the Navigation Menu:

Go to Appearance > Menus.

Create a new menu (e.g., "Main Nav").

Add custom links to your menu that point to the sections on your homepage:

#home (Home)

#research (Research)

#team (Team)

#publications (Publications)

#news (News)

#contact (Contact)

Under "Menu Settings" at the bottom, check the box for "Primary Menu".

Save the menu. This will populate both the main navigation and the slide-out mobile menu.

Create a Blog/News Page (Optional):

Create a new, empty page called "News" or "Blog".

Go to Settings > Reading.

Under "Your homepage displays", select "A static page".

For "Homepage", select your main page (if you created one).

For "Posts page", select the "News" page you just created.

This will make WordPress use archive.php to automatically list all your posts on the /news URL.

== Changelog ==

= 1.0.0 =

Initial release. Converted from static HTML by Gemini.

Implemented 8 UI/UX improvements.

Created all standard WordPress theme files.