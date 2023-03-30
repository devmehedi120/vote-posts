<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://fiverr.com/wpdevmehedi
 * @since      1.0.0
 *
 * @package    Vote_Post
 * @subpackage Vote_Post/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Vote_Post
 * @subpackage Vote_Post/admin
 * @author     Mehedi Hasan <mehedi420@gmail.com>
 */
class Vote_Post_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vote_Post_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vote_Post_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vote-post-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style($this->plugin_name);

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vote_Post_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vote_Post_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vote-post-admin.js', array( 'jquery' ), $this->version, false );

	}

	function admin_menu_page(){
		add_menu_page("Vote posts", "Vote posts", "manage_options", "vote-posts", [$this, "vote_post_menu_page"], "dashicons-admin-generic", 45);

		//for tab1 section
		add_settings_section("vote_post_tab1_section", "", "", "vote_post_tab1_page");
		add_settings_field("vp_user_name", "Username", [$this, "username_field"], "vote_post_tab1_page", "vote_post_tab1_section");
		register_setting("vote_post_tab1_section", "vp_user_name");
		add_settings_field("vp_user_email", "Email", [$this, "email_field"], "vote_post_tab1_page", "vote_post_tab1_section");
		register_setting("vote_post_tab1_section", "vp_user_email");
		add_settings_field("vp_user_pass", "Password", [$this, "password_field"],"vote_post_tab1_page", "vote_post_tab1_section");
		register_setting("vote_post_tab1_section", "vp_user_pass");


		//for tab2 section
		add_settings_section('vote_credit_tab2_section', '', '', 'vote_credit_tab2_page');
		add_settings_field("vp_user_credit", "Credits", [$this, "credit_field"], 'vote_credit_tab2_page','vote_credit_tab2_section');
		register_setting('vote_credit_tab2_section','vp_user_credit' );


	}

	
	function username_field(){
		echo '<input class="widefat" type="text" name="vp_user_name" value="'.get_option('vp_user_name').'">';
	}


	function email_field(){
		echo '<input class="widefat" type="email" name="vp_user_email" value="'.get_option('vp_user_email').'">';
	}

	function password_field(){
		echo '<input class="widefat" type="password" name="vp_user_pass" value="'.get_option('vp_user_pass').'">';
	}
	function credit_field(){
		echo '<input type="text" name="vp_user_credit" value="'.get_option('vp_user_credit').'">';
	}
	function vote_post_menu_page(){
		require_once plugin_dir_path(__FILE__)."partials/vote-post-admin-display.php";
	}




// user credit field add
	function add_credits_column($columns) {
		$columns['credits'] = 'Credits';
		$columns['money'] = 'Money';
		
		
		return $columns;
	}


function custom_user_column_data( $output, $column_name, $user_id ) {
    if ( 'credits' === $column_name ) {
        $credit = get_user_meta( $user_id, 'vp_credit', true );
		return '<input data-id="'.$user_id.'" class="usercredit" type="number" style="width: 50px" value="'.$credit.'"> left <b style="color: dodgerblue">3</b>';
    }

    return $output;
}

	
	
	
}
