<?php
    namespace App\UI\FrontOffice;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("my-account", name="myaccount.")
     */
    class MyAccountController extends AbstractController {

        /**
         * @Route(".html", name="index", methods={"GET"})
         */
        public function index(){
            return $this->render("FrontOffice/MyAccount/index.html.twig");
        }

    }