<?php

namespace App\DataFixtures;

use App\Entity\Halls;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }






public function load(ObjectManager $manager)
{

    $title = ['Small', 'Big', 'Comfort', 'ABC'];
    $address = ['dombr', 'vrubl', 'kabjaka', 'mira', ' coffe'];

            $user = new User();

            for ($i=0;$i<30;$i++) {
                $hall = new Halls();
                $hall
                    ->setTitle($this->getRandom($title))
                    ->setAddress($this->getRandom($address));

                $manager->persist($hall);
                $manager->flush();
            }





            $user->setEmail('test@test.com');
            $user->setPassword($this->passwordEncoder->encodePassword(
                     $user,
                     '123'
                 ));
        $manager->persist($user);
        $manager->flush();
    }

    private function getRandom($data)
    {
        return $data[array_rand($data)];
    }
}
