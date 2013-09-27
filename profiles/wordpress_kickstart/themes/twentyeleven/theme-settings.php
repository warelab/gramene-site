<?php

/**
 * @file
 * Provides TwentyEleven specific theme settings.
 */

/**
 *     Implements hook_form_system_theme_settings_alter().
 */
function twentyeleven_form_system_theme_settings_alter(&$form, &$form_state) {
  $form['header_image_fid'] = array(
    '#title' => t('Upload header image'),
    '#type' => 'file',
    '#description' => t('Images must be one of jpg, bmp, gif or png formats and 1000 x 288 pixels.'),
    '#upload_location' => path_to_theme() . "/images/headers",
  );
  $form['#submit'][] = 'twentyeleven_settings_submit';
  $form['#validate'][] = 'twentyeleven_settings_validate';


  $images = _twentyeleven_get_header_list(TRUE);
  $options = array("<random>" => "<Random Header Image>");

  foreach ($images as $filename => $data) {
    $options[$filename] = $data->pretty_name;
  }

  // -- Get the header image setting.
  $current = theme_get_setting("twentyeleven_header_image", "twentyeleven");
  $default = in_array($current, array_keys($options)) ? $current : "<random>";
  $form["twentyeleven_header_image"] = array(
    "#type" => "select",
    "#title" => t("Header image"),
    "#options" => $options,
    "#default_value" => $default,
  );
}

/**
 * Validate the header image submitted in theme settings.
 */
function twentyeleven_settings_validate($form, &$form_state) {
  $validators = array(
    'file_validate_is_image' => array(),
    'file_validate_image_resolution' => array('1000x288', '1000x288'),
  );

  $filepath = 'public://twentyeleven_headers';
  file_prepare_directory($filepath, FILE_CREATE_DIRECTORY);
  $file = file_save_upload('header_image_fid', $validators, $filepath);
  if (isset($file)) {
    // File upload was attempted.
    if ($file) {
      // Put the temporary file in form_values so we can save it on submit.
      $form_state['values']['header_image_fid'] = $file;
    }
    else {
      // File upload failed.
      form_set_error('header_image_fid', t('The header image could not be uploaded.'));
    }
  }
}

/**
 * Process twentyeleven_theme_settings submissions.
 */
function twentyeleven_settings_submit($form, &$form_state) {
  if ($file = $form_state['values']['header_image_fid']) {
    $file->status = FILE_STATUS_PERMANENT;
    file_save($file);
    if ($file) {
      drupal_set_message(t('The custom header image @image_name was uploaded and saved.', array('@image_name' => $file->filename)));
    }
  }
}

/**
 * Retrieves a list of header images. Taken from Nitobe theme.
 *
 * Scans the headers directory and generate a "pretty" name for each. Pretty
 * names are generated from the image's path within the headers directory using
 * these rules:
 * -# '/' is replaced with ' / '
 * -# '_' is replaced with ' '.
 * -# '.***' extension is removed.
 *
 * @param boolean $refresh
 *   If TRUE, reload the image list and flush the cached version.
 *
 * @return array
 *   A mapping of the headers' pretty names to their actual names.
 */
function _twentyeleven_get_header_list($refresh = FALSE) {
  // -- If caching is disabled, force a refresh.
  if (!$refresh && (variable_get('cache', 0) == 0)) {
    $refresh = TRUE;
  }

  $cached = cache_get("twentyeleven.headers.list");
  $files = (!empty($cached)) ? $cached->data : NULL;

  if (($files == NULL) OR ($refresh == TRUE)) {
    $dir = drupal_get_path("theme", "twentyeleven") . "/images/headers";
    $images = file_scan_directory($dir, '/.*\.jpg$/');

    $custom_headers_path = 'public://twentyeleven_headers';
    if (file_prepare_directory($custom_headers_path)) {
      $images = array_merge($images, file_scan_directory($custom_headers_path, '/.*\.jpg$/'));
    }

    foreach ($images as $filename => $data) {
      $name = basename($filename);
      $name = preg_replace('/\//', ' / ', $name);
      $name = preg_replace('/_/', ' ', $name);
      $name = preg_replace('/\.(\w{3,4}$)/', '', $name);

      $data->pretty_name = $name;
    }

    // -- Cache the list for a week.
    cache_set("twentyeleven.headers.list", $images, 'cache', time() + 604800);
  }

  return $images;
}
