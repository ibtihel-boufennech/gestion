<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Userfixtures extends Fixture
{
	private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user=new User();
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setUsername("admin");
        $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
            'admin'
        ));
        $user->setNom("wathak");
        $user->setPrenom("Wathak");
        $user->setEmail("watak@gmail.com");
        $manager->persist($user);

        $manager->flush();
    }
}
