<?php
    namespace App\Tests\UI\FrontOffice\Panther;

    use App\Tests\_extend\PantherTestCaseExtend;
    use Symfony\Component\Panther\PantherTestCase;

    class DashboardTest extends PantherTestCase {

        use PantherTestCaseExtend;

        public function test_EN_Index(){
            $client = $this->getPantherClient();
            $client->request("GET", "/en/dashboard.html");

            $this->assertStringContainsString("/en/dashboard.html", $client->getCurrentURL());
            $this->assertSelectorTextContains("h1", "Dashboard");
        }

    }