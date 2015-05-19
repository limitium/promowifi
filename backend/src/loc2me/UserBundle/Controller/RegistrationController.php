<?php

namespace loc2me\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Channel controller.
 *
 * @Route("/register")
 */
class RegistrationController extends BaseController
{


    /**
     * Tell the user his account is now confirmed
     */
    public function confirmedAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $settings = $user->getSettings();
        $editForm = $this->container->get('form.factory')->create(new SettingsType(), $settings);

        return $this->render('FOSUserBundle:Registration:confirmed.html.twig', array(
            'user' => $user,
            'form' => $editForm->createView(),
        ));
    }
}