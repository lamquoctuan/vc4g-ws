<?php
/**
 *  WP-SpamShield Security
 *  File Version 1.9.9.5
 */

if( !defined( 'ABSPATH' ) || !defined( 'WPSS_VERSION' ) ) {
	if( !headers_sent() ) { @header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden',TRUE,403); @header('X-Robots-Tag: noindex',TRUE); }
	die( 'ERROR: Direct access to this file is not allowed.' );
}

class WPSS_Security {

	/**
	 *  WP-SpamShield Security Class
	 */

	function __construct() {
		/**
		 *  Do nothing...for now
		 */
	}

	public function check_post_sec() {
		/**
		 *  Check if POST submission is security threat: hack attempt or vulnerability probe
		 */

		$site_url	= WPSS_SITE_URL;
		$site_dom	= WPSS_SITE_DOMAIN;
		$admin_url	= WPSS_ADMIN_URL.'/';
		$cont_url	= WPSS_CONTENT_DIR_URL.'/';
		$plug_url	= WPSS_PLUGINS_DIR_URL.'/';
		$post_count	= count( $_POST );
		$user_agent = rs_wpss_get_user_agent();
		$req_url	= rs_wpss_casetrans( 'lower', WPSS_THIS_URL );
		$req_ajax	= rs_wpss_is_ajax_request();
		$req_404	= rs_wpss_is_404( TRUE ); /* Not all WP sites return proper 404 status. The fact this security check even got activated means it was a 404. */
		$req_hal	= rs_wpss_get_http_accept( TRUE, TRUE, TRUE );
		$req_ha		= rs_wpss_get_http_accept( TRUE, TRUE );

		/* IP / PROXY INFO - BEGIN */
		global $wpss_ip_proxy_info;
		if( empty( $wpss_ip_proxy_info ) ) { $wpss_ip_proxy_info = rs_wpss_ip_proxy_info(); }
		extract( $wpss_ip_proxy_info );
		/* IP / PROXY INFO - END */

		/* Short Signatures - Regex */

		$rgx_sig_arr = array( '-e*5l?*B-@yZ_-,8_-lSZ98BC[', '+25-Z9dCZ,87C-7CBlSZ=-C[', 'q-e*5lq?*B-@yZ_-,8_-l', );

		foreach( $_POST as $k => $v ) {
			$v = rs_wpss_casetrans( 'lower', $v );
			foreach( $rgx_sig_arr as $i => $s ) { /* Switch to single preg_match as this expands, replace nested foreach() */
				$sd = rs_wpss_rbkmd( $s, 'de' );
				if( FALSE !== strpos( $v, $sd ) ) { $_SERVER['WPSS_SEC_THREAT'] = TRUE; return TRUE; }
			}
		}

		/* Full Signatures - Just the beginning of what's to come... - TO DO */

		$signatures = array(
			/* SIGNATURES - BEGIN */

			array(
				'description' 		=> 'Revslider & Showbiz Pro - AJAX Vulnerability', 
				'post_i_min'		=> 2, 
				'post_i_max'		=> 2, 
				'target_urls'		=> array( '/wp-admin/admin-ajax.php', ),
				'ajax_request'		=> FALSE, 
				'404'				=> '*', 
				'session_cookie'	=> FALSE, 
				'hal_signature'		=> array( '', ), 
				'ha_signature'		=> array( '', '*/*', ), 
				'key_val_pairs'		=> array( 
					array( 
						'action'		=> 'revslider_ajax_action', 
						'client_action'	=> 'update_plugin',
						), 
					array( 
						'action'		=> 'showbiz_ajax_action', 
						'client_action'	=> 'update_plugin', 
						), 
					),
				),

			array(
				'description' 		=> 'WP Marketplace <= 2.4.0 & WP Download Manager <=2.7.4 - Remote Code Execution', 
				'post_i_min'		=> 5, 
				'post_i_max'		=> 5, 
				'target_urls'		=> array(), 
				'ajax_request'		=> FALSE, 
				'404'				=> '*', 
				'session_cookie'	=> FALSE, 
				'hal_signature'		=> array( '', ), 
				'ha_signature'		=> array( '', '*/*', ), 
				'key_val_pairs'		=> array( 
					array( 
						'action'		=> 'wpmp_pp_ajax_call', 
						'user_login'	=> '*', 
						'execute'		=> 'wp_insert_user', 
						'role'			=> 'administrator', 
						'user_pass'		=> '*', 
						), 
					array( 
						'action'		=> 'wpdm_ajax_call', 
						'user_login'	=> '*', 
						'execute'		=> 'wp_insert_user', 
						'role'			=> 'administrator', 
						'user_pass'		=> '*', 
						), 
					),
				),

			array(
				'description' 		=> 'WP Symposium <= 14.11 - Shell Upload Vulnerability', 
				'post_i_min'		=> 2, 
				'post_i_max'		=> 3, 
				'target_urls'		=> array( '/wp-content/plugins/wp-symposium/server/php/index.php', ), 
				'ajax_request'		=> FALSE, 
				'404'				=> '*', 
				'session_cookie'	=> FALSE, 
				'hal_signature'		=> array( '', ), 
				'ha_signature'		=> array( '', '*/*', ), 
				'key_val_pairs'		=> array( 
					array( 
						'uploader_url'	=> $plug_url.'/wp-symposium/server/php/', 
						'uploader_uid'	=> '1', 
						), 
					),
				),

			array(
				'description' 		=> 'Ultimate Product Catalogue <= 3.11 - Multiple Vulnerabilities', 
				'post_i_min'		=> 3, 
				'post_i_max'		=> 3, 
				'target_urls'		=> array( '/wp-content/plugins/ultimate-product-catalogue/product-sheets/wp-links-ompt.php', '/wp-content/plugins/ultimate-product-catalogue/product-sheets/wp-includes.php', '/wp-content/plugins/ultimate-product-catalogue/product-sheets/wp-styles.php', ), 
				'ajax_request'		=> FALSE, 
				'404'				=> '*', 
				'session_cookie'	=> FALSE, 
				'hal_signature'		=> array( '', ), 
				'ha_signature'		=> array( '', '*/*', ), 
				'key_val_pairs'		=> array( 
					array( 
						'p2'			=> '2929', 
						'abc28'			=> 'print $_REQUEST[\'p1\'].$_REQUEST[\'p2\']', 
						'p1'			=> '4242', 
						), 
					array( 
						'p2'			=> '2929', 
						'af5f492a1'		=> 'print $_REQUEST[\'p1\'].$_REQUEST[\'p2\']', 
						'p1'			=> '4242', 
						), 
					array( 
						'p2'			=> '2929', 
						'e41e'			=> 'print $_REQUEST[\'p1\'].$_REQUEST[\'p2\']', 
						'p1'			=> '4242', 
						), 
					),
				),

			array(
				'description' 		=> 'Ultimate Product Catalogue <= 3.11 - Multiple Vulnerabilities', 
				'post_i_min'		=> 1, 
				'post_i_max'		=> 1, 
				'target_urls'		=> array( '/wp-content/plugins/ultimate-product-catalogue/product-sheets/wp-setup.php', '/wp-content/plugins/ultimate-product-catalogue/product-sheets/wp-includes.php', ), 
				'ajax_request'		=> FALSE, 
				'404'				=> '*', 
				'session_cookie'	=> FALSE, 
				'hal_signature'		=> array( '', ), 
				'ha_signature'		=> array( '', '*/*', ), 
				'key_val_pairs'		=> array( 
					array( 
						'e51e'			=> 'die(pi());', 
						), 
					array( 
						'af5f492a1'		=> 'die(pi());', 
						), 
					),
				),

			array(
				'description' 		=> 'Simple Ads Manager <= 2.5.94 - Arbitrary File Upload', 
				'post_i_min'		=> 2, 
				'post_i_max'		=> 2, 
				'target_urls'		=> array( '/wp-content/plugins/simple-ads-manager/sam-ajax-admin.php', ), 
				'ajax_request'		=> FALSE, 
				'404'				=> '*', 
				'session_cookie'	=> FALSE, 
				'hal_signature'		=> array( '', ), 
				'ha_signature'		=> array( '', '*/*', ), 
				'key_val_pairs'		=> array( 
					array( 
						'action'		=> 'upload_ad_image', 
						'path'			=> '*', 
						), 
					),
				),

			array(
				'description' 		=> 'Work The Flow File Upload <= 2.5.2 - Shell Upload', 
				'post_i_min'		=> 1, 
				'post_i_max'		=> 1, 
				'target_urls'		=> array( '/wp-content/plugins/work-the-flow-file-upload/public/assets/jquery-file-upload-9.5.0/server/php/index.php', '/assets/plugins/jquery-file-upload/server/php/index.php', ), 
				'ajax_request'		=> FALSE, 
				'404'				=> '*', 
				'session_cookie'	=> FALSE, 
				'hal_signature'		=> array( '', ), 
				'ha_signature'		=> array( '', '*/*', ), 
				'key_val_pairs'		=> array( 
					array( 
						'action'		=> 'upload', 
						), 
					),
				),


			/* SIGNATURES - END */
			);

		/* Run Checks Against Signatures */

		foreach ( $signatures as $i => $sig ) {
			if( !empty( $sig['post_i_min'] ) && ( $post_count < $sig['post_i_min'] || $post_count > $sig['post_i_max'] ) ) { continue; }
			if( !empty( $sig['target_urls'] ) ) { 
				$urls_rgx = rs_wpss_get_regex_phrase( $sig['target_urls'],'','red_str' );
				if( !preg_match( $urls_rgx, $req_url ) ) { continue; }
			}
			if( $sig['ajax_request'] !== '*' && $sig['ajax_request'] !== $req_ajax ) { continue; }
			if( $sig['404'] !== '*' && $sig['404'] !== $req_404 ) { continue; }
			$hal_max = count( $sig['hal_signature'] ) - 1; $m = 0; /* Matches */
			foreach( $sig['hal_signature'] as $i => $hal_sig ) {
				if( $hal_sig == $req_hal ) { $m++; }
				if( $i == $hal_max && $m === 0 ) { continue 2; }
			}
			$ha_max = count( $sig['ha_signature'] ) - 1; $m = 0; /* Matches */
			foreach( $sig['ha_signature'] as $i => $ha_sig ) {
				if( $ha_sig == $req_ha ) { $m++; }
				if( $i == $ha_max && $m === 0 ) { continue 2; }
			}
			foreach( $sig['key_val_pairs'] as $i => $kvp ) {
				$kvp_max = count( $kvp ); $m = 0; /* Matches */
				foreach( $kvp as $k => $v ) {
					if( ( !empty( $_POST[$k] ) && $_POST[$k] === $v ) || ( $v === '*' && isset( $_POST[$k] ) ) ) { $m++; }
					if( $m === $kvp_max ) { $_SERVER['WPSS_SEC_THREAT'] = TRUE; return TRUE; }
				}
			}
		}
		return FALSE;
	}

	static public function ip_ban( $method = 'set' ) {
		/**
		 *  Ban users by IP address or check if they have been banned
		 *  @since 1.9.4
		 *  $method: 'set','chk'
		 */
		if( FALSE === WPSS_IP_BAN_ENABLE || TRUE === WPSS_IP_BAN_CLEAR ) { self::clear_ip_ban(); return FALSE; }
		$wpss_ip_ban_disable = get_option('spamshield_ip_ban_disable');
		if( !empty( $wpss_ip_ban_disable ) ) { self::clear_ip_ban(); return FALSE; }
		$ip = rs_wpss_get_ip_addr();
		if( $ip === WPSS_SERVER_ADDR ) { return FALSE; } /* Skip website IP address */
		if( rs_wpss_is_local_request() ) { return FALSE; } /* Skip anything on same C-Block as website */
		/* if( self:no_ban_list() ) { return FALSE; } // SE Bots, SM Bots, etc */
		if( strpos( WPSS_SERVER_NAME_REV, WPSS_DEBUG_SERVER_NAME_REV ) !== 0 ) { if( rs_wpss_is_admin_ip( $ip ) ) { return FALSE; } }

		/* TO DO: Add logic for reverse proxies */

		$ip_ban_status = FALSE;
		$wpss_ip_ban = get_option('spamshield_ip_ban');
		if( empty( $wpss_ip_ban ) ) { $wpss_ip_ban = array(); }
		/* Check */
		if( !empty( $ip ) && in_array( $ip, $wpss_ip_ban, TRUE ) ) { $ip_ban_status = TRUE; }
		/* Set */
		if( !empty( $ip_ban_status ) || $method === 'set' ) {
			if( !empty( $ip ) && !in_array( $ip, $wpss_ip_ban, TRUE ) ) { $wpss_ip_ban[] = $ip; }
			$wpss_ip_ban = rs_wpss_sort_unique( $wpss_ip_ban );
			update_option( 'spamshield_ip_ban', $wpss_ip_ban );
			self::ip_ban_htaccess();
			$ip_ban_status = TRUE;
		}
		if( rs_wpss_is_session_active() ) {
			$_SERVER['WPSS_IP_BAN'] = $_SESSION['WPSS_IP_BAN_'.WPSS_HASH] = $ip_ban_status;
			if( !empty( $_SERVER['WPSS_IP_BAN'] ) || !empty( $_SESSION['WPSS_IP_BAN_'.WPSS_HASH] ) ) {
				$_SERVER['WPSS_SEC_THREAT'] = $_SESSION['WPSS_SEC_THREAT_'.WPSS_HASH] = TRUE;
			}
		}
		return $ip_ban_status;
	}

	static private function ip_ban_htaccess() {
		/**
		 *  Write the updated list of banned IP's to .htaccess.
		 *  @since 1.9.4
		 */
		$hta_bak_dir		= WPSS_CONTENT_DIR_PATH.'/backup';
		$hta_wpss_bak_dir	= $hta_bak_dir.'/wp-spamshield';
		$hta_file			= ABSPATH.'/.htaccess';
		$hta_bak_file		= $hta_wpss_bak_dir.'/original.htaccess';
		$wpss_index_file	= WPSS_PLUGIN_PATH.'/index.php';
		$bak_dir_hta_file	= WPSS_PLUGIN_PATH.'/lib/sec/.htaccess';
		$ip 				= rs_wpss_get_ip_addr();
		$user_agent 		= rs_wpss_get_user_agent();

		$wpss_ip_ban = get_option('spamshield_ip_ban');
		if( empty( $wpss_ip_ban ) ) { return FALSE; }
		$wpss_ip_ban = rs_wpss_sort_unique( $wpss_ip_ban );
		$banned_ip_count = count( $wpss_ip_ban );
		$ip_ban_rgx = '^('.str_replace( array( '.', ':', ), array( '\.', '\:', ), implode( '|', $wpss_ip_ban ) ).')$';

		$wpss_hta_data = WPSS_EOL.WPSS_EOL.'# BEGIN WP-SpamShield'.WPSS_EOL.WPSS_EOL;
		$wpss_hta_data .= '<IfModule mod_setenvif.c>'.WPSS_EOL."\t".'SetEnvIf Remote_Addr '.$ip_ban_rgx.' WPSS_SEC_THREAT'.WPSS_EOL.'</IfModule>';
		$wpss_hta_data .= WPSS_EOL.WPSS_EOL.'# END WP-SpamShield'.WPSS_EOL.WPSS_EOL;
		$wpss_hta_data_wp = '# BEGIN WordPress';

		if( file_exists( $hta_file ) ) {
			if( !file_exists( $hta_wpss_bak_dir ) ) {
				wp_mkdir_p( $hta_wpss_bak_dir );
				@chmod( $hta_wpss_bak_dir, 0750 );
				@chmod( $hta_bak_dir, 0750 );
				@copy ( $bak_dir_hta_file, $hta_wpss_bak_dir.'/.htaccess' );
				@copy ( $wpss_index_file, $hta_wpss_bak_dir.'/index.php' );
				@copy ( $bak_dir_hta_file, $hta_bak_dir.'/.htaccess' );
				@copy ( $wpss_index_file, $hta_bak_dir.'/index.php' );
			}
			if( !file_exists( $hta_bak_file ) ) {
				@copy ( $hta_file, $hta_bak_file );
			}
			$hta_contents = file_get_contents( $hta_file );
			if( strpos( $hta_contents, '# BEGIN WP-SpamShield' ) !== FALSE && strpos( $hta_contents, '# END WP-SpamShield' ) !== FALSE ) {
				$hta_contents_mod = preg_replace( "~#\ BEGIN\ WP-SpamShield[\w\W]+#\ END\ WP-SpamShield~i", trim( $wpss_hta_data, WPSS_EOL ), $hta_contents );
				if( $hta_contents_mod !== $hta_contents ) {
					file_put_contents( $hta_file, $hta_contents_mod, LOCK_EX );
				}
			} elseif( strpos( $hta_contents, '# BEGIN WordPress' ) !== FALSE ) {
				$hta_contents_mod = preg_replace( "~#\ BEGIN\ WordPress~i", $wpss_hta_data.$wpss_hta_data_wp, $hta_contents );
				file_put_contents( $hta_file, $hta_contents_mod, LOCK_EX );
			} else {
				file_put_contents( $hta_file, WPSS_EOL.WPSS_EOL.$wpss_hta_data.WPSS_EOL.WPSS_EOL, FILE_APPEND | LOCK_EX );
			}
			rs_wpss_append_log_data( WPSS_EOL.'IP address banned and added to .htaccess block list. IP: '.$ip, FALSE );
			rs_wpss_append_log_data( WPSS_EOL.'User-Agent: '.$user_agent, FALSE );
			rs_wpss_append_log_data( WPSS_EOL.'$_SERVER Data: '.print_r($_SERVER,1), FALSE );
		}
	}

	static public function clear_ip_ban() {
		/**
		 *  Clear IP ban from database and .htaccess.
		 *  @since 1.9.4
		 */
		update_option( 'spamshield_ip_ban', array() );
		unset( $_SESSION['WPSS_IP_BAN_'.WPSS_HASH], $_SERVER['WPSS_IP_BAN'], $_SESSION['WPSS_SEC_THREAT_'.WPSS_HASH], $_SERVER['WPSS_SEC_THREAT'] );
		self::clear_ip_ban_htaccess();
	}

	static private function clear_ip_ban_htaccess() {
		/**
		 *  Clear banned IP info from .htaccess.
		 *  @since 1.9.4
		 */
		$hta_bak_dir		= WPSS_CONTENT_DIR_PATH.'/backup';
		$hta_wpss_bak_dir	= $hta_bak_dir.'/wp-spamshield';
		$hta_file			= ABSPATH.'/.htaccess';
		$hta_bak_file		= $hta_wpss_bak_dir.'/original.htaccess';
		$wpss_index_file	= WPSS_PLUGIN_PATH.'/index.php';
		$bak_dir_hta_file	= WPSS_PLUGIN_PATH.'/lib/sec/.htaccess';

		$wpss_hta_data = '# BEGIN WP-SpamShield'.WPSS_EOL.WPSS_EOL.'# END WP-SpamShield';

		if( file_exists( $hta_file ) ) {
			if( !file_exists( $hta_wpss_bak_dir ) ) {
				wp_mkdir_p( $hta_wpss_bak_dir );
				@copy ( $bak_dir_hta_file, $hta_wpss_bak_dir.'/.htaccess' );
				@copy ( $wpss_index_file, $hta_wpss_bak_dir.'/index.php' );
				@copy ( $bak_dir_hta_file, $hta_bak_dir.'/.htaccess' );
				@copy ( $wpss_index_file, $hta_bak_dir.'/index.php' );
			}
			if( !file_exists( $hta_bak_file ) ) {
				@copy ( $hta_file, $hta_bak_file );
			}
			$hta_contents = file_get_contents( $hta_file );
			if( strpos( $hta_contents, '# BEGIN WP-SpamShield' ) !== FALSE && strpos( $hta_contents, '# END WP-SpamShield' ) !== FALSE ) {
				$hta_contents_mod = preg_replace( "~#\ BEGIN\ WP-SpamShield[\w\W]+#\ END\ WP-SpamShield~i", $wpss_hta_data, $hta_contents );
				if( $hta_contents_mod !== $hta_contents ) {
					file_put_contents( $hta_file, $hta_contents_mod, LOCK_EX );
					rs_wpss_append_log_data( WPSS_EOL.'Banned IP addresses removed from .htaccess.', TRUE );
				}
			}
		}
	}

	static public function check_admin_sec() {
		/**
		 *  Admin Security Checks
		 *  Check for specific plugin security issues and apply fix or workaround
		 *  @since 1.9.5.8
		 */

		if( rs_wpss_is_admin_sproc( TRUE ) || rs_wpss_is_doing_ajax() ) { return; }

		/* New User Approve Plugin ( https://wordpress.org/plugins/new-user-approve/ ) */
		self::admin_sec_fix_nua();

		/* Add next here... */

	}

	static private function admin_sec_fix_nua() {
		/**
		 *  Plugin:		New User Approve <= 1.7.2 (unfixed)
		 *  Issue:		Plugin "phones home" to retrieve data without informing site owner or requesting consent.
		 *  Reference:	WordPress Plugin Developer Guidelines, Rule 7 - https://wordpress.org/plugins/about/guidelines/
		 */
		if( class_exists( 'pw_new_user_approve_admin_approve' ) && method_exists( 'pw_new_user_approve_admin_approve', 'add_meta_boxes' ) && has_filter( 'admin_init', array( pw_new_user_approve_admin_approve::instance(), 'add_meta_boxes' ) ) ) {
			$mslug = 'users_page_new-user-approve-admin';
			$args = array( 'plugin_name' => 'New User Approve' );
			remove_action( 'admin_init', array( pw_new_user_approve_admin_approve::instance(), 'add_meta_boxes' ), 10 );
			add_meta_box( 'nua-approve-admin', __( 'Approve Users', 'new-user-approve' ), array( pw_new_user_approve_admin_approve::instance(), 'metabox_main' ), $mslug, 'main', 'high' );
			add_meta_box( 'nua-updates', __( 'Updates', 'new-user-approve' ), array( 'WPSS_Security', 'admin_sec_fix_notice_nua' ), $mslug, 'side', 'default', $args );
			add_meta_box( 'nua-support', __( 'Support', 'new-user-approve' ), array( 'WPSS_Security', 'admin_sec_fix_notice_nua' ), $mslug, 'side', 'default', $args );
			add_meta_box( 'nua-feedback', __( 'Feedback', 'new-user-approve' ), array( 'WPSS_Security', 'admin_sec_fix_notice_nua' ), $mslug, 'side', 'default', $args );
		}
	}

	static public function admin_sec_fix_notice_nua( $post, $metabox = array() ) {
		/* Plugin-specific wrapper for admin_sec_fix_notice() */
		echo self::admin_sec_fix_notice( $metabox['args']['plugin_name'], 'call_home' );
	}

	static private function admin_sec_fix_notice( $plugin_name, $type ) {
		/* TO DO: TRANSLATE*/
		$alerts = array(
			'call_home' => sprintf( __( 'Plugin "%s" is attempting to "phone home" to retrieve data without informing site owner or requesting consent.', 'wp-spamshield' ), $plugin_name ), 
			);
		$content = '<p><strong style="color:#A63104;"><img src="'.WPSS_PLUGIN_IMG_URL.'/warning-24.png" alt="" width="24" height="24" style="border-style:none;vertical-align:middle;padding-right:7px;" />' . __( 'SECURITY ALERT', 'wp-spamshield' ) . '</strong></p><p style="clear:both;"><strong style="color:#A63104;">' . $alerts[$type] . '</strong></p><p style="clear:both;"><strong style="color:#A63104;">' . __( 'Content blocked by WP-SpamShield.', 'wp-spamshield' ) . '</strong></p>'; /* TO DO: TRANSLATE */
		return $content;
	}

	public static function get_raw_post_data() {
		global $HTTP_RAW_POST_DATA;
		if ( !isset( $HTTP_RAW_POST_DATA ) ) { $HTTP_RAW_POST_DATA = file_get_contents( 'php://input' ); }
		$_SERVER['X_RAW_POST_DATA'] = $HTTP_RAW_POST_DATA;
		return $HTTP_RAW_POST_DATA;
	}

	static public function disable_xmlrpc_multicall( $methods ) {
		/**
		 *  SECURITY - Disable the XML-RPC 'system.multicall' method
		 *  Protect against XML-RPC brute force amplification attacks without breaking functionality
		 *  @since 1.9.7.8
		 */
		global $spamshield_options; if( empty( $spamshield_options ) ) { $spamshield_options = get_option('spamshield_options'); }
		if( !empty( $spamshield_options['disable_misc_form_shield'] ) ) { return $methods; }

		/* WPSS Whitelist Check - IP Only */
		if( !empty( $spamshield_options['enable_whitelist'] ) && rs_wpss_whitelist_check() ) { return $methods; }

		if( WPSS_Compatibility::misc_form_bypass() ) { return $methods; }

		/* BYPASS - HOOK */
		$mfsc_bypass = apply_filters( 'wpss_misc_form_spam_check_bypass', FALSE );
		if( !empty( $mfsc_bypass ) ) { return $methods; }

		if( !empty( $_SERVER['WPSS_SEC_THREAT'] ) ) {
			$methods = array();
		}

		$ip = rs_wpss_get_ip_addr();
		if( !rs_wpss_is_valid_ip( $ip ) || !preg_match( "~^192\.0\.(6[4-9]|[7-9][0-9]|1[01][0-9]|12[0-7])\.~", $ip ) ) {
			/* 192.0.64.0-192.0.127.255 (CIDR:192.0.64.0/18) */
			unset($methods['system.multicall']);
		}
		return $methods;
	}

	static public function early_post_intercept() {
		/**
		 *  SECURITY - Checks all incoming POST requests early for malicious behavior
		 *  Misc Form Spam Check - Layer 2
		 *  @since 1.9.7.8
		 *  hook@ 'init':-990
		 */
		global $HTTP_RAW_POST_DATA;
		$_SERVER['X_RAW_POST_DATA'] = self::get_raw_post_data();
		if( rs_wpss_is_admin_sproc() || rs_wpss_is_doing_cron() ) { return; }
		if( ( is_admin() && !rs_wpss_is_login_page() ) || rs_wpss_is_doing_ajax() ) { self::early_admin_intercept(); }
		if( rs_wpss_is_local_request() ) { return; }
		if( 'GET' === $_SERVER['REQUEST_METHOD'] || 'HEAD' === $_SERVER['REQUEST_METHOD'] ) { self::early_get_intercept(); return; }
		if( 'POST' !== $_SERVER['REQUEST_METHOD'] ) { return; }
		if( empty( $_POST ) && empty( $HTTP_RAW_POST_DATA ) ) { return; }
		if( empty( $_POST ) && !empty( $HTTP_RAW_POST_DATA ) ) { $_POST = array( 'HTTP_RAW_POST_DATA' => $HTTP_RAW_POST_DATA ); }

		global $spamshield_options; if( empty( $spamshield_options ) ) { $spamshield_options = get_option('spamshield_options'); }
		if( !empty( $spamshield_options['disable_misc_form_shield'] ) ) { return; }

		/* WPSS Whitelist Check - IP Only */
		if( !empty( $spamshield_options['enable_whitelist'] ) && rs_wpss_whitelist_check() ) { return; }

		$url		= WPSS_THIS_URL;
		$url_lc		= rs_wpss_casetrans('lower',$url);
		$req_uri	= $_SERVER['REQUEST_URI'];
		$req_uri_lc	= rs_wpss_casetrans('lower',$req_uri);
		$query_str	= rs_wpss_get_query_string($url);

		/* BYPASS - GENERAL */
		if( isset( $_POST[WPSS_REF2XJS] ) || isset( $_POST[WPSS_JSONST] ) || isset( $_POST['wpss_contact_message'] ) || isset( $_POST['signup_username'] ) || isset( $_POST['signup_email'] ) || isset( $_POST['ws_plugin__s2member_registration'] ) || isset( $_POST['_wpcf7_version'] ) || isset( $_POST['gform_submit'] ) || isset( $_POST['gform_unique_id'] ) ) { return; }
		if( is_admin() && !rs_wpss_is_login_page() ) { return; }
		if( rs_wpss_is_login_page() ) { return; }
		if( defined( 'WP_INSTALLING' ) ) { return; }
		$post_count = count( $_POST );
		$ecom_urls = unserialize( WPSS_ECOM_URLS );
		foreach( $ecom_urls as $k => $u ) { if( strpos( $req_uri, $u ) !== FALSE ) { return; } }
		$admin_url = WPSS_ADMIN_URL.'/';
		if( $post_count >= 5 && isset( $_POST['log'], $_POST['pwd'], $_POST['wp-submit'], $_POST['testcookie'], $_POST['redirect_to'] ) && $_POST['redirect_to'] === $admin_url ) { return; }
		if( $post_count >= 5 && isset( $_POST['log'], $_POST['pwd'], $_POST['login'], $_POST['testcookie'], $_POST['redirect_to'] ) ) { return; }
		if( $post_count >= 5 && isset( $_POST['username'], $_POST['password'], $_POST['login'], $_POST['_wpnonce'], $_POST['_wp_http_referer'] ) && rs_wpss_is_wc_login_page() ) { return; }

		if( WPSS_Compatibility::misc_form_bypass() ) { return; }

		/* BYPASS - HOOK */
		$mfsc_bypass = apply_filters( 'wpss_misc_form_spam_check_bypass', FALSE );
		if( !empty( $mfsc_bypass ) ) { return; }

		do_action( 'wpss_early_post_intercept' );

		$epc_filter_status		= $wpss_error_code = $log_pref = '';
		$epc_jsck_error			= $epc_badrobot_error = FALSE;
		$form_type				= 'misc form';
		$pref					= 'EPC-';
		$errors_3p				= array();
		$error_txt 				= rs_wpss_error_txt();
		$server_name			= WPSS_SERVER_NAME;
		$server_email_domain	= rs_wpss_get_email_domain( $server_name );
		$epc_serial_post 		= @rs_wpss_json_encode( $_POST );
		$form_auth_dat 			= array( 'comment_author' => '', 'comment_author_email' => '', 'comment_author_url' => '' );

		$blocked	= FALSE;
		$c 			= array(
			'name'		=> '', 
			'value'		=> '1', 
			'expire'	=> time() + 60*60*24*365*1, /* 1 year */ 
			'path'		=> '/', 
			'domain'	=> rs_wpss_get_cookie_domain(), 
			'secure'	=> FALSE, 
			'httponly'	=> FALSE, 
		);

		if( rs_wpss_is_xmlrpc() ) {
			rs_wpss_start_session();
			$c['name'] = 'P_XMLRPC';
			if( !empty( $HTTP_RAW_POST_DATA ) && is_string( $HTTP_RAW_POST_DATA ) && FALSE !== strpos( stripslashes( $HTTP_RAW_POST_DATA ), '<methodName>pingback.ping</methodName>' ) ) {
				if( !defined( 'WPSS_XMLRPC_PINGBACK' ) ) { define( 'WPSS_XMLRPC_PINGBACK', TRUE ); }
				return;
			}
		}

		if( rs_wpss_is_doing_rest() ) {
			rs_wpss_start_session();
			$c['name'] = 'P_REST';
		}

		if( rs_wpss_is_doing_ajax() ) {
			if( ( empty( $_POST ) && empty( $query_str ) ) || !empty( $_SERVER['WPSS_SEC_THREAT'] ) ) {
				$wpss_error_code .= ' '.$pref.'FAR1020';
				$err_cod = 'fake_ajax_request_error';
				$err_msg = __( 'That action is currently not allowed.' );
				$errors_3p[$err_cod] = $err_msg;
			}
		}

		if( rs_wpss_is_xmlrpc() || rs_wpss_is_doing_rest() ) {
			/* BAD ROBOT BLACKLIST */
			$bad_robot_filter_data = rs_wpss_bad_robot_blacklist_chk( $form_type, $epc_filter_status );
			$epc_filter_status = $bad_robot_filter_data['status'];
			$bad_robot_blacklisted = $bad_robot_filter_data['blacklisted'];
			if( !empty( $bad_robot_blacklisted ) ) {
				$wpss_error_code .= $bad_robot_filter_data['error_code'];
				$err_cod = 'badrobot_error';
				$err_msg = __( 'That action is currently not allowed.' );
				$errors_3p[$err_cod] = $err_msg;
				$_SERVER['WPSS_SEC_THREAT'] = TRUE;
			}
		} else {
			if( rs_wpss_skiddie_ua_check() ) {
				$wpss_error_code .= ' '.$pref.'UA1004';
				$err_cod = 'badrobot_skiddie_error';
				$err_msg = __( 'That action is currently not allowed.' );
				$errors_3p[$err_cod] = $err_msg;
				$_SERVER['WPSS_SEC_THREAT'] = TRUE;
			}
		}

		if( rs_wpss_ubl_cache() ) {
			if( TRUE === WPSS_IP_BAN_ENABLE && rs_wpss_is_xmlrpc() ) { self::ip_ban(); }
			$wpss_error_code .= ' '.$pref.'0-BL';
			$err_cod = 'blacklisted_user_error';
			$err_msg = __( 'That action is currently not allowed.' );
			$errors_3p[$err_cod] = $err_msg;
		}

		if( !empty( $c['name'] ) ) { /* Setting cookie to honeypot bad actors */
			@setcookie( $c['name'], $c['value'], $c['expire'], $c['path'], $c['domain'], $c['secure'], $c['httponly'] );
		}

		/* Done with Tests */
		$wpss_error_code = trim( $wpss_error_code );

		if( !empty( $wpss_error_code ) ) {
			$wpss_error_code = str_replace( 'MSC-', 'EPC-', $wpss_error_code );
			if( rs_wpss_is_xmlrpc() ) {
				/* Disable Authenticated XMLRPC Functions */
				add_filter( 'xmlrpc_enabled', '__return_false' );
			}
			if( rs_wpss_is_doing_rest() ) {
				/* Disable REST WP-API version 1.x */
				add_filter('json_enabled', '__return_false');
				add_filter('json_jsonp_enabled', '__return_false');
				/* Disable REST WP-API version 2.x */
				add_filter('rest_enabled', '__return_false');
				add_filter('rest_jsonp_enabled', '__return_false');
			}
			rs_wpss_update_accept_status( $form_auth_dat, 'r', 'Line: '.__LINE__, $wpss_error_code );
			if( !empty( $spamshield_options['comment_logging'] ) ) {
				rs_wpss_log_data( $form_auth_dat, $wpss_error_code, $form_type, $epc_serial_post );
			}
		} else {
			rs_wpss_update_accept_status( $form_auth_dat, 'a', 'Line: '.__LINE__ );
		}

		do_action( 'wpss_early_post_intercept_end' );

		/* Now output error message */
		if( !empty( $wpss_error_code ) ) {
			$error_msg = '';
			foreach( $errors_3p as $c => $m ) {
				$error_msg .= '<strong>'.$error_txt.':</strong> '.$m.'<br /><br />'.WPSS_EOL;
			}
			WP_SpamShield::wp_die( $error_msg, TRUE );
		}

	}

	static public function early_get_intercept() {
		/**
		 *  SECURITY - Checks all incoming GET requests early for malicious behavior
		 *  Only if WPSS_IP_BAN_ENABLE === TRUE (Only enabled by default on Beta tester sites - has to be manually enabled for all others)
		 *  @since 1.9.8.1
		 *  fires@ 'init':-990
		 */
		if( rs_wpss_is_admin_sproc() || rs_wpss_is_doing_cron() ) { return FALSE; }
		if( TRUE !== WPSS_IP_BAN_ENABLE ) { return FALSE; }
		$wpss_404_limit = 8; /* Large number of 404s is a sign of probing */
		if( !empty( $_SESSION['wpss_404_hits_'.WPSS_HASH] ) && $_SESSION['wpss_404_hits_'.WPSS_HASH] >= $wpss_404_limit ) { self::ip_ban(); return TRUE; }
		return FALSE;
	}

	static public function early_admin_intercept() {
		/**
		 *  SECURITY - Checks all incoming admin POST requests early for malicious behavior
		 *  @since 1.9.8.1
		 *  fires@ 'init':-990
		 */
		if( rs_wpss_is_admin_sproc() || rs_wpss_is_doing_cron() ) { return FALSE; }
		global $HTTP_RAW_POST_DATA;
		if( empty( $_POST ) && empty( $HTTP_RAW_POST_DATA ) ) { return; }
		if( empty( $_POST ) && !empty( $HTTP_RAW_POST_DATA ) ) { $_POST = array( 'HTTP_RAW_POST_DATA' => $HTTP_RAW_POST_DATA ); }
		if( !empty( $_POST ) && is_array( $_POST ) ) {
			foreach( $_POST as $k => $v ) {
				if( 0 === strpos( $k, 'PO_' ) && is_array( $v ) ) {
					foreach( $v as $ak => $av ) {
						if( 0 === strpos( $av, WPSS_PLUGIN_NAME ) ) { unset( $v[$ak] ); }
					}
					$_POST[$k] = array_values($v);
				}
			}
		}
		return FALSE;
	}

	static public function check_request_method() {
		/**
		 *  SECURITY - Checks all incoming requests for malicious/vulnerable request methods
		 *  @since 1.9.8.2
		 *  hook@ 'init':-999
		 */

		if( rs_wpss_is_admin_sproc() || rs_wpss_is_doing_cron() ) { return FALSE; }

		/* BYPASS - HOOK */
		$rmc_bypass = apply_filters( 'wpss_request_method_check_bypass', FALSE );
		if( !empty( $rmc_bypass ) ) { return FALSE; }

		$wpss_error_code = ''; $pref = 'RMC-'; $errors_3p = array(); $error_txt = rs_wpss_error_txt();

		$ip = rs_wpss_get_ip_addr();
		if( $ip === WPSS_SERVER_ADDR ) { return FALSE; }
		if( rs_wpss_is_local_request() ) { return FALSE; }
		$_SERVER['REQUEST_METHOD'] = trim( $_SERVER['REQUEST_METHOD'] );

		if( !empty( $_SERVER['REQUEST_METHOD'] ) && !preg_match( "~^(GET|HEAD|OPTIONS|POST|PUT|PATCH|DELETE)$~iu", $_SERVER['REQUEST_METHOD'] ) ) {
			if( TRUE === WPSS_IP_BAN_ENABLE ) { self::ip_ban(); }
			$wpss_error_code .= ' '.$pref.'E405-MNA';
			$err_cod = 'method_not_allowed_error';
			$err_msg = __( 'Method Not Allowed' );
			$errors_3p[$err_cod] = $err_msg;
		}

		/* Done with Tests */
		$wpss_error_code = trim( $wpss_error_code );

		/* Now output error message */
		if( !empty( $wpss_error_code ) ) {
			$error_msg = '';
			foreach( $errors_3p as $c => $m ) {
				$error_msg .= '<strong>'.$error_txt.':</strong> '.$m.'<br /><br />'.WPSS_EOL;
			}
			$_SERVER['WPSS_SEC_THREAT'] = TRUE;
			WP_SpamShield::wp_die( $error_msg, TRUE, '405' );
		}
	}

	static public function auto_update( $update, $item ) {
		/**
		 *  Automatically keep plugin up to date: ensure latest anti-spam and security updates
		 *  @since 1.9.7.8
		 */
		if( rs_wpss_is_admin_sproc() ) { return $update; }
		/* Array of plugin slugs to always auto-update */
		$plugins = array ( 'wp-spamshield', );
		if ( in_array( $item->slug, $plugins ) ) {
			return true; /* Always update plugins in this array */
		} else {
			return $update; /* Else, use the normal API response to decide whether to update or not */
		}
	}


}
