<h2><?php echo $this->title; ?></h2>
<p class="custom-text"><?php echo $this->subtitle; ?></p>
<form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
    <input type="hidden" name="action" value="angelleye_paypal_wp_button_manager_admin_<?php echo $this->base_slug; ?>"><label class="sub-title btn-text" ><?php _e('HTML Template','angelleye-paypal-wp-button-manager'); ?></label>
    <div class="html-template-list">
       <p><?php echo $this->overridden_template ? sprintf( __('This template has been overriden by your theme and can be found in: %s','angelleye-paypal-wp-button-manager'), '<code>' . trailingslashit( basename( get_stylesheet_directory() ) ) . str_replace( 'templates/', '', plugin_basename($this->template_path) ) . '</code>') : sprintf( __('To override and edit this template, copy %s to your theme folder: %s','angelleye-paypal-wp-button-manager'), '<code>' . plugin_basename($this->template_path) . '</code>', '<code>' . trailingslashit( basename( get_stylesheet_directory() ) ) . str_replace( 'templates/', '', plugin_basename($this->template_path) ) . '</code>'); ?></p>
       <div class="html-template"><?php
            if( !$this->overridden_template ){
                ?><a href="<?php echo admin_url('admin-post.php?action=angelleye_paypal_wp_button_manager_admin_' . $this->base_slug . '_copy_template'); ?>" class="button"><?php _e('Copy file to theme','angelleye-paypal-wp-button-manager'); ?></a><?php
            } else {
                ?><a href="<?php echo admin_url('admin-post.php?action=angelleye_paypal_wp_button_manager_admin_' . $this->base_slug . '_delete_template'); ?>" class="button"><?php _e('Delete template file','angelleye-paypal-wp-button-manager'); ?></a><?php
            }
            ?><button type="button" class="button toggle_editor"><?php _e('View template','angelleye-paypal-wp-button-manager'); ?></a>
       </div>
    </div>
    <textarea class="template-code" name="template_code" cols="25" rows="20" style="display: none;" <?php echo !$this->overridden_template ? 'readonly="readonly" disabled="disabled"' : ''; ?>><?php echo $template; ?></textarea>
    <button class="save-btn" type="submit" name="save_<?php echo $this->base_slug; ?>"><?php _e('Save changes','angelleye-paypal-wp-button-manager'); ?></button>
</form>