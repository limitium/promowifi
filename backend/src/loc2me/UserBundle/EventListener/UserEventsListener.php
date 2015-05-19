<?php

namespace loc2me\UserBundle\EventListener;


use loc2me\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class UserEventsListener implements EventSubscriberInterface
{
    private $em;
    private $session;

    public function __construct(EntityManager $em, Session $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => [['setRegisterTime', 20]],
            FOSUserEvents::REGISTRATION_COMPLETED => [['setOverlordAndSettings', 20]],
//            FOSUserEvents::REGISTRATION_CONFIRMED => 'onRegistrationConfirmed',
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
        $user->setCreatedAt(new \DateTime());

        $this->setOverlord($user);

        $this->createSettings($user);

        $this->em->flush();
    }

    public function setOverlord(User $user)
    {
        $overlord_id = $this->session->get('overlord_id');
        if ($overlord_id) {
            $this->session->remove('overlord_id');
            /** @var $overlord User */
            $overlord = $this->em->getRepository('loc2meUserBundle:User')->find($overlord_id);
            if ($overlord) {
                $user->setOverlord($overlord);
                $overlord->addSlave($user);
            }
        }
    }

    /**
     * @param $user
     */
    public function createSettings(User $user)
    {
        $settings = new Settings($user);
        $settings->setNoticeEmailTariff3(true);
        $settings->setNoticeEmailTariff2(true);
        $settings->setNoticeEmailTariff1(true);
        $settings->setNoticeEmailTariffEnd(true);
        $settings->setNoticePhoneTariff3(true);
        $settings->setNoticePhoneTariff2(true);
        $settings->setNoticePhoneTariff1(true);
        $settings->setNoticePhoneTariffEnd(true);
        $settings->setDomain($this->session->get('_domain'));

        $user->setSettings($settings);

        $this->em->persist($settings);
    }

}