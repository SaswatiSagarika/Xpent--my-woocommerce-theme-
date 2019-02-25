<?php
/**
 * Template Name: Custom Registartion Page
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Xpent
 * @since 1.0
 * @version 1.0
 */
get_header();
global $wpdb;
if ( $_POST ) {
    $username = $_POST['txtUsername'];
    $email = $_POST['txtEmail'];
    $zip = $_POST['txtZip'];
    $password = $_POST['txtPassword'];
    $ConfPassword = $_POST['txtConfirmPassword'];
    $error = array();
    
    if ( strpos( $username, ' ' ) !== FALSE ) {
        $error['username_space'] = "Username has Space";
    }

    if ( empty( $username ) ) {
        $error['username_empty'] = "Needed Username must";
    }

    if ( !is_numeric( $zip ) || strlen( $zip ) != 5 ) {
        $error['zip_empty'] = "Enter a valid zip code";
    }
    
    if ( username_exists( $username ) ) {
        $error['username_exists'] = "Username already exists";
    }

    if ( !is_email( $email ) ) {
        $error['email_valid'] = "Email has no valid value";
    }

    if ( email_exists( $email ) ) {
        $error['email_existence'] = "Email already exists";
    }

    if ( strcmp( $password, $ConfPassword ) !== 0 ) {
        $error['password'] = "Password MisMatch: Password didn't match";
    }

    
    if ( count( $error ) == 0 ) {
        $userdata = array(
            'user_login'    =>  $username,
            'user_pass'     =>  $password,
            'user_email'    =>  $email,
            'display_name'  =>  $username,
            'nickname'      =>  $username,
            'role'          =>  'customer',
            'display_name'  =>  $username
        );

        $user_id = wp_insert_user( $userdata ) ;
        if ( !is_wp_error( $user_id ) ) {
            update_user_meta( $user_id, 'zip_code', $zip );
            wp_redirect(site_url()."/shop/");
            exit();
        } 
        
    }
}

?>
    <div class="banner inner-banner align-center">
        <div class="container">
            <section class="banner-detail">
                <h1 class="banner-title">Register</h1>
                <div class="bread-crumb right-side">
                    <ul>
                        <li><a href="index.html">Home</a>/</li>
                        <li><span>Register</span></li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
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
                                            <h2 class="heading">Create your account</h2>
                                        </div>
                                    </div>
                                     <?php if ( count( $error ) > 0 ) : ?>
                                        <div class="col-xs-12 mb-20">
                                            <ul>
                                                <?php foreach ( $error as $key => $value ) :?>
                                                    <li class="alert alert-danger">
                                                        <?php echo $value; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            <ul>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-xs-12">
                                        <div class="input-box form-group">
                                            <label for="txtUsername">Enter the Username:</label>
                                            <input type="text" name="txtUsername" id="txtUsername" required placeholder="Enter your UserName">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box form-group">
                                            <label for="txtEmail">Enter the Email:</label>
                                            <input id="txtEmail" name="txtEmail" type="email" required placeholder=" Enter your Email Address">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box form-group">
                                            <label for="txtZip">Enter the Zip:</label>
                                            <input type="text" id="txtZip" name="txtZip" required placeholder="Enter your ZipCode ">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box form-group">
                                            <label for="txtPassword">Enter the Password:</label>
                                            <input id="txtPassword" name="txtPassword" type="password" required placeholder="Enter your Password">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box form-group">
                                            <label for="txtConfirmPassword">Enter the Confirm Password:</label>
                                            <input id="txtConfirmPassword" name="txtConfirmPassword" type="password" required placeholder="Enter your Confirm Password">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <button name="submit" type="submit" class="btn-color right-side">Submit</button>
                                    </div>
                                    <div class="col-xs-12">
                                        <hr>
                                        <div class="new-account align-center mt-20"> <span>Already have an account with us</span> <a class="link" title="Register with Xpent " href="<?php wp_redirect( site_url( '/user-login/' ) ); ?>">Login Here</a> </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>