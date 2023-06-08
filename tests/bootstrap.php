<?php

$_SERVER = $_SERVER ?: [];

$_SERVER['ROOT_PATH'] = dirname(dirname(__FILE__));
$_SERVER["CAREERSITE_DOMAIN"] = "phpunit.test";
putenv("CAREERSITE_DOMAIN=phpunit.test");