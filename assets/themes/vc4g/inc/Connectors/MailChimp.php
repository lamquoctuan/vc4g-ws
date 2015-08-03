<?php
namespace LNR\Connectors;
require_once(CUR_THEME_DIR . '/inc/Helper.php');

use LNR\Helper;

class MailChimp
{
    protected $host;
    protected $apiKey;
    protected $listId;
    
    public function __construct() {
        $this->host = 'https://us11.api.mailchimp.com/3.0';
        $this->apikey = '682ace4cced312f880d762423702abc7-us11';
    }
    
    public function listSubscribe($listId, $source, $email, $firstName = '', $lastName = '', $phone = '', $subject = '', $message = '') {
        $apikey = $this->apikey;
        $auth = base64_encode( 'user:'.$apikey );

        $data = array(
            'apikey'        => $apikey,
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => array(
                'SOURCE' => $source,
                'FNAME' => $firstName,
                'LNAME' => $lastName,
                'PHONE' => $phone,
                'SUBJECT' => $subject,
                'MESSAGE' => $message,
            )
        );
        $json_data = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host.'/lists/'.$listId.'/members/');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                    'Authorization: Basic '.$auth));
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);                                                                                                                  

        $result = curl_exec($ch);

        return json_decode($result);
    }
}
?>