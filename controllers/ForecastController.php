<?php
namespace controllers;

use config\Templater;

class ForecastController
{

    protected $smarty;

    public function __construct()
    {

        $this->smarty = Templater::getInstance()->smarty();

    }

    /**
     * @param $args
     */
    public function index($args)
    {
        if (empty($args)) {
            return false;
        }

        setcookie("name", $args['name'], time() + 50000, '/');

        $forecast = new \models\ForecastModel(\models\DbClass::getInstance());
        $api = new \models\ApiModel();
        $city = $api->getCity($args['name']);
        $curWeather = $api->getCurrentWeather($args['name']);
        $this->smarty->assign('current_weather', $curWeather);
        $weather = $forecast->forecast($args['name']);
        $archive = $forecast->archive($args['name']);
        $this->smarty->assign('weather', $weather);
        $this->smarty->assign('archive', $archive);
        $this->smarty->assign('city', $city['title']);
        $this->smarty->display('forecast.tpl');

    }


}