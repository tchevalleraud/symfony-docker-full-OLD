<?php
    namespace App\Tests\Domain\_mysql\System;

    use App\Domain\_mysql\System\Entity\User;
    use App\Tests\_extend\EntityTestCaseExtend;
    use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

    class UserTest extends KernelTestCase {

        use EntityTestCaseExtend;

        private function getEntity(): User {
            $user = (new User())
                ->setEmail("admin@pwsb.fr")
                ->setPassword("ABCdef123");
            return $user;
        }

        public function test_ValidEntity(){
            $this->assertHasErrors($this->getEntity(), 0);
        }

        /**
         * Email Tests
         */
        public function test_ValidEntity_Email(){
            $this->assertHasErrors($this->getEntity()->setEmail("tchevalleraud@gmail.com"), 0);
            $this->assertHasErrors($this->getEntity()->setEmail("t.chevalleraud@gmail.com"), 0);
        }

        public function test_InvalidEntity_Email_NotBlank(){
            $this->assertHasErrors($this->getEntity()->setEmail(null), 1);
        }

    }