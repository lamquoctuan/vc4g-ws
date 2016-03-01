<?php
namespace LNR;
//require_once('Helper.php');

class Connector {
    protected $endPoint;
    protected $paramsJson;
    protected $action;
    protected $headers;
    protected $options;

    public function setEndPoint($endPoint) {
        if (! empty($endPoint)) {
            $this->endPoint = $endPoint;
        }
    }
    public function setParams($params) {
        if (! empty($params)) {
            if (Helper::isJson($params)) {
                $this->paramsJson = $params;
            } else {
                $paramsJson = json_encode($params);
                if ($paramsJson != false) {
                    $this->paramsJson = $paramsJson;
                }
            }
        }
    }
    public function setAction($action) {
        if (in_array(strtoupper($action),array('GET','POST','PUT'))) {
            $this->action = strtoupper($action);
        }
    }

    public function setHeaders($headers) {
        if (empty($headers)) {
            $this->headers = array('Content-type: application/json');
        } elseif (is_array($headers)) {
            $this->headers = $headers;
        } else {
            $this->headers = array($headers);
        }
    }
    public function setOption($optionKey, $optionValue) {
        $this->options[$optionKey] = $optionValue;
    }
    public function setOptions($options) {
        $optionsDefault = array(
            'CURLOPT_FOLLOWLOCATION' => true,
            'CURLOPT_MAXREDIRS' => 10,
            'CURLOPT_USERAGENT' => "MozillaXYZ/1.0",
            'CURLOPT_RETURNTRANSFER' => true,
            'CURLOPT_TIMEOUT' => 10,
            'CURLOPT_SSL_VERIFYHOST' => false,
            'CURLOPT_SSL_VERIFYPEER' => true
        );
        $this->options = $optionsDefault;
        if (! empty($options) && is_array($options)) {
            foreach( $options as $optionKey=>$optionValue) {
                $this->setOption($optionKey, $optionValue);
            }
        }
    }
    public function __construct($endPoint = '', $params = '', $action = 'GET', $headers = array(), $options = array()) {
        $this->setEndPoint($endPoint);
        $this->setParams($params);
        $this->setAction($action);
        $this->setHeaders($headers);
    }

    public function execute() {

    }
}