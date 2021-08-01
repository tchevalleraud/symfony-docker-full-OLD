<?php
    namespace App\UI\_default;

    use App\Domain\_mysql\System\Repository\UserRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

    class SecurityController extends AbstractController {

        /**
         * @Route({
         *     "en": "/en/login.html",
         *     "fr": "/fr/connexion.html"
         * }, name="app.security.login")
         */
        public function login(AuthenticationUtils $authenticationUtils, UserRepository $userRepository){
            $error = $authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('_security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        }

        /**
         * @Route({
         *     "en": "/en/logout.html",
         *     "fr": "/fr/dexonnecion.html"
         * }, name="app.security.logout")
         */
        public function logout(){
            throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        }

    }