<?php

require_once('C:\xampp\htdocs\otomasyon\bina\binayonetimi\application\libraries\iyzipay-php-master\IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey("sandbox-pJpoiAx8OBFbtcsfE00Ic9a1Cgm7piUz");
        $options->setSecretKey("sandbox-03OI9qYksQOIyoEwwG62x2sGgIR9BIeE");
        $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        return $options;
    }
}