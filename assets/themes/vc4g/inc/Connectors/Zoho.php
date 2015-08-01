<?php
namespace LNR\Connectors;
require_once(CUR_THEME_DIR . '/inc/Helper.php');
use LNR\Helper;

class Zoho
{
    protected $host = "https://crm.zoho.com/crm/private/xml";
    protected $authToken = '3fc1a6ae68114a4a814a84f1598461d6';
    
    public function insertRecords ($xmlData) {
        $token  = $this->authToken;
        $url    = $this->host . "/Leads/insertRecords";
        $param  = "newFormat=1&authtoken=".$token."&scope=crmapi&xmlData=".$xmlData."&duplicateCheck=1";
        return $this->curlWrap($url, $param);
    }
    
    public function getRecords() {
        $token  = $this->authToken;
        $url    = $this->host . "/Leads/getRecords";
        $param  = "authtoken=".$token."&scope=crmapi";
        return $this->curlWrap($url, $param)->result;
    }
  
    protected function curlWrap($url, $param, $action='GET') {
        //   header("Content-type: application/xml");
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_TIMEOUT, 30);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
          $result = curl_exec($ch);
          curl_close($ch);
          return Helper::parsedXML($result);
    }
    
}