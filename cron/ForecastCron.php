<?php
require_once 'models/ApiModel.php';
require_once 'config/Config.php';

class ForecastCron
{

    public function add_forecast()
    {
        $api = new \models\ApiModel();
        $towns = $api->getCities();
        $config = \config\Config::getInstance();
        $db = new \Mongo("mongodb://" . $config['db_host'] . ":" . $config['db_port'] . "/" . $config['db_database']);
        $collection = $db->selectCollection('ngs', 'forecasts');

        foreach ($towns as $town) {
            $decoded = $api->getForecast($town['name']);
            foreach ($decoded['forecasts'] as $forecasts) {
                foreach ($forecasts['hours'] as $hours) {
                    if ($hours['hour'] == '12') {
                        $mas = array(
                            'temperature' => $hours['temperature']['avg'],
                            'pressure' => $hours['pressure']['avg'],
                            'humidity' => $hours['humidity']['avg'],
                            'wind' => array('speed' => $hours['wind']['speed']['avg'], 'direction' => $hours['wind']['direction']['title']),
                            'cloud' => $hours['cloud']['title'],
                            'precipitation' => $hours['precipitation']['title']
                        );
                    }

                }
                $document = array(
                    'date' => new \MongoDate(strtotime($forecasts['date'])),
                    'city' => $town['name'],
                    'forecast' => $mas
                );
                $collection->update(array('city' => $document['city'], 'date' => $document['date']), array('$set' => $document), array('upsert' => true));
            }
        }
    }

}
