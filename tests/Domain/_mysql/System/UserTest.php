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
         * Id Tests
         */
        public function test_ValidEntity_Id(){
            $id = $this->getEntity()->getId();
            $this->assertEquals($this->getEntity()->getId(), $id);
        }

        /**
         * Email Tests
         */
        public function test_ValidEntity_Email(){
            $this->assertHasErrors($user = $this->getEntity()->setEmail("tchevalleraud@gmail.com"), 0);
            $this->assertEquals($user->getEmail(), "tchevalleraud@gmail.com");

            $this->assertHasErrors($user = $this->getEntity()->setEmail("t.chevalleraud@gmail.com"), 0);
            $this->assertEquals($user->getEmail(), "t.chevalleraud@gmail.com");
        }

        public function test_InvalidEntity_Email_NotBlank(){
            $this->assertHasErrors($this->getEntity()->setEmail(null), 1);
        }

        /**
         * Password Tests
         */
        public function test_ValidEntity_Password(){
            $this->assertHasErrors($this->getEntity()->setPassword("Alpha1234!"), 0);
            $this->assertHasErrors($this->getEntity()->setPassword("^#QL]_r4Gry?op*noVez"), 0);
        }

        public function test_InvalidEntity_Password(){
            $this->assertHasErrors($this->getEntity()->setPassword("1234567"), 2);
            $this->assertHasErrors($this->getEntity()->setPassword("123456789"), 1);
            $this->assertHasErrors($this->getEntity()->setPassword("AbCd"), 2);
        }

        public function test_InvalidEntity_Password_NotBlank(){
            $this->assertHasErrors($this->getEntity()->setPassword(null), 1);
        }

    }