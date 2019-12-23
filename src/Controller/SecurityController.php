<?php

namespace App\Controller;

use App\Model\LoginStatus;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class SecurityController extends AbstractJsonController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login()
    {
        return $this->isLogged();
    }

    /**
     * @Route("/is-logged", name="is_logged", methods={"GET"})
     */
    public function isLogged()
    {
        $loginStatus = new LoginStatus();

        $user = $this->getUser();
        if($user) {
            $loginStatus->setIsLogged(true);
            $loginStatus->setUsername($user->getUsername());
            $loginStatus->setRoles($user->getRoles());
        }

        return $this->json($loginStatus);
    }
}
