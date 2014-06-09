<?php

namespace SM\UserBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SMUserBundle:Default:index.html.twig', array('name' => 'Nate'));
    }

    public function loginAction()
    {
        /** @var Symfony\Component\HttpFoundation\Request */
        $request = $this->container->get('request_stack')->getCurrentRequest();
        /** @var Symfony\Component\HttpFoundation\Session\Session $session */
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'SMUserBundle:Default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    public function secureAction()
    {
        return $this->render('SMUserBundle:Default:secure.html.twig', array());
    }

}
