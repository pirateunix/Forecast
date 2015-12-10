<?php


namespace models;

class CityModel extends DbModel
{
    /**
     * @return array
     */
    public function getMy()
    {

        $collection = $this->mdb->selectCollection('ngs', 'MyCities');
        $results = $collection->find();
        foreach ($results as $doc) {
            $mas[] = $doc;
        }
        return $mas;
    }

    /**
     * @param $city
     * @return bool
     */
    public function addCity($city)
    {
        if (empty($city)) {
            return false;
        }
        $collection = $this->mdb->selectCollection('ngs', 'MyCities');
        $results = $collection->save($city);
        return $results;

    }

    /**
     * @param $city
     * @return bool
     */
    public function delCity($city)
    {
        if (empty($city)) {
            return false;
        }
        $collection = $this->mdb->selectCollection('ngs', 'MyCities');
        $results = $collection->remove(array('name' => $city));
        return $results;

    }
}