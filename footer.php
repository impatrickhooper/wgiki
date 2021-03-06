<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WGIki
 */
?>
    </div><!-- #content -->
    <footer id="colophon" class="site-footer" role="contentinfo">

    <?php if (is_user_logged_in()): ?>
      <div class="footer">
        <div class="grid-container">
          <?php
            $footer_divs = getDivisionPostTypes(); // Get division post types

            /* If division post types are not empty, do stuff */
            if (!empty($footer_divs)):
          ?>

            <div class="footer_managers footer_col grid-100 tablet-grid-100 mobile-grid-100 grid-parent">
              <div class="grid-100">
                <h5 class="footer_title">Content Managers</h5>
              </div>

            <?php
              /* For each division, do stuff */
              foreach ($footer_divs as $footer_div):
                $footer_div_role = 'manager_' . $footer_div->name; // Get manager role for this division
                $footer_div_label = $footer_div->label; // Get name of this division
            ?>

              <div class="footer_div footer_col-div grid-20 tablet-grid-25 mobile-grid-50">
                <h6 class="footer_title-div"><?php echo $footer_div_label; ?></h6>

                <?php
                  /**
                   * Footer Division User Arguments
                   *
                   * 1. Get users by role
                   * 2. Order by display name (First Last)
                   * 3. Order ASC from A-Z
                   */
                  $footer_div_users_args = array(
                    'role'    => $footer_div_role,
                    'orderby' => 'display_name',
                    'order'   => 'ASC'
                  );

                  /* Query the users for this division */
                  $footer_div_users = get_users($footer_div_users_args);

                  /* For each user in this division, get stuff */
                  foreach($footer_div_users as $footer_user):
                    $footer_user_name = $footer_user->display_name; // Get the name
                    $footer_user_email = $footer_user->user_email; // Get the email
                ?>

                <p><a href="mailto:<?php echo $footer_user_email; ?>"><?php echo $footer_user_name; ?></a></p>

                  <?php endforeach; ?>

              </div><!-- .footer_div -->

              <?php endforeach; ?>

            </div><!-- .footer_managers -->

            <?php endif; ?>

        </div><!-- .grid-container -->
      </div><!-- .footer -->

    <?php
      /* Output fixed action floating buttons */
      get_template_part('template-parts/content_wgiki', 'floating-buttons');
      endif;
    ?>

    </footer><!-- #colophon -->
  </div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
