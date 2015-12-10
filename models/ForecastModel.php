<?php

namespace models;

class ForecastModel extends DbModel
{
    /**
     * @param $city
     * @return mixed
     */
    public function forecast($city)
    {
        if (empty($city)) {
            return false;
        }
        $firstDay = new \MongoDate(strtotime("1 day", mktime(0, 0, 0)));
        $lastDay = new \MongoDate(strtotime("3 day", mktime(23, 59, 59)));
        $collection = $this->mdb->selectCollection('ngs', 'forecasts');
        $query = array('city' => $city, 'date' => array('$gte' => $firstDay, '$lte' => $lastDay));
        $results = $collection->find($query);
        $results->sort(array('date' => 1));
        return $results;
    }

    /**
     * @param $city
     * @return mixed
     */
    public function archive($city)
    {
        if (empty($city)) {
            return false;
        }
        $firstDay = new \MongoDate(strtotime("-3 day", mktime(0, 0, 0)));
        $lastDay = new \MongoDate(strtotime("-1 day", mktime(23, 59, 59)));
        $collection = $this->mdb->selectCollection('ngs', 'forecasts');
        $query = array('city' => $city, 'date' => array('$gte' => $firstDay, '$lte' => $lastDay));
        $results = $collection->find($query);
        $results->sort(array('date' => 1));
        return $results;
    }


}