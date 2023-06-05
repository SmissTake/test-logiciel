<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $user1 = new User();
    $user1->setUserName('JohnDoe');
    $user1->setEmail('johndoe@example.com');
    $user1->setBirthdate(new \DateTime('1990-01-01'));
    $user1->setAddress('123 Main St');
    $user1->setZipcode('12345');
    $user1->setTown('Anytown');

    $user2 = new User();
    $user2->setUserName('JaneDoe');
    $user2->setEmail('janedoe@example.com');
    $user2->setBirthdate(new \DateTime('1995-05-05'));
    $user2->setAddress('456 Elm St');
    $user2->setZipcode('67890');
    $user2->setTown('Othertown');

    $user3 = new User();
    $user3->setUserName('BobSmith');
    $user3->setEmail('bobsmith@example.com');
    $user3->setBirthdate(new \DateTime('1980-12-25'));
    $user3->setAddress('789 Broadway');
    $user3->setZipcode('13579');
    $user3->setTown('Somewhere');

    $manager->persist($user1);
    $manager->persist($user2);
    $manager->persist($user3);
    $manager->flush();
  }
}
