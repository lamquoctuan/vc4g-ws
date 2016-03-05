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

	$first_name = urldecode(sanitize_text_field(\LNR\Helper::getVal('first_name', $_POST, '')));
	$last_name = urldecode(sanitize_text_field(\LNR\Helper::getVal('last_name', $_POST, '')));
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

add_action( 'wp_ajax_ajax_mail_in_service', 'ajax_mail_in_service_callback' );
add_action( 'wp_ajax_nopriv_ajax_mail_in_service', 'ajax_mail_in_service_callback' );
function ajax_mail_in_service_callback() {
    $action = sanitize_text_field( $_POST['action'] );
    $strSpecial = CUR_THEME_NAME . gmdate('Y-m-d') . '-' . $action;
    check_ajax_referer( $strSpecial, 'security' );
	
	$first_name = urldecode(sanitize_text_field($_POST['first_name']));
	$last_name = urldecode(sanitize_text_field($_POST['last_name']));
	$email = urldecode($_POST['email']);
	$source = 'Web Form - Mail-in-Service';
	$phone = sanitize_text_field($_POST['phone']);
	$type = sanitize_text_field($_POST['type']);
	$address = array(
		'address' => sanitize_text_field($_POST['address']),
		'city' => sanitize_text_field($_POST['city']),
		'state' => sanitize_text_field($_POST['state']),
		'zip' => sanitize_text_field($_POST['zip']),
	);

	$mcConnector = new MailChimp();
	$result = $mcConnector->listSubscribe('bff0c06eb6', $source, $email, $first_name, $last_name, $phone, '', '', $address, $type);
	$response = $result;
	wp_die(json_encode($response));
}

add_action( 'wp_ajax_ajax_calculate', 'ajax_calculate_callback' );
add_action( 'wp_ajax_nopriv_ajax_calculate', 'ajax_calculate_callback' );
function ajax_calculate_callback() {
	global $wpdb;
    $action = sanitize_text_field( $_POST['action'] );
	
	$type		= sanitize_text_field($_POST['type']);
	$weight		= sanitize_text_field($_POST['weight']);
	$unit		= sanitize_text_field($_POST['unit']);
	$purityId	= sanitize_text_field($_POST['purity']);
	
	$tableQuery = "SELECT id FROM `vc4g_{$type}_table` ORDER BY modified_time DESC LIMIT 0 , 1";
	$tableId	= $wpdb->get_var($tableQuery);
	$priceQuery = "SELECT price_individuals FROM `vc4g_{$type}_price`
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

add_action( 'wp_ajax_ajax_gold_prices', 'ajax_gold_prices_callback' );
add_action( 'wp_ajax_nopriv_ajax_gold_prices', 'ajax_gold_prices_callback' );
function ajax_gold_prices_callback() {
	global $wpdb;
	$response = new \StdClass();
    $action = sanitize_text_field( $_GET['action'] );
	$dateStart = date('Y-m-d', strtotime('-7 day'));
	
	$url = "https://www.quandl.com/api/v1/datasets/WGC/GOLD_DAILY_CAD.json?trim_start={$dateStart}";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
     
	$resultJson = curl_exec($ch);

	$info = curl_getinfo($ch);
	$httpCode = $info['http_code'];

	curl_close($ch);
	
	$result = json_decode($resultJson);
	$error = '';
	if (isset($result->data) ) {
		$columnNames	= $result->column_names;
		$data			= $result->data;
		
		$response->success = true;
		$response->data = array();
		array_push($response->data, $columnNames);
		for($idx = count($data)-1; $idx>=0; $idx--) {
			array_push($response->data, $data[$idx]);
		}
		// $response->data = json_encode($response->data);
	}
	else {
		$response->success = false;
		if (isset($result->error)) {
			$response->error = $result->error;
		}
		else {
			$response->error = $resultJson;
		}
	}
	wp_die(json_encode($response));
}
?>