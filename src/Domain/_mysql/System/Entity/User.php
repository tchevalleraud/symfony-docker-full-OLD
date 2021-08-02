<?php
    namespace App\Domain\_mysql\System\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * @ORM\Entity(repositoryClass="App\Domain\_mysql\System\Repository\UserRepository")
     * @ORM\Table(name="system_user")
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
         * @Assert\Length(
         *     min="8",
         *     max="32",
         *     minMessage="your password must be at least {{ limit }} characters long",
         *     maxMessage="your password connot be longer than {{ limit }} characters",
         *     allowEmptyString=false
         * )
         * @Assert\NotBlank()
         * @Assert\Regex(
         *     pattern="/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])[a-zA-Z0-9[:punct:]]{8,32}$/",
         *     match=true,
         *     message="your password is not securized"
         * )
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

        public function __construct(){
            $this->locked   = false;
            $this->enabled  = true;
            $this->deleted  = false;
        }

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

        public function getRoles(): array {
            $roles = $this->roles;
            $roles[] = "ROLE_USER";
            return array_unique($this->roles);
        }

        public function addRole(string $role): self {
            $roles = $this->roles;
            $roles[] = $role;
            $this->roles = array_unique($roles);
            return $this;
        }

        public function setRoles(array $roles): self {
            $this->roles = $roles;
            return $this;
        }

        public function isLocked(){
            return $this->locked;
        }

        public function setLocked($locked): self {
            $this->locked = $locked;
            return $this;
        }

        public function isEnabled(){
            return $this->enabled;
        }

        public function setEnabled($enabled): self {
            $this->enabled = $enabled;
            return $this;
        }

        public function isDeleted(){
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

        public function getUserIdentifier(){
            return $this->getUsername();
        }

        public function isExpired(){
            return false;
        }

    }