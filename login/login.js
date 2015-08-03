(function($) {

/* Login Form
   ========================================================================== */

  /* Change header to "Login" */
  $('.login-action-login #login h1').text('Login');

  /* Insert an asterisk for required fields */
  $('.login-action-login #loginform label br').before('<span class="field-required">*</span>');

  /* Change label from "Remember Me" to "Keep me signed in" */
  $(".login-action-login .forgetmenot label").html('<input name="rememberme" type="checkbox" id="rememberme" value="forever">Keep me signed in');

  /* Change submit button to say "Login" */
  $(".login-action-login #login #wp-submit").val('Login');

  /* Change "Lost your password?" to "Forgot your password?" */
  $('.login-action-login #login #nav a[title="Password Lost and Found"]').text('Forgot your password?');

/* Passowrd Reset Form
 ========================================================================== */

  /* Change header to "Password Reset" */
  $('.login-action-lostpassword #login h1').addClass('entry-title').text('Password Reset');

  /* Change message to "To reset your password, please enter..." */
  $('.login-action-lostpassword .message').text('To reset your password, please enter your email address or username below');

  /* Change the user login input to just the input - no label */
  $('.login-action-lostpassword #user_login').parent().parent().html('<input type="text" name="user_login" id="user_login" class="input" value="" size="20" placeholder="Enter your username or email">');

  /* Change "Get password" to "Reset My Password" */
  $(".login-action-lostpassword #login #wp-submit").val('Reset My Password');

})(jQuery);
