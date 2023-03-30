<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://fiverr.com/wpdevmehedi
 * @since      1.0.0
 *
 * @package    Vote_Post
 * @subpackage Vote_Post/admin/partials
 */
?>
<h3>Settings</h3>
<hr>

<section class="page">
   <div class="tabs">
      <ul class="tab-list">
         <li class="active">
            <a class="tab-control" href="#tab-1">
               Tab 1
            </a>
         </li>
         <li>
            <a class="tab-control" href="#tab-2">
               Tab 2
            </a>
         </li>
         <li>
            <a class="tab-control" href="#tab-3">
               Tab 3
            </a>
         </li>
      </ul>
      <div class="tab-panel active" id="tab-1">
        <form class="tab1form" action="options.php" method="post">
            <?php settings_fields("vote_post_tab1_section") ?>
            <?php do_settings_sections("vote_post_tab1_page") ?>
            <?php do_settings_sections("vote_post_tab2_page") ?>
            <?php do_settings_sections("vote_post_tab3_page") ?>
			<?php echo get_submit_button("Save", "button-primary") ?>
		</form>
      </div>
      <div class="tab-panel" id="tab-2">
      <form class="tab2form" action="options.php" method="post">
         <?php settings_fields("vote_credit_tab2_section") ?>
         <?php do_settings_sections("vote_credit_tab2_page") ?>
			<?php submit_button("Save") ?>
		</form>
      </div>
      <div class="tab-panel" id="tab-3">
     
      </div>
   </div>
</section> 
