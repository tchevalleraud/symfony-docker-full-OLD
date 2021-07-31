<?php
    namespace App\Domain\_mysql\System\Fixtures;

    use App\Domain\_mysql\System\Entity\User;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Persistence\ObjectManager;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

    class UserFixtures extends Fixture {

        private $passwordEncoder;

        public function __construct(UserPasswordEncoderInterface $passwordEncoder){
            $this->passwordEncoder = $passwordEncoder;
        }

        public function load(ObjectManager $manager){
            $manager->persist($this->newUser("admin@test.pwsb.fr", "P@assword1!"));
            $manager->flush();
        }

        private function newUser($email, $password, $roles = []){
            $user = (new User())
                ->setEmail($email);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            foreach ($roles as $role) $user->addRole($role);
            return $user;
        }

    }