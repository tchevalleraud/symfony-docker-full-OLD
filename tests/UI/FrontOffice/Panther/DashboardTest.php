<?php
    namespace App\Tests\UI\FrontOffice\Panther;

    use Facebook\WebDriver\WebDriverDimension;
    use Symfony\Component\Panther\PantherTestCase;

    class DashboardTest extends PantherTestCase {

        public function test_EN_Index(){
            $client = static::createPantherClient();
            $client->manage()->window()->setSize(new WebDriverDimension(1920, 1080));
            $client->request("GET", "/en/dashboard.html");
            $this->assertSelectorTextContains('h1', 'Dashboard');
        }

    }