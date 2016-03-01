<?php
namespace LNR;


class Helper
{
    public static function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    
    public static function parsedXML($xmlstr) {
        libxml_use_internal_errors(true);

        $doc = simplexml_load_string($xmlstr);
        $xml = explode("\n", $xmlstr);
        
        if (!$doc) {
            $errors = libxml_get_errors();
        
            foreach ($errors as $error) {
                error_log(print_r($error, true));
            }
        
            libxml_clear_errors();
        }
        return $doc;
    }
}