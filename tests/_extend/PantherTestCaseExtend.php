<?php
    namespace App\Tests\_extend;

    use Facebook\WebDriver\WebDriverDimension;
    use Symfony\Component\Panther\Client;

    trait PantherTestCaseExtend {

        public function getPantherClient(){
            $client = self::createPantherClient([
                'external_base_uri' => 'http://nginx'
            ]);
            $client->manage()->window()->setSize(new WebDriverDimension(1920, 1080));
            return $client;
        }

        public function takeScreenshot(Client $client, $request = "/", $name = "root.png"){
            $this->takeScreenshotSize($client, $request, $name, "pc", 2560, 1440);
            $this->takeScreenshotSize($client, $request, $name, "pc", 1920, 1080);
            $this->takeScreenshotSize($client, $request, $name, "pc", 1440, 900);
            $this->takeScreenshotSize($client, $request, $name, "mobile", 414, 736);
            $this->takeScreenshotSize($client, $request, $name, "mobile", 375, 812);
        }

        private function takeScreenshotSize(Client $client, $request = "/", $name = "root.png", $type = "pc", $width = 1920, $height = 1080){
            $client->manage()->window()->setSize(new WebDriverDimension($width, $height));
            $client->request($request);

            $this->assertStringContainsString($request, $client->getCurrentURL());

            $client->takeScreenshot("screenshot/".$type."-".$width."x".$height."/".$name);
        }

    }