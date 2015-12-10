<?php

namespace controllers;

use config\Templater;

class WeatherController
{

    protected $smarty;

    public function __construct()
    {

        $this->smarty = Templater::getInstance()->smarty();

    }

    public function index()
    {
        $city = new \models\CityModel(\models\DbClass::getInstance());
        $towns = $city->getMy();
        if (isset($_COOKIE['name'])) {
            $town = $_COOKIE['name'];
        } else {
            $town = $towns[0]['name'];
        }
        $api = new \models\ApiModel();
        $cityName = $api->getCity($town);
        $curWeather = $this->currentWeather($town);
        $this->smarty->assign('current_weather', $curWeather);
        $this->smarty->assign('city', $cityName['title']);
        $this->myCities();
        $this->smarty->display('main.tpl');

    }

    /**
     * @param $city
     * @return bool
     */
    public function currentWeather($city)
    {
        if (empty($city)) {
            return false;
        }
        $forecast = new \models\ApiModel();
        $curWeather = $forecast->getCurrentWeather($city);
        return ($curWeather);

    }

    public function myCities()
    {
        $city = new \models\CityModel(\models\DbClass::getInstance());
        $towns = $city->getMy();
        $this->smarty->assign('towns', $towns);

    }

    public function listCities()
    {
        $api = new \models\ApiModel();
        $towns = $api->getCities();
        $this->smarty->assign('cities', $towns);
        $this->smarty->display('cities.tpl');

    }

    /**
     * @param $args
     */
    public function listChangeCities($args)
    {
        if (empty($args)) {
            return false;
        }
        $api = new \models\ApiModel();
        $towns = $api->getCities();
        $current = $args['current'];
        $this->smarty->assign('cities', $towns);
        $this->smarty->assign('current', $current);
        $this->smarty->display('CityToChange.tpl');

    }

    /**
     * @param $args
     */
    public function addToMy($args)
    {
        if (empty($args)) {
            return false;
        }
        $api = new \models\ApiModel();
        $city = new \models\CityModel(\models\DbClass::getInstance());
        $city->addCity($api->getCity($args['name']));
        $this->index();

    }

    /**
     * @param $args
     */
    public function change($args)
    {
        if (empty($args)) {
            return false;
        }
        $api = new \models\ApiModel();
        $city = new \models\CityModel(\models\DbClass::getInstance());
        $city->addCity($api->getCity($args['name']));
        $city->delCity($args['current']);
        $this->index();

    }

    /**
     * @param $args
     */
    public function dellCity($args)
    {
        if (empty($args)) {
            return false;
        }
        $city = new \models\CityModel(\models\DbClass::getInstance());
        $city->delCity($args['name']);
        $this->index();

    }
}