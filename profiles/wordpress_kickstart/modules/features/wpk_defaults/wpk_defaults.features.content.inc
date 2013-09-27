<?php
/**
 * @file
 * wpk_defaults.features.content.inc
 */

/**
 * Implements hook_content_defaults().
 */
function wpk_defaults_content_defaults() {
  $content = array();

  $body = '<p>Be sure to <a href="/user?destination=">log in</a> first to get started.</p><p>Thank you for downloading the <a href="http://drupal.org/project/wordpress_kickstart" target="_blank">Wordpress Kickstart install profile</a>. We are going to get you up and running on <a href="http://drupal.org/project/drupal" target="_blank">Drupal</a> as fast as possible. Please read the instructions below.</p>
<h2>1. Go to your Wordpress Dashboard and download your site as a .WXR file.</h2>
<p>This is typically located at [Wordpress URL]/wp-admin/tools.php?page=export-choices</p>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-export-admin.png" alt="Wordpress Admin Export Page" /></p>
<hr />
<h2>1a. Download the exported .xml file to your Desktop</h2>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-export-admin2.jpg" alt="Wordpress Admin Export Download Page" /></p>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-wxr-download.png" alt="Wordpress File" /></p>
<hr />
<h2>2. Update your Drupal File System Settings</h2>
<p>Be sure to set a "Private file system path" on your <a href="/admin/config/media/file-system" target="_blank">File System settings page</a>. This will be required for the Wordpress Migration to work.</p>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-file-system-settings.png" alt="Drupal File System Settings Page" /></p>
<hr />
<h2>3. Visit the <a href="/admin/content/wordpress" target="_blank">Wordpress Migration page</a></h2>
<p>This is where you will upload your WXR exported file to Drupal.</p>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-admin-menu.png" alt="Drupal Admin Menu" /></p>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-migration.png" alt="Drupal Wordpress Migration Page" /></p>
<hr />
<h2>3a. Set text fields to use "Full html"</h2>
<p>This is required for your images to show up. If you do not select "Full html" they will appear to be hidden.</p>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-import-settings.png" alt="Drupal Wordpress Migration Import Settings" /></p>
<hr />
<h2>3b. Click "Import WordPress blog"</h2>
<p>You are almost done, just select "Import WordPress blog" to initiate the download. You should see a progress bar that gives you an idea as to how long it will take.&nbsp;</p>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-import-button.png" alt="Drupal Wordpress Migration Import Button" /></p>
<hr />
<h2>4. You are done!</h2>
<p>You should see a screen that indicates how much content was imported with options to roll back content if necessary.</p>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-migration-finished.jpg" alt="Drupal Wordpress Migration Finished" /></p>
<hr />
<h2>4a. Click "<a href="/admin/content" target="_blank">Find content</a>" to view your content</h2>
<p>You are ready to go! Thanks for using Drupal!</p>
<p><img src="/profiles/wordpress_kickstart/modules/features/wpk_defaults/images/wp-admin-menu.png" alt="Drupal Admin Menu" /></p>';
  
  $content['wpk_instructions'] = (object) array(
    'exported_path' => 'wordpress-kickstart-instructions',
    'title' => 'Wordpress Kickstart Instructions',
    'status' => '1',
    'promote' => '0',
    'sticky' => '0',
    'type' => 'page',
    'language' => 'und',
    'created' => '1351885763',
    'comment' => '1',
    'translate' => '0',
    'machine_name' => 'wpk_instructions',
    'body' => array(
      'und' => array(
        0 => array(
          'value' => $body,
          'summary' => '',
          'format' => 'full_html',
          'safe_value' => $body,
          'safe_summary' => '  ',
        ),
      ),
    ),
  );

return $content;
}
