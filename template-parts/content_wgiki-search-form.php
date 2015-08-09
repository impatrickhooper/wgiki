<?php
/**
 * The template part for displaying the search form.
 *
 * @package WGI Informer
 */
?>

<form id="search-form" role="search" method="get" action="<?php echo site_url(); ?>">
  <div class="search-field">
    <label for="s">
      <i class="fa fa-search search-field_search-icon"></i>
      <i class="fa fa-arrow-left search-field_close-icon"></i>
      <span><input id="s" name="s" type="search" placeholder="Search"></span>
    </label>
  </div><!-- .search-field -->
</form>
