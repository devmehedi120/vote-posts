<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://fiverr.com/wpdevmehedi
 * @since      1.0.0
 *
 * @package    Vote_Post
 * @subpackage Vote_Post/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Vote_Post
 * @subpackage Vote_Post/public
 * @author     Mehedi Hasan <mehedi420@gmail.com>
 */
class Vote_Post_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vote-post-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vote-post-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name, "voteAjax", array(
			'ajaxurl' => admin_url("admin-ajax.php"),
			'nonce' => wp_create_nonce("votenonce"),
		
		));

	}

	function the_content_filter_html($contents){
		ob_start();
		require_once plugin_dir_path(__FILE__)."partials/vote-post-public-display.php";
		$voteModule = ob_get_clean();
		$contents .= $voteModule;
		return $contents;
	}

	// Calling from ajax
	function vote_adding_process(){
		if(!wp_verify_nonce($_POST['nonce'], "votenonce")){
			die("Invalid request!");
		}

		if(!is_user_logged_in()){
			echo json_encode(array("login" => "Login" ));
			die;
		}

		if(empty($_POST['postId'])) die("Errors");

		$userId = get_current_user_id();
		
		$postId = intval($_POST['postId']);
		$votes = get_post_meta($postId, "votepost_votes", true);

		// With userid
		$votes = ((is_array($votes)) ? $votes : []);
		if(in_array($userId, $votes)){
			echo json_encode(array("error" => "You already votted." ));
			die;
		}

		$votes[$userId] = $userId;
		update_post_meta($postId, "votepost_votes", $votes);
		
		$votes = get_post_meta($postId, "votepost_votes", true);
		$votes = ((is_array($votes)) ? $votes : []);

		echo json_encode(array("success" => sizeof($votes)));
		die;
	}

	// Calling from ajax
	function downvote_adding_process(){
		if(!wp_verify_nonce($_POST['nonce'], "votenonce")){
			die("Invalid request!");
		}

		if(!is_user_logged_in()){
			echo json_encode(array("login" => "Login" ));
			die;
		}

		if(empty($_POST['postId'])) die("Errors");

		$userId = get_current_user_id();
		
		$postId = intval($_POST['postId']);
		$votes = get_post_meta($postId, "votepost_votes", true);

		// With userid
		$votes = ((is_array($votes)) ? $votes : []);
		if(in_array($userId, $votes)){
			unset($votes[$userId]);
			update_post_meta($postId, "votepost_votes", $votes);
		}
		
		$votes = get_post_meta($postId, "votepost_votes", true);
		$votes = ((is_array($votes)) ? $votes : []);

		echo json_encode(array("success" => sizeof($votes)));
		die;
	}

	function login_modal_html(){
		?>
		<div class="loginModal dnone">
			<div class="modalContents">
				<h3>Sign In</h3>
				<div class="alert"></div>
				<span class="closeModal">+</span>
				<div class="formField">
					<label for="userEmail">Email</label>
					<input type="email" id="userEmail">
				</div>
				<div class="formField">
					<label for="userPass">Password</label>
					<input type="password" id="userPass">
				</div>

				<div class="formBtns">
					<button class="loginBtn">Sign In</button>
					<a href="<?php echo esc_url(home_url('/registration')) ?>" class="registeredBtn">Sign Up</a>
				</div>
			</div>
		</div>
		<?php
	}


	// Ajax login
	function do_login(){
		if(!wp_verify_nonce($_POST['nonce'], "votenonce")){
			die("Invalid request!");
		}

		if(!isset($_POST['email']) && !isset($_POST['pass'])){
			echo json_encode(array("error" => "Invalid credentials"));
			die;
		}

		$email = sanitize_email($_POST['email']);
		$username = explode("@", $email)[0];

		$pass = sanitize_text_field($_POST['pass']);

		$user = get_user_by("email", $email);
		if(is_wp_error($user)){
			echo json_encode(array("error" => "User dosnet exist!"));
			die;
		}
		
		// Use the wp_signon() function to authenticate the user
		$user = wp_signon(array(
			'user_login' => $username,
			'user_password' => $pass,
			'remember' => true
		), false);

		if (is_wp_error($user)) {
			echo json_encode(array("error" => "Invalid credentials"));
			die;
		} else {
			echo json_encode(array("success" => "You have successfully logged in."));
			die;
		}

		die;
	}
}