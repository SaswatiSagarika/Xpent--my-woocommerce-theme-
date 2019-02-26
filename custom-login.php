<?php
/**
 * Template Name: Custom Login Page
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Xpent
 * @since 1.0
 * @version 1.0
 */

global $user_ID;
global $wpdb;

$error = array();

if ( !$user_ID ) {
	//user is not logged in

	if ( $_POST ) {
        $username = trim( htmlspecialchars( $_POST['user_login'] ) );
        $password = trim( htmlspecialchars( $_POST['user_pass'] ) );

        $login_array = [];
        $login_array['user_login'] = $_POST['user_login'];
        $login_array['user_password'] = $_POST['user_pass'];
    	
        if ( strpos( $username, ' ' ) !== FALSE ) {
            $error['username_space'] = "Username has Space";
        }
        if ( empty( $username ) ) {
            $error['username_empty'] = "Needed Username must";
        }

        if ( empty( $password )) {
            $error['password_empty'] = "Needed Password must";
        }

        if ( count( $error ) == 0 ) {
        	$verify_user = wp_signon( $login_array, false );
	        if ( !is_wp_error( $verify_user ) ) {
	        	// add_filter('show_admin_bar', '__return_false');
	        	$userID = $verify_user->ID;
				wp_set_current_user( $userID, $username );
				
	        	wp_redirect(site_url()."/shop/");
	            exit();
	        } else {
	        	$error['userpass'] = "Username/Password enterd is incorrect. Please enter valid data.";
	        }
	    }
    } else {

		get_header();
		?>

		<!-- BANNER STRAT -->
		<div class="banner inner-banner align-center">
			<div class="container">
				<section class="banner-detail">
					<h1 class="banner-title">Login</h1>
					<div class="bread-crumb right-side">
						<ul>
							<li><a href="index.html">Home</a>/</li>
							<li><span>Login</span></li>
						</ul>
					</div>
				</section>
			</div>
		</div>
		<!-- BANNER END --> 
		  
		<!-- CONTAIN START -->
		<section class="checkout-section ptb-60">
		    <div class="container">
		      	<div class="row">
		        	<div class="col-xs-12">
		          		<div class="row">
		           			<div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2">
				              	<form method="post" class="wp-user-form">
					                <div class="row">
					                  	<div class="col-xs-12 mb-20">
						                    <div class="heading-part heading-bg">
						                     	<h2 class="heading">Customer Login</h2>
						                    </div>
						                </div>
						                <?php if ( $_GET['variable_to_send'] ) : ?>
	                                        <div class="col-xs-12 mb-20">
	                                            
                                                <div class="alert alert-danger">
                                                	Hey! you have to login before you checkout
                                                </div>
		                                            
	                                        </div>
	                                    <?php endif; ?>
						                <?php if ( count( $error ) > 0 ) : ?>
	                                        <div class="col-xs-12 mb-20">
	                                            <ul>
		                                            <?php foreach ( $error as $key => $value ) : ?>
		                                                <li class="alert alert-danger">
		                                                	<?php echo $value; ?>
		                                                </li>
		                                            <?php endforeach; ?>
	                                            <ul>
	                                        </div>
	                                    <?php endif; ?>
					                  	<div class="col-xs-12">
						                    <div class="input-box">
						                      	<label for="user_login">Username:</label>
						                      	<input id="user_login" name="user_login" type="text" required placeholder="Enter your Username">
						                    </div>
					                  	</div>
					                  	<div class="col-xs-12">
						                    <div class="input-box">
						                      	<label for="user_pass">Password:</label>
						                      	<input id="user_pass" name="user_pass" type="password" required placeholder="Enter your Password">
						                    </div>
					                  	</div>
					                  	<div class="col-xs-12">
						                    <div class="check-box left-side"> 
						                    	<span>
						                      		<input type="checkbox" name="remember_me" id="remember_me" class="checkbox">
						                     	</span>
						                      <label for="remember_me">Remember Me</label>
						                    </div>
						                    <button name="submit" type="submit" class="btn-color right-side">Log In</button>
						                </div>
					                  	<div class="col-xs-12">
					                  		<a title="Forgot Password" class="forgot-password mtb-20" href="#">Forgot your password?</a>
					                    <hr>
					                  	</div>
						                <div class="col-xs-12">
						                    <div class="new-account align-center mt-20"> <span>New to Xpent ?</span> <a class="link" title="Register with Xpent " href="<?php wp_redirect( site_url( '/user-registration/' ) ); ?>">Create New Account</a> </div>
						                </div>
				                	</div>
				              	</form>
		           			</div>
		          		</div>
		        	</div>
		      	</div>
		    </div>
		</section>
  <!-- CONTAINER END --> 
<?php
		get_footer();
	}
	
} else {

}

?>