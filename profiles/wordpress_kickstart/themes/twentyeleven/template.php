<?php

/**
 * @file
 * The core customizations for the Twenty Eleven theme.
 */

/**
 * Implements template_preprocess_page.
 */
function twentyeleven_preprocess_page(&$vars) {
  $header_img = theme_get_setting("twentyeleven_header_image");
  if ($header_img == "<random>") {
    $dir = path_to_theme() . "/images/headers";
    $images = file_scan_directory($dir, '/.*\.jpg$/');

    $custom_headers_path = 'public://twentyeleven_headers';
    if (file_prepare_directory($custom_headers_path)) {
      $images = array_merge($images, file_scan_directory($custom_headers_path, '/.*\.jpg$/'));
    }
    $header_image_attrs = array(
      'path' => array_rand($images),
      'alt' => '',
      'title' => '',
      'width' => '1000',
      'height' => '288',
      'attributes' => array('id' => 'header-image'),
    );
  }
  else {
    $header_image_attrs = array(
      'path' => $header_img,
      'alt' => '',
      'title' => '',
      'width' => '1000',
      'height' => '288',
      'attributes' => array('id' => 'header-image'),
    );
  }
  $vars['header_image'] = theme('image', $header_image_attrs);
  $search_block = module_invoke('search', 'block_view', 'search');
  $vars['search_box'] = render($search_block);
  if ($vars['page']['sidebar_first']) {
    $vars['content_region_id'] = 'region-content-with-sidebar';
  }
  else {
    $vars['content_region_id'] = 'region-content-without-sidebar';
  }
}

/**
 * Implements template_preprocess_comment.
 */
function twentyeleven_preprocess_comment(&$vars) {
  $comment = $vars['elements']['#comment'];
  $uri = entity_uri('comment', $comment);
  $vars['permalink'] = l(t('!datetime', array('!datetime' => $vars['created'])), $uri['path'], $uri['options']);
  $vars['submitted'] = t('!username on', array('!username' => $vars['author']));
  $vars['comment_string'] = t('!author on !permalink said:', array('!username' => $vars['author'], '!permalink' => $vars['permalink']));
}

/**
 * Implements template_preprocess_node.
 */
function twentyeleven_preprocess_node(&$vars) {
  $vars['submitted'] = t('Posted on !datetime', array('!datetime' => $vars['date']));
  if ($vars['type'] == 'blog') {
    unset($vars['content']['links']['blog']);
    if (!$vars['teaser']) {
      $vars['classes_array'][] = 'full-page';
    }
  }
  if (isset($vars['content']['links']['comment-comments'])) {
    $vars['content']['links']['comment-comments']['title'] = $vars['node']->comment_count;
  }
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function twentyeleven_form_search_block_form_alter(&$form, &$form_state) {
  $form['actions']['submit']['#attributes']['id'] = "search-form-button";
}

/**
 * Implements hook_form_alter().
 */
function twentyeleven_form_search_form_alter(&$form, &$form_state, $form_id) {
  $form['basic']['submit']['#attributes']['id'] = "search-form-button";
}

/**
 * Changes the search form to use the HTML5 "search" input attribute.
 */
function twentyeleven_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="search"', 'type="text"', $vars['search_form']);
}

/**
 * Changes the default meta content-type tag to the shorter HTML5 version.
 */
function twentyeleven_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8',
  );
}

/**
 * Uses RDFa attributes if the RDF module is enabled.
 *
 * Lifted from Adaptivetheme for D7, full credit to Jeff Burnz
 * ref: http://drupal.org/node/887600
 */
function twentyeleven_preprocess_html(&$vars) {
  // Ensure that the $vars['rdf'] variable is an object.
  if (!isset($vars['rdf']) || !is_object($vars['rdf'])) {
    $vars['rdf'] = new StdClass();
  }
  
  if (module_exists('rdf')) {
    $vars['doctype'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML+RDFa 1.1//EN">' . "\n";
    $vars['rdf']->version = 'version="HTML+RDFa 1.1"';
    $vars['rdf']->namespaces = $vars['rdf_namespaces'];
    $vars['rdf']->profile = ' profile="' . $vars['grddl_profile'] . '"';
  }
  else {
    $vars['doctype'] = '<!DOCTYPE html>' . "\n";
    $vars['rdf']->version = '';
    $vars['rdf']->namespaces = '';
    $vars['rdf']->profile = '';
  }
}
