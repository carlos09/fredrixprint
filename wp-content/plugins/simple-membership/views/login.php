<?php
$auth = SwpmAuth::get_instance();
$setting = SwpmSettings::get_instance();
$password_reset_url = $setting->get_value('reset-page-url');
$join_url = $setting->get_value('join-us-page-url');
?>

<form id="swpm-login-form" name="swpm-login-form" method="post" action="">
  <fieldset class="form-group">
    <label for="swpm_user_name" class="swpm-label"><?php echo SwpmUtils::_('Username') ?></label>
    <input type="text" class="swpm-text-field swpm-username-field form-control" id="swpm_user_name" value="" name="swpm_user_name" />
  </fieldset>
  <fieldset class="form-group">
    <label for="swpm_password" class="swpm-label"><?php echo SwpmUtils::_('Password') ?></label>
    <input type="password" class="swpm-text-field swpm-password-field form-control" id="swpm_password" value="" name="swpm_password" />
  </fieldset>

  <button type="submit" class="btn btn-primary swpm-login-form-submit" name="swpm-login" value="<?php echo SwpmUtils::_('Login') ?>">Submit</button>

  <fieldset class="form-group">
    <div class="swpm-login-action-msg">
        <span class="swpm-login-widget-action-msg"><?php echo $auth->get_message(); ?></span>
    </div>
  </fieldset>
</form>
