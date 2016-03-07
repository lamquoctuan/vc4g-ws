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
    
    public function getListMember($listId, $email) {
        $apikey = $this->apikey;
        $auth = base64_encode( 'user:'.$apikey );
        $subscriberHash = md5(strtolower($email));
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host.'/lists/'.$listId.'/members/'.$subscriberHash);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                    'Authorization: Basic '.$auth));
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //    curl_setopt($ch, CURLOPT_POST, true);
    //    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);                                                                                                                  

        $result = curl_exec($ch);

        return json_decode($result);
    }
    
    public function listSubscribe($listId, $source, $email, $firstName = '', $lastName = '', $phone = '', $subject = '', $message = '', $address = array(), $type = '') {
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
        if (is_array($address) && !empty($address)) {
            $data['merge_fields']['ADDRESS'] = isset($address['address']) ? $address['address'] : '';
            $data['merge_fields']['CITY'] = isset($address['city']) ? $address['city'] : '';
            $data['merge_fields']['STATE'] = isset($address['state']) ? $address['state'] : '';
            $data['merge_fields']['ZIP'] = isset($address['zip']) ? $address['zip'] : '';
        }
        $data['merge_fields']['TYPE'] = $type;
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