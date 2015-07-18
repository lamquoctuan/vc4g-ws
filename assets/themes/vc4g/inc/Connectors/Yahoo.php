<?php
namespace LNR\Connectors;


class Yahoo
{
    protected $condition;

    public function __construct()
    {
        $this->setCondition();
    }

    public function getCondition() {
        return $this->condition;
    }
    public function setCondition()
    {
        $BASE_URL = "http://query.yahooapis.com/v1/public/yql";

        $yql_query = 'select item from weather.forecast where woeid in (9807)';
        $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";

        // Make call with cURL
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($session);
        // Convert JSON to PHP object
        $phpObj = json_decode($json);
        if (is_object($phpObj)) {
            $query = $phpObj->query;
            if (is_object($query) && $results = $query->results) {
                if (is_object($results) && $channel = $results->channel) {
                    if (is_object($channel) && $item = $channel->item) {
                        if (is_object($item) && $condition = $item->condition) {
                            if (is_object($condition)) {
                                $this->condition = $condition;
                            }
                        }
                    }
                }
            }
        }
    }
}