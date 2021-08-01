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

        public function test_ValidEntity_Repository(){
            $user = $this->entityManager
                ->getRepository(User::class)
                ->findOneBy(['email' => 'admin@test.pwsb.fr']);
            $this->assertEquals("admin@test.pwsb.fr", $user->getEmail());
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
            $this->assertHasErrors($user = $this->getEntity()->setPassword("Alpha1234!"), 0);
            $this->assertEquals($user->getPassword(), "Alpha1234!");

            $this->assertHasErrors($user = $this->getEntity()->setPassword("^#QL]_r4Gry?op*noVez"), 0);
            $this->assertEquals($user->getPassword(), "^#QL]_r4Gry?op*noVez");
        }

        public function test_InvalidEntity_Password(){
            $this->assertHasErrors($this->getEntity()->setPassword("1234567"), 2);
            $this->assertHasErrors($this->getEntity()->setPassword("123456789"), 1);
            $this->assertHasErrors($this->getEntity()->setPassword("AbCd"), 2);
        }

        public function test_InvalidEntity_Password_NotBlank(){
            $this->assertHasErrors($this->getEntity()->setPassword(null), 1);
        }

        /**
         * Role Tests
         */
        public function test_ValidEntity_Role(){
            $this->assertHasErrors($user = $this->getEntity()->addRole("ROLE_TEST"), 0);
            $this->assertIsArray($user->getRoles());

            $this->assertHasErrors($user = $this->getEntity()->setRoles(['ROLE_USER', 'ROLE_TEST']), 0);
            $this->assertIsArray($user->getRoles());
        }

        /**
         * Locked Tests
         */
        public function test_ValidEntity_Locked(){
            $this->assertHasErrors($user = $this->getEntity()->setLocked(true), 0);
            $this->assertIsBool($user->isLocked());
            $this->assertEquals($user->isLocked(), true);

            $this->assertHasErrors($user = $this->getEntity()->setLocked(false), 0);
            $this->assertIsBool($user->isLocked());
            $this->assertEquals($user->isLocked(), false);
        }

        /**
         * Enabled Tests
         */
        public function test_ValidEntity_Enabled(){
            $this->assertHasErrors($user = $this->getEntity()->setEnabled(true), 0);
            $this->assertIsBool($user->isEnabled());
            $this->assertEquals($user->isEnabled(), true);

            $this->assertHasErrors($user = $this->getEntity()->setEnabled(false), 0);
            $this->assertIsBool($user->isEnabled());
            $this->assertEquals($user->isEnabled(), false);
        }

        /**
         * Deleted Tests
         */
        public function test_ValidEntity_Deleted(){
            $this->assertHasErrors($user = $this->getEntity()->setDeleted(true), 0);
            $this->assertIsBool($user->isDeleted());
            $this->assertEquals($user->isDeleted(), true);

            $this->assertHasErrors($user = $this->getEntity()->setDeleted(false), 0);
            $this->assertIsBool($user->isDeleted());
            $this->assertEquals($user->isDeleted(), false);
        }

    }