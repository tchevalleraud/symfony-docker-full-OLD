<?php
    namespace App\Application\Exception;

    use Symfony\Component\Security\Core\Exception\AccountStatusException;

    class AccountLockedException extends AccountStatusException {

        public function getMessageKey(){
            return "Account is locked";
        }

    }