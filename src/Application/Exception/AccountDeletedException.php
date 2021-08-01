<?php
    namespace App\Application\Exception;

    use Symfony\Component\Security\Core\Exception\AccountStatusException;

    class AccountDeletedException extends AccountStatusException {

        public function getMessageKey(){
            return "Account is deleted";
        }

    }