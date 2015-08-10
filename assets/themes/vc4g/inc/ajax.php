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
	$source = 'Web Form - Newsletter';

	$mcConnector = new MailChimp();
	$result = $mcConnector->listSubscribe('318f04aa5e', $source, $email, '', '', $phone, '', $message);
	
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
	$source = 'Web Form - Contact us';

	$mcConnector = new MailChimp();
	$result = $mcConnector->listSubscribe('774eb45430', $source, $email, $first_name, $last_name, $phone, $subject, $message);
	
	$response = $result;
	wp_die(json_encode($response));
}

add_action( 'wp_ajax_ajax_download', 'ajax_download_callback' );
add_action( 'wp_ajax_nopriv_ajax_download', 'ajax_download_callback' );
function ajax_download_callback() {
    $action = sanitize_text_field( $_POST['action'] );
    $strSpecial = CUR_THEME_NAME . gmdate('Y-m-d') . '-' . $action;
    check_ajax_referer( $strSpecial, 'security' );
	
	$first_name = urldecode(sanitize_text_field($_POST['first_name']));
	$last_name = urldecode(sanitize_text_field($_POST['last_name']));
	$email = urldecode($_POST['email']);
	$source = 'Web Form - Download';

	$mcConnector = new MailChimp();
	$result = $mcConnector->listSubscribe('0d40c495ab', $source, $email, $first_name, $last_name);
	if (isset ($result->id)) {
		$fileUri = generatePdf();
		$result->download_url = $fileUri;
	}
	$response = $result;
	wp_die(json_encode($response));
}

add_action( 'wp_ajax_ajax_caltulate', 'ajax_caltulate_callback' );
add_action( 'wp_ajax_nopriv_ajax_caltulate', 'ajax_caltulate_callback' );
function ajax_caltulate_callback() {
	global $wpdb;
    $action = sanitize_text_field( $_POST['action'] );
	
	$type		= sanitize_text_field($_POST['type']);
	$weight		= sanitize_text_field($_POST['weight']);
	$unit		= sanitize_text_field($_POST['unit']);
	$purityId	= sanitize_text_field($_POST['purity']);
	
	$tableQuery = "SELECT id FROM `vc4g_{$type}_table` ORDER BY modified_time DESC LIMIT 0 , 1";
	$tableId	= $wpdb->get_var($tableQuery);
	$priceQuery 		= "SELECT price_individuals FROM `vc4g_gold_price`
					WHERE table_id = {$tableId} AND purity_id = {$purityId}";
	$pricePerGram	= $wpdb->get_var($priceQuery);
	
	$convertionRate = array (
		'g'		=> 1,
		'oz'	=> 31.1,
		'dwt'	=> 1.555
	);
	$price = $weight * $convertionRate[$unit] * $pricePerGram;
	
	$response = array('price' => $price);
	wp_die(json_encode($response));
}
?>