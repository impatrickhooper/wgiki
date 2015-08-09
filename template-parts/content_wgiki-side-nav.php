<?php
/**
 * The template part for displaying the Side Nav.
 *
 * @package WGI Informer
 */
?>

<?php
  /* Get the current url */
  $currentURL = getCurrentURL();

  /* Get the division this page belongs to */
  $page_div = getPageDivision();

  /* Load a few pieces of information for a user from their profile */
  $user_profile_id = get_current_user_id(); // Get the user ID
  $user_profile_division = strtolower(preg_replace('/&/i', 'and', preg_replace('/\s/i', '-', get_user_meta($user_profile_id, 'division', true)))); // Get the user division, replace "&" with "and", replace space with "-"
  $user_profile_photo = get_user_meta($user_profile_id, 'profile_photo', true); // Get link to photo
  $user_profile_data = get_userdata($user_profile_id); // Get user data
  $user_profile_name = $user_profile_data->display_name; // Get user's name
  $user_profile_email = $user_profile_data->user_email; // Get user's email
?>

<nav id="main-nav" class="side-nav main-navigation" role="navigation">
  <div class="side-nav_top <?php echo $user_profile_division; ?>">

    <?php
      /* If there's a user photo, load it here */
      if ($user_profile_photo != '') {
        echo '<p class="user-profile_img"><a href="https://wgiinformer.com/user" target="_blank"><img src="https://wgiinformer.com/wp-content/uploads/ultimatemember/' . $user_profile_id . '/profile_photo-100.jpg"></a></p>';
      }
      /* If no photo, use the default */
      else {
        echo '<p class="user-profile_img"><a href="https://wgiinformer.com/user" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/img/profile_photo-default.jpg"></a></p>';
      }
    ?>

    <div class="side-nav_top-links">
      <a href="<?php echo site_url(); ?>/logout" class="user-profile_sign-out user-profile_link"><i class="fa fa-sign-out"></i><span>sign out</span></a>
      <a href="https://wgiinformer.com/user" class="user-profile_account user-profile_link" target="_blank"><i class="fa fa-user"></i><span>my profile</span></a>
    </div><!-- side-nav_top-links -->

    <p class="user-profile_name"><?php echo $user_profile_name; ?></p>
    <p class="user-profile_email"><?php echo $user_profile_email; ?></p>
  </div><!-- side-nav_top -->

  <ul class="site-navigation">

    <li class="side-nav_item side-nav_item-first">
      <a href="<?php echo home_url(); ?>" <?php if (is_front_page()) { echo 'class="active"'; } ?>><i class="fa fa-home"></i>Home</a>
    </li>

  <?php
    /* Get menu pages based on division post types */
    $menu_pages = getDivisionPostTypes();

    /* For each menu page, do stuff */
    foreach($menu_pages as $menu_page):
      $menu_page_type = $menu_page->name; // Get menu page type
      $menu_page_archive_link = get_post_type_archive_link($menu_page_type); // Get menu page archive link
  ?>

    <li class="side-nav_item side-nav_item-first">

      <a href="<?php echo $menu_page_archive_link; ?>" <?php echo ($menu_page_archive_link == $currentURL || $menu_page_archive_link == $currentURL . '/') ? 'class="active"' : ''; ?>>
        <i class="fa fa-book"></i><?php echo $menu_page->label; ?>
      </a>

      <?php
        /* Get the name of the current menu page */
        $menu_page_name = $menu_page->rewrite['slug'];

        /* If the menu page name is the same as the current division, do stuff */
        if ($menu_page_name == $page_div) :

          /* Replace hypens with underscores to get taxonomy type */
          $cat_type = $menu_page_type;

          /* Append _tax to create taxonomy name */
          $cat_name = $cat_type . '_tax';

          /* Get category pages */
          $cat_pages = getDivisionCategories($cat_type, $cat_name);

          /* If the categories query is not empty, do stuff */
          if (!empty($cat_pages)):
      ?>

        <ul class="site-navigation_categories">

          <?php
            /* For each category, do stuff */
            foreach ($cat_pages as $cat_page):
              $cat_term_link = get_term_link($cat_page); // Get category page link
          ?>

          <li class="side-nav_item side-nav_item-second">
            <a href="<?php echo $cat_term_link; ?>" <?php echo ($cat_term_link == $currentURL || $cat_term_link == $currentURL . '/') ? 'class="active"' : ''; ?>>
              <i class="fa fa-bookmark"></i><?php echo $cat_page->cat_name; ?>
            </a>
          </li>

          <?php endforeach; ?>

        </ul>

      <?php
          endif;
        endif;
      ?>

    </li>

  <?php
    endforeach;
    wp_reset_postdata();
  ?>

  </ul><!-- .side-navigation -->
</nav><!-- #main-nav.side-nav -->
