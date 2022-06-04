<?php

namespace App\Weather;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

class Users
{
    /**
     * Method that creates users
     * @param \Doctrine\ORM\EntityManager $entityManager Doctrine manager that handles the database
     */
    public function createUsers($entityManager): void
    {
        $user = new User();
        $user->setEmail('doe@doe.com');
        $user->setImg('smiley-pixabay.png');
        $user->setAcronym('doe');
        $user->setName('doe');
        $user->setPwd('doe');
        $user->setType('doe');
        $entityManager->persist($user);

        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setImg('smiley-pixabay.png');
        $user->setAcronym('admin');
        $user->setName('admin');
        $user->setPwd('admin');
        $user->setType('admin');
        $entityManager->persist($user);

        $entityManager->flush();
    }
}
