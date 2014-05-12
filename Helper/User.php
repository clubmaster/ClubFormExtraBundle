<?php

namespace Club\FormExtraBundle\Helper;

use Symfony\Component\Security\Core\User\UserInterface;

class User
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function encodePassword(UserInterface $user, $password)
    {
        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);

        return $encoder->encodePassword($password, $user->getSalt());
    }
}
