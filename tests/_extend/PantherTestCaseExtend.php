<?php
    namespace App\Tests\_extend;

    use Facebook\WebDriver\WebDriverDimension;

    trait PantherTestCaseExtend {

        public function getPantherClient(){
            $client = self::createPantherClient([
                'external_base_uri' => 'http://nginx'
            ]);
            $client->manage()->window()->setSize(new WebDriverDimension(1920, 1080));
            return $client;
        }

    }