<?php
    namespace App\Domain\_mysql\System\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * @ORM\Entity(repositoryClass="App\Domain\_mysql\System\Repository\UserRepository")
     * @ORM\Table(name="system_user")
     * @method string getUserIdentifier()
     */
    class User implements UserInterface {

        /**
         * @ORM\Id
         * @ORM\Column(type="string")
         * @ORM\GeneratedValue(strategy="UUID")
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=180, unique=true)
         * @Assert\NotBlank()
         */
        private $email;

        /**
         * @ORM\Column(type="string")
         */
        private $password;

        /**
         * @ORM\Column(type="json")
         */
        private $roles = [];

        /**
         * @ORM\Column(type="boolean")
         */
        private $locked;

        /**
         * @ORM\Column(type="boolean")
         */
        private $enabled;

        /**
         * @ORM\Column(type="boolean")
         */
        private $deleted;

        public function getId(){
            return $this->id;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email): self {
            $this->email = $email;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password): self {
            $this->password = $password;
            return $this;
        }

        public function getRoles(): array{
            return $this->roles;
        }

        public function setRoles(array $roles): self {
            $this->roles = $roles;
            return $this;
        }

        public function getLocked(){
            return $this->locked;
        }

        public function setLocked($locked): self {
            $this->locked = $locked;
            return $this;
        }

        public function getEnabled(){
            return $this->enabled;
        }

        public function setEnabled($enabled): self {
            $this->enabled = $enabled;
            return $this;
        }

        public function getDeleted(){
            return $this->deleted;
        }

        public function setDeleted($deleted): self {
            $this->deleted = $deleted;
            return $this;
        }

        /***************************************************************************************************************
         * CUSTOM FUNCTION
         */

        public function getSalt(){
        }

        public function eraseCredentials(){
        }

        public function getUsername(){
            return $this->email;
        }


        public function __call($name, $arguments){
            // TODO: Implement @method string getUserIdentifier()
        }
    }