<?php
/**
 * The template part for protecting direct link to files to logged in users.
 *
 * @package WGIki
 */
?>

<?php
  /**
   * Protected files
   *
   * 1. Check if query parameter with protected filename has been passed with request
   * 2. Check if user is logged in
   * 3. Load code to handle serving of protected files
   */
  if (isset($_GET['file']) && is_user_logged_in()) {
    /* Flush output buffers so we can set our own headers */
    ob_clean();
    ob_flush();
    $upload = wp_upload_dir(); // Upload object is default WordPress upload directory
    $file= $_GET['file']; // Get the file name
    $file = $upload[ 'basedir' ] . '/' . $file; // Create the entire filename path

    /* If the file is not a file or empty, output a 404 not found error */
    if (!is_file($file)) {
      status_header( 404 );
      die('404 &#8212; File not found.');
    }
    $mime = wp_check_filetype($file); // Get file type
    if(false === $mime['type'] && function_exists('mime_content_type')) {
      $mime['type'] = mime_content_type($file);
    }
    if($mime['type']) {
      $mimetype = $mime['type'];
    }
    else {
      $mimetype = 'image/' . substr($file, strrpos($file, '.') + 1);
    }

    /* Start outputting headers */
    header('Content-type: ' . $mimetype);
    if (false === strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS')) {
      header('Content-Length: ' . filesize($file));
    }
    header("Content-disposition: inline; filename=" . basename($file));
    $last_modified = gmdate('D, d M Y H:i:s', filemtime($file));
    $etag = '"' . md5($last_modified) . '"';
    header("Last-Modified: $last_modified GMT");
    header('ETag: ' . $etag);
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 100000000) . ' GMT');
    $client_etag = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : false;
    if(!isset( $_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
      $_SERVER['HTTP_IF_MODIFIED_SINCE'] = false;
    }
    $client_last_modified = trim($_SERVER['HTTP_IF_MODIFIED_SINCE']);
    $client_modified_timestamp = $client_last_modified ? strtotime($client_last_modified) : 0;
    $modified_timestamp = strtotime($last_modified);
    if (( $client_last_modified && $client_etag)
      ? (($client_modified_timestamp >= $modified_timestamp) && ($client_etag == $etag))
      : (($client_modified_timestamp >= $modified_timestamp) || ($client_etag == $etag))
      ) {
      status_header(304);
      exit;
    }
    readfile($file); // Return the file
    die();
  }
  /* Else if a request for a protected file was made but the user is not logged in, redirect to login form */
  elseif (isset($_GET['file']) && !is_user_logged_in()) {
    auth_redirect();
  }
  /* Otherwise redirect to the home page */
  else {
    wp_redirect(home_url());
    exit();
  }
?>
