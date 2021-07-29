<?php
    namespace App\Tests\Screenshot\FrontOffice;

    use App\Tests\_extend\PantherTestCaseExtend;
    use Symfony\Component\Panther\PantherTestCase;

    class DashboardTest extends PantherTestCase {

        use PantherTestCaseExtend;

        public function test_EN_Index(){
            $client = $this->getPantherClient();
            $this->takeScreenshot($client, "/en/dashboard.html", "en_dashboard.html");
        }

    }