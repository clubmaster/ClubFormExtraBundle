<?php

namespace Club\FormExtraBundle\Helper;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Util\SecureRandom;


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

    public function generatePassword($length=6)
    {
        $generator = new SecureRandom();

        return bin2hex($generator->nextBytes($length));
    }
}
