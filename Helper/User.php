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

    public function generateFirstName()
    {
        $names = array(
            'Sofia',
            'Ida',
            'Isabella',
            'Emma',
            'Freja',
            'Anna',
            'Caroline',
            'Josefine',
            'Clara',
            'Laura',
            'Sofie',
            'Alma',
            'Maja',
            'Karla',
            'Ella',
            'Mathilde',
            'Liva',
            'Olivia',
            'Alberte',
            'Emilie',
            'William',
            'Lucas',
            'Victor',
            'Noah',
            'Frederik',
            'Emil',
            'Liam',
            'Oliver',
            'Oscar',
            'Magnus',
            'Alexander',
            'Carl',
            'Elias',
            'Christian',
            'Sebastian',
            'Mikkel',
            'Mads',
            'Anton',
            'Benjamin',
            'Malthe'
        );

        return $names[array_rand($names)];
    }

    public function generateLastName()
    {
        $names = array(
            'Jensen',
            'Nielsen',
            'Hansen',
            'Pedersen',
            'Andersen',
            'Christensen',
            'Larsen',
            'Sørensen',
            'Rasmussen',
            'Jørgensen',
            'Petersen',
            'Madsen',
            'Kristensen',
            'Olsen',
            'Thomsen',
            'Christiansen',
            'Poulsen',
            'Johansen',
            'Møller',
            'Mortensen'
        );

        return $names[array_rand($names)];
    }

    public function generateEmail()
    {
        $tpl = array(
            'dk',
            'com',
            'org',
            'gl',
            'co.uk',
            'it',
            'nu'
        );

        return sprintf('%s@%s.%s',
            $this->generatePassword(10),
            $this->generatePassword(12),
            $tpl[array_rand($tpl)]
        );
    }
}
