<?php
/**
 * @file
 * TwentyEleven theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * TwentyEleven specfic:
 * - $header_image: Contains the header image displayed on top of the page.
 * - $search_box: The site's search box
 *
 * Regions:
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['first_footer']: Items for the first footer region.
 * - $page['second_footer']: Items for the second footer region.
 * - $page['third_footer']: Items for the third footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>

<div id="page">
	<header role="banner" id="branding">
		<hgroup>
			<div id="site-title">
				<?php if ($site_name): ?>
					<h1>
						<a rel="home" title="<?php print $site_name; ?>" href="<?php print check_url($front_page); ?>"><?php print $site_name; ?></a>
					</h1>
				<?php endif; ?>
			</div>
			<?php if ($site_slogan): ?>
				<h2 id="site-description"><?php print $site_slogan; ?></h2>
			<?php endif; ?>



			<?php if ($search_box): ?>
				<div id="searchform">
					<?php print $search_box; ?>
				</div>
			<?php endif; ?>

		</hgroup>
		<a href="<?php print check_url($front_page); ?>">
	    <?php print $header_image; ?>
		</a>
		<nav id="access">
			<div id="menu-container">
				<?php
				$menu_name = variable_get('menu_main_links_source', 'main-menu');
				$main_menu_tree = menu_tree($menu_name);
				print drupal_render($main_menu_tree);
				?>
			</div>
		</nav>
	</header>
	<div id="main">
		<?php print $messages; ?>
		<div id="primary">
			<?php print render($title_prefix); ?>
			<?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
			<?php print render($title_suffix); ?>
			<?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
			<?php print render($page['help']); ?>
			<div id="<?php print $content_region_id; ?>">
				<?php print render($page['content']); ?>
			</div>
		</div>
		<div id="secondary">
			<?php print render($page['sidebar_first']); ?>
		</div>
		<footer role="contentinfo" id="colophon">
			<div id="supplementary">
				<div id="first" class="widget-area">
					<?php print render($page['footer_first']); ?>
				</div>
				<div id="second" class="widget-area">
					<?php print render($page['footer_second']); ?>
				</div>
				<div id="third" class="widget-area">
					<?php print render($page['footer_third']); ?>
				</div>
			</div>
			<div id="site-generator">
				<?php print render($page['footer_last']); ?>
				<?php print $feed_icons; ?>
			</div>
		</footer>
	</div>
</div>
