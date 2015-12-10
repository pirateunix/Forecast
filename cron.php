<?php

require_once 'cron/ForecastCron.php';
$cron = new ForecastCron();
$cron->add_forecast();