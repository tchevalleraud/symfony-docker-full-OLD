<?php
    namespace App\Application\Security;

    use App\Domain\_mysql\System\Entity\User as AppUser;

    use App\Application\Exception\AccountDeletedException;
    use App\Application\Exception\AccountLockedException;
    use App\Application\Exception\AccountDisabledException;
    use Symfony\Component\Security\Core\Exception\AccountExpiredException;
    use Symfony\Component\Security\Core\User\UserCheckerInterface;
    use Symfony\Component\Security\Core\User\UserInterface;

    class UserChecker implements UserCheckerInterface {

        public function checkPreAuth(UserInterface $user){
            if(!$user instanceof AppUser) return;
        }

        public function checkPostAuth(UserInterface $user){
            if (!$user instanceof AppUser) return;

            if(!$user->isEnabled()) throw new AccountDisabledException();
            if($user->isExpired()) throw new AccountExpiredException();
            if($user->isLocked()) throw new AccountLockedException();
            if($user->isDeleted()) throw new AccountDeletedException();
        }

    }