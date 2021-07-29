<?php
    namespace App\Tests\UI\FrontOffice\Panther;

    use Facebook\WebDriver\WebDriverDimension;
    use Symfony\Component\Panther\PantherTestCase;

    class DashboardTest extends PantherTestCase {

        public function test_EN_Index(){
            $client = self::createPantherClient([
                'external_base_uri' => 'http://192.168.0.249:10101'
            ]);
            $client->manage()->window()->setSize(new WebDriverDimension(1920, 1080));
            $client->request("GET", "/en/dashboard.html");
            
            $client->takeScreenshot('screenshot/1920x1080/test.png');

            $this->assertStringContainsString("/en/dashboard.html", $client->getCurrentURL());
            $this->assertSelectorTextContains("h1", "Dashboard");
        }

    }