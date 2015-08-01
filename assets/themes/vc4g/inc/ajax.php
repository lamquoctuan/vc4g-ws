<?php
require_once(CUR_THEME_DIR . '/inc/Helper.php');
require_once(CUR_THEME_DIR . '/inc/Connectors/MailChimp.php');
use \LNR\Connectors\MailChimp;

add_action( 'wp_ajax_ajax_subscribe', 'ajax_subscribe_callback' );
add_action( 'wp_ajax_nopriv_ajax_subscribe', 'ajax_subscribe_callback' );
function ajax_subscribe_callback() {
    $action = sanitize_text_field( $_POST['action'] );
    $strSpecial = CUR_THEME_NAME . gmdate('Y-m-d') . '-' . $action;
    check_ajax_referer( $strSpecial, 'security' );
	
	$email = urldecode($_POST['email']);
	$phone = sanitize_text_field($_POST['phone']);
	$message = urldecode(sanitize_text_field($_POST['message']));

	$mcConnector = new MailChimp();
	$result = $mcConnector->listSubscribe('318f04aa5e', $email, '', '', $phone, '', $message);
	
	$response = $result;
	wp_die(json_encode($response));
}

add_action( 'wp_ajax_ajax_contact', 'ajax_contact_callback' );
add_action( 'wp_ajax_nopriv_ajax_contact', 'ajax_contact_callback' );
function ajax_contact_callback() {
    $action = sanitize_text_field( $_POST['action'] );
    $strSpecial = CUR_THEME_NAME . gmdate('Y-m-d') . '-' . $action;
    check_ajax_referer( $strSpecial, 'security' );
	
	$first_name = urldecode(sanitize_text_field($_POST['first_name']));
	$last_name = urldecode(sanitize_text_field($_POST['last_name']));
	$email = urldecode($_POST['email']);
	$phone = sanitize_text_field($_POST['phone']);
	$subject = urldecode(sanitize_text_field($_POST['subject']));
	$message = urldecode(sanitize_text_field($_POST['message']));

	$mcConnector = new MailChimp();
	$result = $mcConnector->listSubscribe('318f04aa5e', $email, '', '', $phone, $subject, $message);
	
	$response = $result;
	wp_die(json_encode($response));
}
?>