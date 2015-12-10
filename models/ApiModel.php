<?php


namespace models;

class ApiModel
{
    /**
     * @param $serviceUrl
     * @return mixed
     */
    private function getInfo($serviceUrl)
    {
        if (empty($serviceUrl)) {
            return false;
        }
        $curl = curl_init($serviceUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curlResponse = curl_exec($curl);
        if ($curlResponse === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            throw new \RuntimeException('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $decoded = json_decode($curlResponse, true);
        if (isset($decoded['response']['status']) && $decoded['response']['status'] == 'ERROR') {
            throw new \RuntimeException('error occured: ' . $decoded['response']['errormessage']);
        }
        return $decoded;
    }

    /**
     * @param $name
     * @return array
     */
    public function getCity($name)
    {
        if (empty($name)) {
            return false;
        }
        $serviceUrl = 'http://pogoda.ngs.ru/api/v1/cities/' . $name;
        $decoded = $this->getInfo($serviceUrl);
        foreach ($decoded['cities'] as $cities) {
            $mas = array('title' => $cities['title'],
                'name' => $cities['name'],
                'timezone' => $cities['timezone']
            );


        }
        return $mas;
    }

    /**
     * @return array
     */
    public function getCities()
    {
        $serviceUrl = 'http://pogoda.ngs.ru/api/v1/cities/';
        $decoded = $this->getInfo($serviceUrl);
        foreach ($decoded['cities'] as $cities) {
            $mas[] = array('title' => $cities['title'],
                'name' => $cities['name'],
                'timezone' => $cities['timezone']
            );


        }
        return $mas;
    }

    /**
     * @param $city
     * @return array
     */

    public function getCurrentWeather($city)
    {
        if (empty($city)) {
            return false;
        }
        $serviceUrl = 'http://pogoda.ngs.ru/api/v1/forecasts/current/?city=' . $city;
        $decoded = $this->getInfo($serviceUrl);
        $mas = array(
            'temperature' => $decoded['forecasts']['0']['temperature'],
            'pressure' => $decoded['forecasts']['0']['pressure'],
            'humidity' => $decoded['forecasts']['0']['humidity'],
            'wind' => array('speed' => $decoded['forecasts']['0']['wind']['speed'], 'direction' => $decoded['forecasts']['0']['wind']['direction']['title']),
            'cloud' => $decoded['forecasts']['0']['cloud']['title'],
            'precipitation' => $decoded['forecasts']['0']['precipitation']['title']
        );
        return $mas;
    }

    /**
     * @param $city
     * @return bool|mixed
     */
    public function getForecast($city)
    {
        if (empty($city)) {
            return false;
        }
        $serviceUrl = 'http://pogoda.ngs.ru/api/v1/forecasts/forecast/?city=' . $city;
        $decoded = $this->getInfo($serviceUrl);
        return $decoded;
    }


}