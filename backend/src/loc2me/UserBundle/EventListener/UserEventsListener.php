<?php

namespace loc2me\UserBundle\EventListener;


use FOS\UserBundle\Event\GetResponseUserEvent;
use loc2me\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class UserEventsListener implements EventSubscriberInterface
{
    private $router;
    private $em;
    private $session;

    public function __construct(Router $router,EntityManager $em, Session $session)
    {
        $this->router = $router;
        $this->em = $em;
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return array(
//            FOSUserEvents::REGISTRATION_SUCCESS => [['setRegisterTime', 20]],
//            FOSUserEvents::REGISTRATION_COMPLETED => [['setOverlordAndSettings', 20]],
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationConfirmed',
        );
    }

    public function setRegisterTime(FormEvent $event)
    {
        /** @var $user User */
        $user = $event->getForm()->getData();
        $user->setCreatedAt(new \DateTime());
    }

    public function setOverlordAndSettings(FilterUserResponseEvent $event)
    {
        /** @var $user User */
        $user = $event->getUser();
    }

    public function onRegistrationConfirmed(FilterUserResponseEvent $event)
    {
        $url = $this->router->generate('_welcome');

        $event->getResponse()->setTargetUrl($url);
    }

}